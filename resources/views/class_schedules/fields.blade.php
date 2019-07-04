<!-- Class Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('class_id', 'Clase:') !!}
    {!! Form::select('class_id',$classes ?? [], $class->class_id ?? null,['class'=>'form-control']) !!}

</div>

<!-- User Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('user_id', 'Profesor:') !!}
    {!! Form::select('user_id',$teachers ?? [], $class->user_id ?? null,['class'=>'form-control']) !!}
</div>

<!-- Quota Min Field -->
<div class="form-group col-sm-6">
    {!! Form::label('quota_min', 'Cantidad minima:') !!}
    {!! Form::number('quota_min', null, ['class' => 'form-control']) !!}
</div>

<!-- Quota Max Field -->
<div class="form-group col-sm-6">
    {!! Form::label('quota_max', 'Cantidad Maxima:') !!}
    {!! Form::number('quota_max', null, ['class' => 'form-control']) !!}
</div>

<!-- Start At Field -->
<div class="form-group col-sm-6">
    {!! Form::label('start_at', 'Fecha de inicio (opacional):') !!}
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
    {!! Form::label('end_at', 'Fecha de fin (opacional):') !!}
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
    {!! Form::label('status', 'Estado:') !!}
    <div class="form-check">
        <label class="form-check-label">
            {!! Form::hidden('status', 0) !!}
            {!! Form::checkbox('status', '1', null) !!}
            <span class="form-check-sign">
            <span class="check"></span>
          </span>
        </label>
    </div>
</div>

<hr/>

@if(isset($classSchedule->classScheduleRecurrences))
    <script type="application/javascript">
        window.recurrences = @json($classSchedule->classScheduleRecurrences)
    </script>
@endif
<div class="col-sm-12" id="recurrenceScheduleClass">

    <h5 align="center">Recurrencia</h5>
    <div class="row">
        <div class="col-sm-2">
            <div @click="addDay()" class="btn btn-info">Agregar dia</div>
            <input type="hidden" name="recurrenceItems" v-bind:value="recurrences.length">
        </div>
        <div class="col-sm-6">
        </div>
    </div>
    <table class="table table-bordered table-condensed" id="duesTravelTable" width="100%">
        <thead>
        <tr>
            <th>Dia</th>
            <th>Hora de inicio</th>
        </tr>
        </thead>
        <tbody class="duesTbody">


        <tr v-for="(item, index) in recurrences">
            <td>
                <select class="form-control" v-bind:name="'day_' + (index+1)" v-model="item.day">
                    <option selected hidden>Seleccione</option>
                    <option value="0">Domingo</option>
                    <option value="1">Lunes</option>
                    <option value="2">Martes</option>
                    <option value="3">Miercoles</option>
                    <option value="4">Jueves</option>
                    <option value="5">Viernes</option>
                    <option value="6">Sabado</option>
                </select>
            </td>
            <td>
                <input type="time" class="form-control" v-bind:name="'hour_' + (index+1)" v-model="item.start_time">
            </td>
        </tr>
        </tbody>
    </table>
</div>
<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Guardar', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('class_schedules.index') !!}" class="btn btn-default">Cancelar</a>
</div>
