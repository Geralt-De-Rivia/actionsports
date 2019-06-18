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
            ->where(function ($query) use ($startDate) {
            $query->where('start_at', '<=', $startDate)
                ->orWhereNull('start_at');
        })->where(function ($query) use ($endDate) {
            $query->where('end_at', '>=', $endDate)
                ->orWhereNull('end_at');
        })->where('status','=',1)
            ->get();
        $classesCalendar = array();
        foreach ($period as $date) {
            foreach ($classes as $class){
                if(($date->lte(Carbon::parse($class->start_at) || $class->start_at == null)) && ($date->gte(Carbon::parse($class->end_at) || $class->end_at == null))){
                    foreach ($class->classScheduleRecurrences as $recurrence){
                        if($date->dayOfWeek == $recurrence->day){
                            $day = Carbon::parse($date->toDateString());
                            $calendarDay = new \stdClass();
                            $calendarDay->title = $class->class->name.'-'.$class->user->name;
                            $calendarDay->start = $day->setTimeFromTimeString($recurrence->start_time)->toDateTimeLocalString();
                            $calendarDay->end = $day->addMinutes($class->class->minutes)->toDateTimeLocalString();
                            $classesCalendar[] = $calendarDay;
                        }
                    }
                }
            }
        }

        return $classesCalendar;
    }
}