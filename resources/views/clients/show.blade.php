@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card card-user">
                <div class="card-header">
                    <h5 class="card-title">Cliente</h5>
                </div>
                <div class="card-body">
                    <div class="row" style="padding-left: 20px">
                        @include('clients.show_fields')
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <a href="{!! route('clients.index') !!}" class="btn btn-default">Atras</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
