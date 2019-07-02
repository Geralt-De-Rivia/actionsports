<!-- Name Field -->



<div class="form-group col-sm-6">
    {!! Form::label('name', 'Nombre:') !!}
    {!! Form::text('name', null, ['class' => 'form-control']) !!}
</div>


<div class="form-group col-sm-6">
    {!! Form::label('days', 'Días por semana:') !!}
    {!! Form::select('days',[
    	'1' => '1',
    	'2' => '2',
    	'3' => '3',
    	'4' => '4',
    	'5' => '5',
    	'6' => '6',
    	'7' => '7',
    ], null,['class'=>'form-control']) !!}
</div>


<!-- Difficulty Field -->
<div class="form-group col-sm-6">
    {!! Form::label('difficulty', 'Dificultad:') !!}
    {!! Form::number('difficulty', null, ['class' => 'form-control']) !!}
</div>

@if(isset($routine->routineActivities))
    <script type="application/javascript">
        window.recurrences = @json($routine->routineActivities)
    </script>
@endif

<div class="col-sm-12" id="recurrenceScheduleClass">

    <h5 align="center">Ejercicios</h5>
    <div class="row">
        <div class="col-sm-2">
            <div @click="addDay()" class="btn btn-info">Agregar Ejercicio</div>
            <input type="hidden" name="recurrenceItems" v-bind:value="recurrences.length">
        </div>
        <div class="col-sm-6">
        </div>
    </div>
    <table class="table table-bordered table-condensed" id="duesTravelTable" width="100%">
        <thead>
        <tr>
            <th>Dia</th>
            <th>Actividad</th>
        </tr>
        </thead>
        <tbody class="duesTbody">


        <tr v-for="(item, index) in recurrences">
            <td>
                <select class="form-control" v-bind:name="'day_' + (index+1)" v-model="item.day">
                    <option selected hidden>Seleccione</option>
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                    <option value="5">5</option>
                    <option value="6">6</option>
                    <option value="7">7</option>
                </select>
            </td>
            <td>
                <select class="form-control" v-bind:name="'activity_' + (index+1)" v-model="item.day">
                    <option selected hidden>Seleccione</option>

                    @foreach($activitys ?? [] as $key => $value)
                        <option value="{{$key}}">{{$value}}</option>
                    @endforeach
                </select>
               {{-- {!! Form::select('activity_id',$activitys ?? [], $class->id ?? null,['class'=>'form-control','name'=>"exercise[]"]) !!}  --}}
               {{--  <input type="time" class="form-control" v-bind:name="'hour_' + (index+1)" v-model="item.start_time"> --}}              
            </td>
        </tr>
        </tbody>
    </table>
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Guardar', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('routines.index') !!}" class="btn btn-default">Cancelar</a>
</div>