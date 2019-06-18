<?php


namespace App\Util;


use App\Models\ClassModel;
use App\Models\ClassScheduleModel;
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
                $query->whereBetween('start_at', [$startDate, $endDate])
                    ->orWhereNull('start_at');
            })->where(function ($query) use ($startDate, $endDate) {
                $query->whereBetween('end_at', [$startDate, $endDate])
                    ->orWhereNull('end_at');
            })->where('status', '=', 1)
            ->get();
        $classesCalendar = array();
        foreach ($period as $date) {
            foreach ($classes as $class) {
                if (($date->lte(Carbon::parse($class->start_at) || $class->start_at == null)) && ($date->gte(Carbon::parse($class->end_at) || $class->end_at == null))) {
                    foreach ($class->classScheduleRecurrences as $recurrence) {
                        if ($date->dayOfWeek == $recurrence->day) {
                            $day = Carbon::parse($date->toDateString());
                            $calendarDay = new \stdClass();
                            $calendarDay->title = $class->class->name . '-' . $class->user->name;
                            $calendarDay->start = $day->setTimeFromTimeString($recurrence->start_time)->toDateTimeLocalString();
                            $calendarDay->end = $day->addMinutes($class->class->minutes)->toDateTimeLocalString();
                            $calendarDay->color = '#E300E0';
                            $classesCalendar[] = $calendarDay;
                        }
                    }
                }
            }
        }

        return $classesCalendar;
    }


    public function nextClass()
    {
        $now = Carbon::now();
        $classes = ClassScheduleModel::with('class')->with('user')->with('classScheduleRecurrences')
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
            foreach ($class->classScheduleRecurrences as $recurrence) {
                $day = Carbon::now();
                $startHour = $day->setTimeFromTimeString($recurrence->start_time);
                if ($now->dayOfWeek == $recurrence->day && $startHour->gte($now)) {
                    $calendarDay = new \stdClass();
                    $calendarDay->title = $class->class->name . '-' . $class->user->name;
                    $calendarDay->start = $startHour->toDateTimeLocalString();
                    $calendarDay->end = $day->addMinutes($class->class->minutes)->toDateTimeLocalString();
                    $calendarDay->class_schedule = $class;
                    $calendarDay->minutes = $startHour->diffInMinutes($now);
                    $classesCalendar[] = $calendarDay;
                }
            }
        }
        $sorted = Collect($classesCalendar)->sortBy('minutes');

        $object = $sorted->values()->get(0);

        if(!empty($object)){
            $class = ClassModel::find($object->class_schedule->class->id);
            if(!empty($class)){
                $object->class_schedule->class->properties = $class->properties();
            }
        }

        return $object;
    }
}