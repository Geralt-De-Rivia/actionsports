<?php


namespace App\Util;


use App\Models\ClassScheduleModel;

class ClassReservationService
{

    public function getAvailableDays($classId){
        $classSchedule = ClassScheduleModel::with('classScheduleRecurrences')->
        where('class_id','=', $classId)
            ->get()
            ->first();

        $group = Collect($classSchedule->classScheduleRecurrences)->pluck('day');

        $response = [];
        foreach ($group as $day){
            array_push($response, [
                'id' => $day,
                'label' => ClassesService::days()[$day]
            ]);
        }

        return $response;

    }
}