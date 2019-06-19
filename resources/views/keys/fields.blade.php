<!-- Type Field -->
<div class="form-group col-sm-6">
    {!! Form::label('type', 'Tipo:') !!}
    {!! Form::select('type', $types ?? [], $key->type ?? null, ['class' => 'form-control']) !!}
</div>

<!-- Label Field -->
<div class="form-group col-sm-6">
    {!! Form::label('label', 'Titulo:') !!}
    {!! Form::text('label', null, ['class' => 'form-control']) !!}
</div>

<!-- Model Field -->
<div class="form-group col-sm-6">
    {!! Form::label('model', 'Recurso:') !!}
    {!! Form::select('model', $models ?? [], $key->model ?? null, ['class' => 'form-control']) !!}
</div>


<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Guardar', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('keys.index') !!}" class="btn btn-default">Cancelar</a>
</div>
