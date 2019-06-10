<!-- Name Field -->
<div class="form-group col-sm-6">
    {!! Form::label('name', 'Name:') !!}
    {!! Form::text('name', null, ['class' => 'form-control']) !!}
</div>

<!-- Days Field -->
<div class="form-group col-sm-6">
    {!! Form::label('days', 'Days:') !!}
    <label class="checkbox-inline">
        {!! Form::hidden('days', 0) !!}
        {!! Form::checkbox('days', '1', null) !!} 1
    </label>
</div>

<!-- Difficulty Field -->
<div class="form-group col-sm-6">
    {!! Form::label('difficulty', 'Difficulty:') !!}
    {!! Form::text('difficulty', null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('routines.index') !!}" class="btn btn-default">Cancel</a>
</div>
