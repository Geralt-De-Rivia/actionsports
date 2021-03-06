<!-- Dni Field -->
<div class="form-group col-sm-6">
    {!! Form::label('dni', 'Dni:') !!}
    {!! Form::number('dni', null, ['class' => 'form-control']) !!}
</div>

<!-- Name Field -->
<div class="form-group col-sm-6">
    {!! Form::label('name', 'Nombre:') !!}
    {!! Form::text('name', null, ['class' => 'form-control']) !!}
</div>

<!-- Last Name Field -->
<div class="form-group col-sm-6">
    {!! Form::label('last_name', 'Apellido:') !!}
    {!! Form::text('last_name', null, ['class' => 'form-control']) !!}
</div>

<!-- Phone Number Field -->
<div class="form-group col-sm-6">
    {!! Form::label('phone_number', 'Número Telefono:') !!}
    {!! Form::text('phone_number', null, ['class' => 'form-control']) !!}
</div>

<!-- Email Field -->
<div class="form-group col-sm-6">
    {!! Form::label('email', 'Email:') !!}
    {!! Form::email('email', null, ['class' => 'form-control']) !!}
</div>

<!-- Code Field -->
<div class="form-group col-sm-6">
    {!! Form::label('code', 'Codigo:') !!}
    {!! Form::text('code', null, ['class' => 'form-control']) !!}
</div>

<!-- Image Url Field -->
<div class="form-group col-sm-6">
    {!! Form::label('image_url', 'Imagen Url:') !!}
    {!! Form::text('image_url', null, ['class' => 'form-control']) !!}
</div>

<!-- Membership Number Field -->
<div class="form-group col-sm-6">
    {!! Form::label('membership_number', 'Número Membership:') !!}
    {!! Form::text('membership_number', null, ['class' => 'form-control']) !!}
</div>

<!-- Client Status Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('client_status_id', 'Estado Cliente:') !!}
    {!! Form::select('client_status_id',$status ?? [], $clients->client_status_id ?? null,['class'=>'form-control']) !!}  
</div>

<!-- Birth Date Field -->
<div class="form-group col-sm-6">
    {!! Form::label('birth_date', 'Fecha Cumpleaños:') !!}
    {!! Form::date('birth_date', null, ['class' => 'form-control','id'=>'birth_date']) !!}
</div>

@section('scripts')
    <script type="text/javascript">
        $('#birth_date').datetimepicker({
            format: 'YYYY-MM-DD HH:mm:ss',
            useCurrent: false
        })
    </script>
@endsection



<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Guardar', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('clients.index') !!}" class="btn btn-default">Cancelar</a>
</div>
