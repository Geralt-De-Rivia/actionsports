{!! Form::open(['route' => ['machines.destroy', $id], 'method' => 'delete']) !!}
<div class='btn-group'>
    <a href="{{ route('machines.show', $id) }}" class='btn btn-success btn-xs'>
        <i class="fa fa-eye"></i>
    </a>
    <a href="{{ route('machines.edit', $id) }}" class='btn btn-info btn-xs'>
        <i class="fa fa-edit"></i>
    </a>
    {!! Form::button('<i class="fa fa-trash"></i>', [
        'type' => 'submit',
        'class' => 'btn btn-danger btn-xs',
        'onclick' => "return confirm('Esta seguro que desea eliminar la máquina?')"
    ]) !!}
</div>
{!! Form::close() !!}
