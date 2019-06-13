{!! Form::open(['route' => ['routines.destroy', $id], 'method' => 'delete']) !!}
<div class='btn-group'>
    <a href="{{ route('routines.show', $id) }}" class='btn btn-default btn-xs'>
        <i class="fa fa-eye"></i>
    </a>
    <a href="{{ route('routines.edit', $id) }}" class='btn btn-default btn-xs'>
        <i class="fa fa-edit"></i>
    </a>
    {!! Form::button('<i class="fa fa-trash"></i>', [
        'type' => 'submit',
        'class' => 'btn btn-danger btn-xs',
        'onclick' => "return confirm('Esta seguro que desea eliminar la rutina?')"
    ]) !!}
</div>
{!! Form::close() !!}
