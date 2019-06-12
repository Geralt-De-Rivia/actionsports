<!-- Class Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('class_id', 'Class Id:') !!}
    {!! Form::number('class_id', null, ['class' => 'form-control']) !!}
</div>

<!-- User Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('user_id', 'User Id:') !!}
    {!! Form::number('user_id', null, ['class' => 'form-control']) !!}
</div>

<!-- Quota Min Field -->
<div class="form-group col-sm-6">
    {!! Form::label('quota_min', 'Quota Min:') !!}
    {!! Form::number('quota_min', null, ['class' => 'form-control']) !!}
</div>

<!-- Quota Max Field -->
<div class="form-group col-sm-6">
    {!! Form::label('quota_max', 'Quota Max:') !!}
    {!! Form::number('quota_max', null, ['class' => 'form-control']) !!}
</div>

<!-- Start At Field -->
<div class="form-group col-sm-6">
    {!! Form::label('start_at', 'Start At:') !!}
    {!! Form::date('start_at', null, ['class' => 'form-control','id'=>'start_at']) !!}
</div>

@section('scripts')
    <script type="text/javascript">
        $('#start_at').datetimepicker({
            format: 'YYYY-MM-DD HH:mm:ss',
            useCurrent: false
        })
    </script>
@endsection

<!-- End At Field -->
<div class="form-group col-sm-6">
    {!! Form::label('end_at', 'End At:') !!}
    {!! Form::date('end_at', null, ['class' => 'form-control','id'=>'end_at']) !!}
</div>

@section('scripts')
    <script type="text/javascript">
        $('#end_at').datetimepicker({
            format: 'YYYY-MM-DD HH:mm:ss',
            useCurrent: false
        })
    </script>
@endsection

<!-- Status Field -->
<div class="form-group col-sm-6">
    {!! Form::label('status', 'Status:') !!}
    <label class="checkbox-inline">
        {!! Form::hidden('status', 0) !!}
        {!! Form::checkbox('status', '1', null) !!} 1
    </label>
</div>

<!-- Recurrence Field -->
<div class="form-group col-sm-6">
    {!! Form::label('recurrence', 'Recurrence:') !!}
    <label class="checkbox-inline">
        {!! Form::hidden('recurrence', 0) !!}
        {!! Form::checkbox('recurrence', '1', null) !!} 1
    </label>
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('classSchedules.index') !!}" class="btn btn-default">Cancel</a>
</div>
