
<div class="form-group col-sm-6">
    {!! Form::label('day', 'Días por semana:') !!}
    {!! Form::select('day',[
    	'0' => 'Domingo',
    	'1' => 'Lunes',
    	'2' => 'Martes',
    	'3' => 'Miercoles',
    	'4' => 'Jueves',
    	'5' => 'Viernes',
    	'6' => 'Sabado',
    ], null,['class'=>'form-control']) !!}
</div>

<!-- Class Type Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('activity_id', 'Actividades:') !!}
    {!! Form::select('activity_id',$activitys ?? [], $class->id ?? null,['class'=>'form-control']) !!}  
</div>

<!-- Class Type Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('routine_id', 'Rutinas:') !!}
    {!! Form::select('routine_id',$routine ?? [], $class->id ?? null,['class'=>'form-control']) !!}  
</div>


<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Guardar', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('routines_activity.index') !!}" class="btn btn-default">Cancelar</a>
</div>

