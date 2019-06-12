<!-- Type Field -->
<div class="form-group col-sm-6">
    {!! Form::label('type', 'Tipo:') !!}
    <select class="form-control" name="type">
        <option value selected disabled>Seleccione..</option>
    @foreach(\App\Models\KeyModel::$TYPES as $type)
            <option value="{{$type['id']}}">{!! $type['label'] !!}</option>
        @endforeach
    </select>
</div>

<!-- Label Field -->
<div class="form-group col-sm-6">
    {!! Form::label('label', 'Titulo:') !!}
    {!! Form::text('label', null, ['class' => 'form-control']) !!}
</div>

<!-- Model Field -->
<div class="form-group col-sm-6">
    {!! Form::label('model', 'Recurso:') !!}
    <select class="form-control" name="model">
        <option value selected disabled>Seleccione..</option>
        @foreach(\App\Models\KeyModel::$MODELS as $model)
            <option value="{{$model['id']}}">{!! $model['label'] !!}</option>
        @endforeach
    </select>
</div>


<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Guardar', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('keys.index') !!}" class="btn btn-default">Cancelar</a>
</div>
