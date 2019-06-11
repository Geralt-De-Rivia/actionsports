@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Routine
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($routine, ['route' => ['routines.update', $routine->id], 'method' => 'patch']) !!}

                        @include('routines.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection