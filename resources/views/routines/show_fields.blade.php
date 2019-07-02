<!-- Id Field -->
<div class="form-group col-sm-6">
    <div class="form-group">
        {!! Form::label('id', 'Id:') !!}
        <p>{!! $routine->id !!}</p>
    </div>
</div>

<!-- Name Field -->
<div class="form-group col-sm-6">
    <div class="form-group">
        {!! Form::label('name', 'Name:') !!}
        <p>{!! $routine->name !!}</p>
    </div>
</div>

<!-- Days Field -->
<div class="form-group col-sm-6">
    <div class="form-group">
        {!! Form::label('days', 'Days:') !!}
        <p>{!! $routine->days !!}</p>
    </div>
</div>

<!-- Difficulty Field -->
<div class="form-group col-sm-6">
    <div class="form-group">
        {!! Form::label('difficulty', 'Difficulty:') !!}
        <p>{!! $routine->difficulty !!}</p>
    </div>
</div>

<!-- Created At Field -->
<div class="form-group col-sm-6">
    <div class="form-group">
        {!! Form::label('created_at', 'Created At:') !!}
        <p>{!! $routine->created_at !!}</p>
    </div>
</div>

<!-- Updated At Field -->
<div class="form-group col-sm-6">
    <div class="form-group">
        {!! Form::label('updated_at', 'Updated At:') !!}
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

        @foreach($routine->routineActivities as $recurrence)

        <tr v-for="(item, index) in recurrences">
                <td>
                    <span>{{$recurrence->day}}</span>
                </td>
                <td>
                    <span>{{$recurrence->activity_id}}</span>
                </td>
            </tr>
        @endforeach

        </tbody>
    </table>
</div>
