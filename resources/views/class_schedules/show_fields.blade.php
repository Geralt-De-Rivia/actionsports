
<!-- Class Id Field -->
<div class="form-group col-sm-6">
    <div class="form-group">
        {!! Form::label('class_id', 'Clase:') !!}
        <p>{!! $classSchedule->class->name !!}</p>
    </div>
</div>

<!-- User Id Field -->
<div class="form-group col-sm-6">
    <div class="form-group">
        {!! Form::label('user_id', 'Instructor:') !!}
        <p>{!! $classSchedule->user->name !!}</p>
    </div>
</div>

<!-- Quota Min Field -->
<div class="form-group col-sm-6">
    <div class="form-group">
        {!! Form::label('quota_min', 'Cupo minimo:') !!}
        <p>{!! $classSchedule->quota_min !!}</p>
    </div>
</div>

<!-- Quota Max Field -->
<div class="form-group col-sm-6">
    <div class="form-group">
        {!! Form::label('quota_max', 'Cupo maximo:') !!}
        <p>{!! $classSchedule->quota_max !!}</p>
    </div>
</div>

<!-- Start At Field -->
<div class="form-group col-sm-6">
    <div class="form-group">
        {!! Form::label('start_at', 'Fecha de inicio:') !!}
        <p>{!! $classSchedule->start_at !!}</p>
    </div>
</div>

<!-- End At Field -->
<div class="form-group col-sm-6">
    <div class="form-group">
        {!! Form::label('end_at', 'Fecha de fin:') !!}
        <p>{!! $classSchedule->end_at !!}</p>
    </div>
</div>

<!-- Status Field -->
<div class="form-group col-sm-6">
    <div class="form-group">
        {!! Form::label('status', 'Estado:') !!}
        <p>{!! $classSchedule->status==1?'Activo':'Inactivo' !!}</p>
    </div>
</div>

<!-- Created At Field -->
<div class="form-group col-sm-6">
    <div class="form-group">
        {!! Form::label('created_at', 'Fecha de creacion:') !!}
        <p>{!! $classSchedule->created_at !!}</p>
    </div>
</div>

<div class="form-group col-sm-12">
    <label>Dias</label>
    <table class="table table-bordered table-condensed"  width="100%">
        <thead>
        <tr>
            <th>Dia</th>
            <th>Hora de inicio</th>
        </tr>
        </thead>
        <tbody class="duesTbody">

        @foreach($classSchedule->classScheduleRecurrences as $recurrence)
            <tr v-for="(item, index) in recurrences">
                <td>
                    <span>{{\App\Util\ClassesService::days()[$recurrence->day]}}</span>
                </td>
                <td>
                    <span>{{$recurrence->start_time}}</span>
                </td>
            </tr>
        @endforeach

        </tbody>
    </table>
</div>

