@if(!empty($model))
    <a href="/class_schedules/{{$model->class_schedule_id}}">{{$model->class_schedule->class->name}}</a>
@endif
