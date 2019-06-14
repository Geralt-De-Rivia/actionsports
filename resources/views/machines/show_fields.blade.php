<!-- Id Field -->
<div class="form-group col-sm-6">
    <div class="form-group">
        {!! Form::label('id', 'Id:') !!}
        <p>{!! $machine->id !!}</p>
    </div>
</div>

<!-- Name Field -->
<div class="form-group col-sm-6">
    <div class="form-group">
        {!! Form::label('name', 'Name:') !!}
        <p>{!! $machine->name !!}</p>
    </div>
</div>

<!-- Status Field -->
<div class="form-group col-sm-6">
    <div class="form-group">
        {!! Form::label('status', 'Status:') !!}
        <p>{!! ($machine->status ==true)? 'true': 'false' !!}</p>
    </div>
</div>

<!-- Created At Field -->
<div class="form-group col-sm-6">
    <div class="form-group">
        {!! Form::label('created_at', 'Created At:') !!}
        <p>{!! $machine->created_at !!}</p>
    </div>
</div>

<!-- Updated At Field -->
<div class="form-group col-sm-6">
    <div class="form-group">
        {!! Form::label('updated_at', 'Updated At:') !!}
        <p>{!! $machine->updated_at !!}</p>
    </div>
</div>

