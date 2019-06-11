@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            New
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($new, ['route' => ['news.update', $new->id], 'method' => 'patch']) !!}

                        @include('news.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection