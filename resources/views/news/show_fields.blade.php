<!-- Id Field -->
<div class="form-group col-sm-6">
    <div class="form-group">
        {!! Form::label('id', 'Id:') !!}
        <p>{!! $new->id !!}</p>
    </div>
</div>

<!-- Name Field -->
<div class="form-group col-sm-6">
    <div class="form-group">
        {!! Form::label('name', 'Name:') !!}
        <p>{!! $new->name !!}</p>
    </div>
</div>

<!-- Status Field -->
<div class="form-group col-sm-6">
    <div class="form-group">
        {!! Form::label('status', 'Status:') !!}
        <p>{!! ($new->status ==true)? 'true': 'false' !!}</p>
    </div>
</div>

<!-- Created At Field -->
<div class="form-group col-sm-6">
    <div class="form-group">
        {!! Form::label('created_at', 'Created At:') !!}
        <p>{!! $new->created_at !!}</p>
    </div>
</div>

<!-- Updated At Field -->
<div class="form-group col-sm-6">
    <div class="form-group">
        {!! Form::label('updated_at', 'Updated At:') !!}
        <p>{!! $new->updated_at !!}</p>
    </div>
</div>

