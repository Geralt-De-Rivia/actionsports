@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card card-user">
                <div class="card-header">
                    <h5 class="card-title">Actualizar Clase</h5>
                </div>
                <div class="card-body">
                    {!! Form::model($class, ['route' => ['classes.update', $class->id], 'method' => 'patch']) !!}
                    <div class="row">
                        @include('classes.fields')
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection