{!! Form::open(['route' => ['classReservations.destroy', $id], 'method' => 'delete']) !!}
<div class='btn-group'>
   {{-- <a href="{{ route('classReservations.show', $id) }}" class='btn btn-default btn-xs'>
        <i class="glyphicon glyphicon-eye-open"></i>
    </a>--}}
    <a href="{{ route('classReservations.edit', $id) }}" class='btn btn-default btn-xs'>
        <i class="glyphicon glyphicon-edit"></i>
    </a>
    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', [
        'type' => 'submit',
        'class' => 'btn btn-danger btn-xs',
        'onclick' => "return confirm('Seguro??')"
    ]) !!}
</div>
{!! Form::close() !!}
