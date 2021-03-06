<!-- Name Field -->
<div class="form-group col-sm-6">
    {!! Form::label('name', 'Nombre:') !!}
    {!! Form::text('name', null, ['class' => 'form-control']) !!}
</div>

<!-- Minutes Field -->
<div class="form-group col-sm-6">
    {!! Form::label('minutes', 'Minutos:') !!}
    {!! Form::number('minutes', null, ['class' => 'form-control']) !!}
</div>

<!-- Status Field -->
<div class="form-group col-sm-6">
    {!! Form::label('status', 'Estado:') !!}
    <div class="form-check">
        <label class="form-check-label">
            {!! Form::hidden('status', 0) !!}
            {!! Form::checkbox('status', '1', null) !!}
            <span class="form-check-sign">
            <span class="check"></span>
          </span>
        </label>
    </div>
</div>

<!-- Reservable Field -->
<div class="form-group col-sm-6">
    {!! Form::label('reservable', 'Reservable:') !!}
    <div class="form-check">
        <label class="form-check-label">
            {!! Form::hidden('reservable', 0) !!}
            {!! Form::checkbox('reservable', '1', null) !!}
            <span class="form-check-sign">
            <span class="check"></span>
          </span>
        </label>
    </div>
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
