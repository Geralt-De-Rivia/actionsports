<?php


namespace App\Util;


use App\Models\ClassReservationModel;
use App\Models\ClassScheduleModel;
use App\Models\ClassScheduleRecurrenceModel;
use Carbon\Carbon;
use Carbon\CarbonPeriod;

class ClassReservationService
{

    public function getAvailableDays($classId)
    {
        $startDate = Carbon::now();
        $endDate = Carbon::now()->addDay(15);
        $period = CarbonPeriod::create($startDate, $endDate);
        $classes = ClassScheduleModel::with('class')->with('user')->with('classScheduleRecurrences')
            ->where(function ($query) use ($startDate, $endDate) {
                $query->where('start_at', '<=', $endDate)
                    ->orWhereNull('start_at');
            })->where(function ($query) use ($startDate, $endDate) {
                $query->where('end_at', '>=', $startDate)
                    ->orWhereNull('end_at');
            })->where('status', '=', 1)
            ->where('class_id', '=', $classId)
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
                            $calendarDay->date = $day->setTimeFromTimeString($recurrence->start_time)->toDateString();
                            $calendarDay->dayName = ClassesService::days()[$recurrence->day];
                            $calendarDay->day = $day->setTimeFromTimeString($recurrence->start_time)->format("d");
                            $calendarDay->month = ClassesService::getMonths()[$day->setTimeFromTimeString($recurrence->start_time)->format("n") - 1];
                            $classesCalendar[] = $calendarDay;
                        }
                    }
                }
            }
        }

        return collect($classesCalendar)->unique('date')->values()->all();

    }

    public function getSchedules($classId, $requestDate)
    {
        $startDate = Carbon::parse($requestDate);
        $endDate = Carbon::parse($requestDate);


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
            ->where('class_id', '=', $classId)
            ->get();

        $classesCalendar = array();
        foreach ($classes as $class) {
            $classScheduleRecurrences = ClassScheduleRecurrenceModel::where('class_schedule_id', '=', $class->id)->get();
            foreach ($classScheduleRecurrences as $recurrence) {
                $day = Carbon::parse($startDate->toDateString());
                $day->setTimeFromTimeString($recurrence->start_time);
                if ($startDate->dayOfWeek == $recurrence->day && $day->greaterThan(Carbon::now())) {
                    $count = ClassReservationModel::where('class_schedule_id', '=', $class->id)
                        ->where('date', '=', $startDate)
                        ->where('start_time', '=', $day->toTimeString())
                        ->get()
                        ->count();
                    $calendarDay = new \stdClass();
                    $calendarDay->index = count($classesCalendar);
                    $calendarDay->day = $recurrence->day;
                    $calendarDay->start_format = $day->format('g:i A');
                    $calendarDay->quota_min = $class->quota_min;
                    $calendarDay->quota_max = $class->quota_max;
                    $calendarDay->reserved = $count;
                    $calendarDay->available = $class->quota_max - $count;
                    $calendarDay->date = $requestDate;
                    $calendarDay->time = $day->toTimeString();
                    $calendarDay->class_schedule_id = $class->id;
                    $classesCalendar[] = $calendarDay;
                }
            }
        }


        return collect($classesCalendar)->sortBy('time')->values()->all();

    }



}