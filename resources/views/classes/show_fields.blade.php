<!-- Id Field -->
<div class="form-group col-sm-6">
    <div class="form-group">
        {!! Form::label('id', 'Id:') !!}
        <p>{!! $class->id !!}</p>
    </div>
</div>

<!-- Name Field -->
<div class="form-group col-sm-6">
    <div class="form-group">
        {!! Form::label('name', 'Name:') !!}
        <p>{!! $class->name !!}</p>
    </div>
</div>

<!-- Minutes Field -->
<div class="form-group col-sm-6">
    <div class="form-group">
        {!! Form::label('minutes', 'Minutes:') !!}
        <p>{!! $class->minutes !!}</p>
    </div>
</div>

<!-- Status Field -->
<div class="form-group col-sm-6">
    <div class="form-group">
        {!! Form::label('status', 'Status:') !!}
        <p>{!!($class->status ==true)? 'true': 'false' !!}</p>
    </div>
</div>

<!-- Reservable Field -->
<div class="form-group col-sm-6">
    <div class="form-group">
        {!! Form::label('reservable', 'Reservable:') !!}
        <p>{!!($class->reservable ==true)? 'true': 'false' !!}</p>
    </div>
</div>

<!-- Class Type Id Field -->
<div class="form-group col-sm-6">
    <div class="form-group">
        {!! Form::label('class_type_id', 'Class Type Id:') !!}
        <p>{!! $class->class_type_id !!}</p>
    </div>
</div>

<!-- Created At Field -->
<div class="form-group col-sm-6">
    <div class="form-group">
        {!! Form::label('created_at', 'Created At:') !!}
        <p>{!! $class->created_at !!}</p>
    </div>
</div>

<!-- Updated At Field -->
<div class="form-group col-sm-6">
    <div class="form-group">
        {!! Form::label('updated_at', 'Updated At:') !!}
        <p>{!! $class->updated_at !!}</p>
    </div>
</div>

<!--{{$class->properties}}-->

