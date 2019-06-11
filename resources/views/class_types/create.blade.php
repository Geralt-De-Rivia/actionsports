@extends('layouts.app')

@section('content')

    <div class="row">
        <div class="col-md-12">
            <div class="card card-user">
                <div class="card-header">
                    <h5 class="card-title">Crear tipo de Clase</h5>
                </div>
                <div class="card-body">
                    {!! Form::open(['route' => 'classTypes.store']) !!}

                    @include('class_types.fields')

                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>

@endsection
