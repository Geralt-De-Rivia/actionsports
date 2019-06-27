<div class="form-group col-sm-6">
<!-- Dni Field -->
    <div class="form-group">
        {!! Form::label('dni', 'Dni:') !!}
        <p>{!! $client->dni !!}</p>
    </div>
</div>

<!-- Name Field -->
<div class="form-group col-sm-6">
    <div class="form-group">
        {!! Form::label('name', 'Nombre:') !!}
        <p>{!! $client->name !!}</p>
    </div>
</div>

<!-- Last Name Field -->
<div class="form-group col-sm-6">
    <div class="form-group">
        {!! Form::label('last_name', 'Apellidos:') !!}
        <p>{!! $client->last_name !!}</p>
    </div>
</div>
<!-- Phone Number Field -->
<div class="form-group col-sm-6">
    <div class="form-group">
        {!! Form::label('phone_number', 'Numero de celular:') !!}
        <p>{!! $client->phone_number !!}</p>
    </div>
</div>
<!-- Email Field -->
<div class="form-group col-sm-6">
    <div class="form-group">
        {!! Form::label('email', 'Correo electronico:') !!}
        <p>{!! $client->email !!}</p>
    </div>
</div>
<!-- Code Field -->
<div class="form-group col-sm-6">
    <div class="form-group">
        {!! Form::label('code', 'Codigo:') !!}
        <p>{!! $client->code !!}</p>
    </div>
</div>

<!-- Membership Number Field -->
<div class="form-group col-sm-6">
    <div class="form-group">
        {!! Form::label('membership_number', 'Número de socio:') !!}
        <p>{!! $client->membership_number !!}</p>
    </div>
</div>



<!-- Birth Date Field -->
<div class="form-group col-sm-6">
    <div class="form-group">
        {!! Form::label('birth_date', 'Fecha de cumpleaños:') !!}
        <p>{!! $client->birth_date !!}</p>
    </div>
</div>

<!-- Created At Field -->
<div class="form-group col-sm-6">
    <div class="form-group">
        {!! Form::label('created_at', 'Fecha de registro:') !!}
        <p>{!! $client->created_at !!}</p>
    </div>
</div>



