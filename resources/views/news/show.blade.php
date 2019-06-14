@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card card-user">
                <div class="card-header">
                    <h5 class="card-title">Noticia</h5>
                </div>
                <div class="card-body">
                   <div class="row" style="padding-left: 20px">
                    @include('news.show_fields')
                    <a href="{!! route('news.index') !!}" class="btn btn-default">Back</a>
                </div>
                </div>
            </div>
        </div>
    </div>
@endsection
