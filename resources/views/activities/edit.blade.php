@extends('layouts.app')

@section('content')
    
    <div class="row">
        <div class="col-md-12">
            <div class="card card-user">
                <div class="card-header">
                    <h5 class="card-title">Actualizar Actividad</h5>
                </div>
                <div class="card-body">
                    {!! Form::model($activity, ['route' => ['activities.update', $activity->id], 'method' => 'patch']) !!}
                    <div class="row">
                        @include('activities.fields')
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection