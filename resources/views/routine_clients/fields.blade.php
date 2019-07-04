<!-- Routine Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('routine_id', 'Rutina:') !!}
    {!! Form::select('routine_id',$routines ?? [], $class->routine_id ?? null,['class'=>'form-control']) !!}

</div>

<div class="form-group col-sm-6">
    {!! Form::label('user_id', 'Instructor:') !!}
    {!! Form::select('user_id',$teachers ?? [], $class->user_id ?? null,['class'=>'form-control']) !!}
</div>

<!-- Start At Field -->
<div class="form-group col-sm-6">
    {!! Form::label('start_at', 'Fecha de Inicio:') !!}
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
    {!! Form::label('end_at', 'Fecha de Fin:') !!}
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
        {!! Form::checkbox('status', '1', null) !!}
    </label>
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('routineClients.index') !!}" class="btn btn-default">Cancel</a>
</div>
