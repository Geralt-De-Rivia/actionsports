

<!-- Status Field -->
<div class="form-group col-sm-6">
    {!! Form::label('status', 'Estado:') !!}
    {!! Form::select('status',[
       'pending' => 'Pendiente',
       'canceled' => 'Cancelada',
       'finished' => 'Finalizada',
       'unfulfilled' => 'Inasistencia'
   ], null,['class'=>'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Guardar', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('classReservations.index') !!}" class="btn btn-default">Cancelar</a>
</div>
