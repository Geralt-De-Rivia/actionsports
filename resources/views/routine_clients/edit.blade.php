@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card card-user">
                <div class="card-header">
                    <h5 class="card-title">Editar rutina</h5>
                </div>
                <div class="card-body">
                    {!! Form::model($routineClient, ['route' => ['routineClients.update', $routineClient->id], 'method' => 'patch']) !!}
                    <div class="row">
                        @include('routine_clients.fields')
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection