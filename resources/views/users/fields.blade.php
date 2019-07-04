<!-- Name Field -->
<div class="form-group col-sm-6">
    {!! Form::label('name', 'Nombre:') !!}
    {!! Form::text('name', null, ['class' => 'form-control']) !!}
</div>

<!-- Email Field -->
<div class="form-group col-sm-6">
    {!! Form::label('email', 'Email:') !!}
    {!! Form::email('email', null, ['class' => 'form-control']) !!}
</div>


<!-- Password Field -->
<div class="form-group col-sm-6">
    {!! Form::label('password', 'Password:') !!}
    {!! Form::password('password', ['class' => 'form-control']) !!}
</div>

<!-- Role Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('role_id', 'Rol:') !!}
    {!! Form::select('role_id',$roles ?? [], $class->role_id ?? null,['class'=>'form-control']) !!}  
</div>

<!-- Status Field -->
<div class="form-group col-sm-6">
    {!! Form::label('status', 'Estado:') !!}
    <div class="form-check">
        <label class="form-check-label">
            {!! Form::hidden('status', 0) !!}
            {!! Form::checkbox('status', '1', null) !!}
            <span class="form-check-sign">
            <span class="check"></span>
          </span>
        </label>
    </div>
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Guardar', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('users.index') !!}" class="btn btn-default">Cancelar</a>
</div>
