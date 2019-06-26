<!-- Id Field -->
<div class="form-group col-sm-6">
    <div class="form-group">
        {!! Form::label('id', 'Id:') !!}
        <p>{!! $routines_activity->id !!}</p>
    </div>
</div>

<!-- Days Field -->
<div class="form-group col-sm-6">
    <div class="form-group">
        {!! Form::label('day', 'Día:') !!}
        <p>{!! $routines_activity->day_routine !!}</p>
    </div>
</div>

<!-- Class Type Id Field -->
<div class="form-group col-sm-6">
    <div class="form-group">
        {!! Form::label('activity', 'Actividades:') !!}
        <p>{!! $routines_activity->activity->name !!}</p>
    </div>
</div>

<!-- Class Type Id Field -->
<div class="form-group col-sm-6">
    <div class="form-group">
        {!! Form::label('routine', 'Rutinas:') !!}
        <p>{!! $routines_activity->routine->name !!}</p>
    </div>
</div>


