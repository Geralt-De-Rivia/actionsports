@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card card-user">
                <div class="card-header">
                    <h5 class="card-title">Editar Campo de configuración</h5>
                </div>
                <div class="card-body">
                    {!! Form::model($key, ['route' => ['keys.update', $key->id], 'method' => 'patch']) !!}
                    <div class="row">
                        @include('keys.fields')
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection