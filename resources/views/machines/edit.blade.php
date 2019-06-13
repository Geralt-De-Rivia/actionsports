@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card card-user">
                <div class="card-header">
                    <h5 class="card-title">Actualizar Máquina</h5>
                </div>
                <div class="card-body">
                    {!! Form::model($machine, ['route' => ['machines.update', $machine->id], 'method' => 'patch']) !!}
                    <div class="row">
                        @include('machines.fields')
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection