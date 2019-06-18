<!-- Name Field -->
<div class="form-group col-sm-6">
    {!! Form::label('name', 'Name:') !!}
    {!! Form::text('name', null, ['class' => 'form-control']) !!}
</div>

@include('fields.template')

<!-- Status Field -->
<div class="form-group col-sm-6">
    {!! Form::label('status', 'Status:') !!}
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

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Guardar', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('machines.index') !!}" class="btn btn-default">Cancelar</a>
</div>

