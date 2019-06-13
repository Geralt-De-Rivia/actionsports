@extends('layouts.app')

@section('content')
    <div class="content">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Actividades</h4>
                        </div>
                        <div class="card-body">
                            @include('activities.table')
                        </div>
                    </div>
                </div>
            </div>
             @include('flash::message')
    </div>
@endsection

