@extends('layouts.app')

@section('content')
    <div class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Rutinas de clientes</h4>
                    </div>
                    <div class="card-body">
                        @include('routine_clients.table')
                    </div>
                </div>
            </div>
        </div>
        @include('flash::message')
    </div>
@endsection

