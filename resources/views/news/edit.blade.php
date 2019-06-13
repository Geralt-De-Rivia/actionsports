@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card card-user">
                <div class="card-header">
                    <h5 class="card-title">Actualizar Noticia</h5>
                </div>
                <div class="card-body">
                    {!! Form::model($new, ['route' => ['news.update', $new->id], 'method' => 'patch']) !!}
                    <div class="row">
                        @include('news.fields')
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection