<!-- Id Field -->
<div class="form-group">
    {!! Form::label('id', 'Id:') !!}
    <p>{!! $routine->id !!}</p>
</div>

<!-- Name Field -->
<div class="form-group">
    {!! Form::label('name', 'Name:') !!}
    <p>{!! $routine->name !!}</p>
</div>

<!-- Days Field -->
<div class="form-group">
    {!! Form::label('days', 'Days:') !!}
    <p>{!! $routine->days !!}</p>
</div>

<!-- Difficulty Field -->
<div class="form-group">
    {!! Form::label('difficulty', 'Difficulty:') !!}
    <p>{!! $routine->difficulty !!}</p>
</div>

<!-- Created At Field -->
<div class="form-group">
    {!! Form::label('created_at', 'Created At:') !!}
    <p>{!! $routine->created_at !!}</p>
</div>

<!-- Updated At Field -->
<div class="form-group">
    {!! Form::label('updated_at', 'Updated At:') !!}
    <p>{!! $routine->updated_at !!}</p>
</div>

