<!-- Id Field -->
<div class="form-group col-sm-6">
    <div class="form-group">
        {!! Form::label('id', 'Id:') !!}
        <p>{!! $user->id !!}</p>
    </div>
</div>
<!-- Name Field -->
<div class="form-group col-sm-6">
    <div class="form-group">
        {!! Form::label('name', 'Name:') !!}
        <p>{!! $user->name !!}</p>
    </div>
</div>
<!-- Email Field -->
<div class="form-group col-sm-6">
    <div class="form-group">
        {!! Form::label('email', 'Email:') !!}
        <p>{!! $user->email !!}</p>
    </div>
</div>
<!-- Email Verified At Field -->
<div class="form-group col-sm-6">
    <div class="form-group">
        {!! Form::label('email_verified_at', 'Email Verified At:') !!}
        <p>{!! $user->email_verified_at !!}</p>
    </div>
</div>
<!-- Password Field -->
<div class="form-group col-sm-6">
    <div class="form-group">
        {!! Form::label('password', 'Password:') !!}
        <p>{!! $user->password !!}</p>
    </div>
</div>
<!-- Role Id Field -->
<div class="form-group col-sm-6">
    <div class="form-group">
        {!! Form::label('role_id', 'Role Id:') !!}
        <p>{!! $user->role_id !!}</p>
    </div>
</div>
<!-- Status Field -->
<div class="form-group col-sm-6">
    <div class="form-group">
        {!! Form::label('status', 'Status:') !!}
        <p>{!! $user->status !!}</p>
    </div>
</div>
<!-- Remember Token Field -->
<div class="form-group col-sm-6">
    <div class="form-group">
        {!! Form::label('remember_token', 'Remember Token:') !!}
        <p>{!! $user->remember_token !!}</p>
    </div>
</div>
<!-- Created At Field -->
<div class="form-group col-sm-6">
    <div class="form-group">
        {!! Form::label('created_at', 'Created At:') !!}
        <p>{!! $user->created_at !!}</p>
    </div>
</div>
<!-- Updated At Field -->
<div class="form-group col-sm-6">
    <div class="form-group">
        {!! Form::label('updated_at', 'Updated At:') !!}
        <p>{!! $user->updated_at !!}</p>
    </div>
</div>
