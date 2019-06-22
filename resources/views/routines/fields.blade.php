<!-- Name Field -->
<div class="form-group col-sm-6">
    {!! Form::label('name', 'Nombre:') !!}
    {!! Form::text('name', null, ['class' => 'form-control']) !!}
</div>


<div class="form-group col-sm-6">
    {!! Form::label('days', 'Días por semana:') !!}
    {!! Form::select('days',[
    	'0' => 'Domingo',
    	'1' => 'Lunes',
    	'2' => 'Martes',
    	'3' => 'Miercoles',
    	'4' => 'Jueves',
    	'5' => 'Viernes',
    	'6' => 'Sabado',
    ], null,['class'=>'form-control']) !!}
</div>


<!-- Difficulty Field -->
<div class="form-group col-sm-6">
    {!! Form::label('difficulty', 'Dificultad:') !!}
    {!! Form::number('difficulty', null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Guardar', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('routines.index') !!}" class="btn btn-default">Cancelar</a>
</div>

