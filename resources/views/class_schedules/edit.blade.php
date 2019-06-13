@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card card-user">
                <div class="card-header">
                    <h5 class="card-title">Actualizar Horario de Clase</h5>
                </div>
                <div class="card-body">
                    {!! Form::model($classSchedule, ['route' => ['classSchedules.update', $classSchedule->id], 'method' => 'patch']) !!}
                    <div class="row">
                        @include('classSchedules.fields')
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection