@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card card-user">
                <div class="card-header">
                    <h5 class="card-title">Editar reservación</h5>
                </div>
                <div class="card-body">
                    {!! Form::model($classReservation, ['route' => ['classReservations.update', $classReservation->id], 'method' => 'patch']) !!}
                    <div class="row">
                        @include('class_reservations.fields')
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection