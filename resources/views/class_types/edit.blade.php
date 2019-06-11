@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Class Type
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($classType, ['route' => ['classTypes.update', $classType->id], 'method' => 'patch']) !!}

                        @include('class_types.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection