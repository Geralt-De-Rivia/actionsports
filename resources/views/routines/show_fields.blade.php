<!-- Id Field -->
{{-- <div class="form-group col-sm-6">
    <div class="form-group">
        {!! Form::label('id', 'Id:') !!}
        <p>{!! $routine->id !!}</p>
    </div>
</div> --}}

<!-- Name Field -->
<div class="form-group col-sm-6">
    <div class="form-group">
        {!! Form::label('name', 'Nombre:') !!}
        <p>{!! $routine->name !!}</p>
    </div>
</div>

<!-- Days Field -->
<div class="form-group col-sm-6">
    <div class="form-group">
        {!! Form::label('days', 'Días:') !!}
        <p>{!! $routine->days !!}</p>
    </div>
</div>

<!-- Difficulty Field -->
<div class="form-group col-sm-6">
    <div class="form-group">
        {!! Form::label('difficulty', 'Dificultad:') !!}
        <p>{!! $routine->difficulty !!}</p>
    </div>
</div>

<!-- Created At Field -->
<div class="form-group col-sm-6">
    <div class="form-group">
        {!! Form::label('created_at', 'Creado el:') !!}
        <p>{!! $routine->created_at !!}</p>
    </div>
</div>

<!-- Updated At Field -->
<div class="form-group col-sm-6">
    <div class="form-group">
        {!! Form::label('updated_at', 'Actualizado el:') !!}
        <p>{!! $routine->updated_at !!}</p>
    </div>
</div>

<div class="form-group col-sm-12">
    <label>Ejercicios</label>
    <table class="table table-bordered table-condensed"  width="100%">
        <thead>
        <tr>
            <th>Día</th>
            <th>Actividad</th>
        </tr>
        </thead>
        <tbody class="duesTbody">

        @foreach($routine->routineActivities as $key => $recurrence)
        <tr v-for="(item, index) in recurrences">
                <td>
                    <span>{{$recurrence->day}}</span>
                </td>
                <td>
                    <span>{{$recurrence->Activity->name}}</span>
                </td>
            </tr>
        @endforeach

        </tbody>
    </table>
</div>
