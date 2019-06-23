@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card card-user">
                <div class="card-header">
                    <h5 class="card-title">Actualizar Rutina</h5>
                </div>
                <div class="card-body">
                    {!! Form::model($routines_activity, ['route' => ['routines_activity.update', $routines_activity->id], 'method' => 'patch']) !!}
                    <div class="row">
                        @include('routines_activity.fields')
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection