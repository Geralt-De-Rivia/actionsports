<!-- Id Field -->
<div class="form-group col-sm-6">
	<div class="form-group">
	    {!! Form::label('id', 'Id:') !!}
	    <p>{!! $classType->id !!}</p>
	</div>
</div>

<!-- Name Field -->
<div class="form-group col-sm-6">
	<div class="form-group">
	    {!! Form::label('name', 'Name:') !!}
	    <p>{!! $classType->name !!}</p>
	</div>
</div>

<!-- Created At Field -->
<div class="form-group col-sm-6">
	<div class="form-group">
	    {!! Form::label('created_at', 'Created At:') !!}
	    <p>{!! $classType->created_at !!}</p>
	</div>
</div>

<!-- Updated At Field -->
<div class="form-group col-sm-6">
	<div class="form-group">
	    {!! Form::label('updated_at', 'Updated At:') !!}
	    <p>{!! $classType->updated_at !!}</p>
	</div>
</div>

