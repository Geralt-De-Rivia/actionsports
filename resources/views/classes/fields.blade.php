<!-- Name Field -->
<div class="form-group col-sm-6">
    {!! Form::label('name', 'Name:') !!}
    {!! Form::text('name', null, ['class' => 'form-control']) !!}
</div>

<!-- Minutes Field -->
<div class="form-group col-sm-6">
    {!! Form::label('minutes', 'Minutes:') !!}
    {!! Form::number('minutes', null, ['class' => 'form-control']) !!}
</div>

<!-- Status Field -->
<div class="form-group col-sm-6">
    {!! Form::label('status', 'Status:') !!}
    <label class="checkbox-inline">
        {!! Form::hidden('status', 0) !!}
        {!! Form::checkbox('status', '1', null) !!} 1
    </label>
</div>

<!-- Reservable Field -->
<div class="form-group col-sm-6">
    {!! Form::label('reservable', 'Reservable:') !!}
    <label class="checkbox-inline">
        {!! Form::hidden('reservable', 0) !!}
        {!! Form::checkbox('reservable', '1', null) !!} 1
    </label>
</div>

<!-- Class Type Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('class_type_id', 'Tipo:') !!}
    {!! Form::select('class_type_id',$types ?? [], $class->class_type_id ?? null,['class'=>'form-control']) !!}
   
</div>

@include('fields.template')

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Guardar', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('classes.index') !!}" class="btn btn-default">Cancelar</a>
</div>
