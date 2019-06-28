<!-- Name Field -->
<div class="form-group col-sm-6">
    {!! Form::label('name', 'Nombre:') !!}
    {!! Form::text('name', null, ['class' => 'form-control']) !!}
</div>

<!-- Status Field -->
<div class="form-group col-sm-6">
    {!! Form::label('status', 'Estado:') !!}
    <div class="form-check">
        <label class="form-check-label">
            {!! Form::hidden('status', 0) !!}
            {!! Form::checkbox('status', '1', null) !!} 1
            <span class="form-check-sign">
            <span class="check"></span>
          </span>
        </label>
    </div>
</div>

@include('fields.template')

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Guardar', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('news.index') !!}" class="btn btn-default">Cancelar</a>
</div>
