@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card card-user">
                <div class="card-header">
                    <h5 class="card-title">Crear Rutina</h5>
                </div>
                <div class="card-body">
                    {!! Form::open(['route' => 'routines.store']) !!}
                    <div class="row">
                        @include('routines.fields')
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection
