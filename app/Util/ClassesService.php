<?php


namespace App\Util;


use App\Models\ClassScheduleModel;
use App\Models\ClassScheduleRecurrenceModel;
use Carbon\Carbon;
use Carbon\CarbonPeriod;

class ClassesService
{

    public function buildClasses($start, $end)
    {
        $startDate = Carbon::parse($start);
        $endDate = Carbon::parse($end);
        $period = CarbonPeriod::create($startDate, $endDate);
        $classes = ClassScheduleModel::with('class')->with('user')->with('classScheduleRecurrences')
            ->where(function ($query) use ($startDate, $endDate) {
                $query->where('start_at', '<=', $startDate)
                    ->orWhere('start_at', '<=', $endDate)
                    ->orWhereNull('start_at');
            })->where(function ($query) use ($startDate, $endDate) {
                $query->where('end_at', '>=', $startDate)
                    ->orWhere('end_at', '<=', $endDate)
                    ->orWhereNull('end_at');
            })->where('status', '=', 1)
            ->get();
        $classesCalendar = array();
        foreach ($period as $date) {
            foreach ($classes as $class) {
                if (($date->lte(Carbon::parse($class->start_at) || $class->start_at == null)) && ($date->gte(Carbon::parse($class->end_at) || $class->end_at == null))) {
                    $classScheduleRecurrences = ClassScheduleRecurrenceModel::where('class_schedule_id', '=', $class->id)->get();
                    foreach ($classScheduleRecurrences as $recurrence) {
                        if ($date->dayOfWeek == $recurrence->day) {
                            $day = Carbon::parse($date->toDateString());
                            $calendarDay = new \stdClass();
                            $calendarDay->title = $class->class->name . '-' . $class->user->name;
                            $calendarDay->start = $day->setTimeFromTimeString($recurrence->start_time)->toDateTimeLocalString();
                            $calendarDay->end = $day->addMinutes($class->class->minutes)->toDateTimeLocalString();
                            $calendarDay->color = EloquentPropertyUtil::getPropertyValue($class->class, 'color');
                            $classesCalendar[] = $calendarDay;
                        }
                    }
                }
            }
        }

        return $classesCalendar;
    }

    public static function days()
    {
        return [
            0 => 'Domingo',
            1 => 'Lunes',
            2 => 'Martes',
            3 => 'Miercoles',
            4 => 'Jueves',
            5 => 'Viernes',
            6 => 'Sabado'
        ];
    }

    public static function daysInverse()
    {
        return [
            'Domingo' => 0,
            'Lunes' => 1,
            'Martes' => 2,
            'Miercoles' => 3,
            'Jueves' => 4,
            'Viernes' => 5,
            'Sabado' => 6
        ];
    }

    public static function getMonths()
    {
        return array("Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre");

    }

    public function classWeek()
    {
        $startDate = Carbon::now()->startOfWeek();
        $endDate = Carbon::now()->endOfWeek();
        $period = CarbonPeriod::create($startDate, $endDate);
        $classes = ClassScheduleModel::with('user')
            ->where(function ($query) use ($startDate, $endDate) {
                $query->where('start_at', '<=', $startDate)
                    ->orWhere('start_at', '<=', $endDate)
                    ->orWhereNull('start_at');
            })->where(function ($query) use ($startDate, $endDate) {
                $query->where('end_at', '>=', $startDate)
                    ->orWhere('end_at', '<=', $endDate)
                    ->orWhereNull('end_at');
            })->where('status', '=', 1)
            ->get();
        $classesCalendar = array();
        foreach ($period as $date) {
            foreach ($classes as $class) {
                if (($date->lte(Carbon::parse($class->start_at) || $class->start_at == null)) && ($date->gte(Carbon::parse($class->end_at) || $class->end_at == null))) {
                    $classScheduleRecurrences = ClassScheduleRecurrenceModel::where('class_schedule_id', '=', $class->id)->get();
                    foreach ($classScheduleRecurrences as $recurrence) {
                        if ($date->dayOfWeek == $recurrence->day) {
                            $day = Carbon::parse($date->toDateString());
                            $calendarDay = new \stdClass();
                            $calendarDay->title = $class->class->name;
                            $calendarDay->start_date = $day->setTimeFromTimeString($recurrence->start_time);
                            $calendarDay->start = $day->setTimeFromTimeString($recurrence->start_time)->format('g:i A');
                            $calendarDay->end = $day->addMinutes($class->class->minutes)->toTimeString();
                            $calendarDay->day = $this->days()[$recurrence->day];
                            $calendarDay->day_value = $recurrence->day;
                            $calendarDay->user = $class->user;
                            $calendarDay->class = EloquentPropertyUtil::build($class->class);
                            $calendarDay->type = $class->class->class_type_id;
                            $classesCalendar[] = $calendarDay;
                        }
                    }
                }
            }
        }

        $items = Collect($classesCalendar)->sortBy('start_date');
        $sorted = Collect($items)->groupBy('type');

        //$sorted = Collect($classesCalendar)->groupBy('day');
        $response = [];
        foreach ($sorted as $key => &$value) {
            $days = $value->groupBy('day_value');
            $days = $days->sortKeys();
            if (!isset($response[$key])) {
                $response[$key] = [];
            }
            $itemsForDay = [];
            foreach ($days as $keyDay => $valueDay) {
                if (!isset($itemsForDay[$this->days()[$keyDay]])) {
                    $itemsForDay[$this->days()[$keyDay]] = [];
                }
                $itemsForDay[$this->days()[$keyDay]] = $valueDay;
            }

            $response[$key] = $itemsForDay;
        }

        return $response;
    }

    public function nextClass()
    {
        $now = Carbon::now();
        $classes = ClassScheduleModel::with('class')->with('user')
            ->where(function ($query) use ($now) {
                $query->where('start_at', '<=', $now)
                    ->orWhereNull('start_at');
            })->where(function ($query) use ($now) {
                $query->where('end_at', '>=', $now)
                    ->orWhereNull('end_at');
            })->where('status', '=', 1)
            ->get();
        $classesCalendar = array();
        foreach ($classes as $class) {
            $classScheduleRecurrences = ClassScheduleRecurrenceModel::where('class_schedule_id', '=', $class->id)->get();
            foreach ($classScheduleRecurrences as $recurrence) {
                $day = Carbon::now();
                $startHour = $day->setTimeFromTimeString($recurrence->start_time);
                if ($now->dayOfWeek == $recurrence->day && $startHour->gte($now)) {
                    $calendarDay = new \stdClass();
                    $calendarDay->title = $class->class->name;
                    $calendarDay->start = $startHour->toDateTimeLocalString();
                    $calendarDay->end = $day->addMinutes($class->class->minutes)->toDateTimeLocalString();
                    $calendarDay->class = EloquentPropertyUtil::build($class->class);
                    $calendarDay->user = $class->user;
                    $classesCalendar[] = $calendarDay;
                }
            }
        }
        $sorted = Collect($classesCalendar)->sortBy('start');

        $object = $sorted->values()->get(0);

        return $object;
    }
}