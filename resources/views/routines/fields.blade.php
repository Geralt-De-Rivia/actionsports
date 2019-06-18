<!-- Name Field -->
<div class="form-group col-sm-6">
    {!! Form::label('name', 'Name:') !!}
    {!! Form::text('name', null, ['class' => 'form-control']) !!}
</div>

<!-- Days Field -->
<div class="form-group col-sm-6">
    {!! Form::label('days', 'Days:') !!}
    <div class="form-check">
        <label class="form-check-label">
            {!! Form::hidden('days', 0) !!}
            {!! Form::checkbox('days', '1', null) !!} 1
            <span class="form-check-sign">
            <span class="check"></span>
          </span>
        </label>
    </div>
</div>

<!-- Difficulty Field -->
<div class="form-group col-sm-6">
    {!! Form::label('difficulty', 'Difficulty:') !!}
    {!! Form::text('difficulty', null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Guardar', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('routines.index') !!}" class="btn btn-default">Cancelar</a>
</div>
