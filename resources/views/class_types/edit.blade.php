@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card card-user">
                <div class="card-header">
                    <h5 class="card-title">Actualizar Tipo de Clase</h5>
                </div>
                <div class="card-body">
                    {!! Form::model($classType, ['route' => ['class_types.update', $classType->id], 'method' => 'patch']) !!}
                    <div class="row">
                        @include('class_types.fields')
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection