{!! Form::open(['route' => ['keys.destroy', $id], 'method' => 'delete']) !!}
<div class='btn-group'>
    <a href="{{ route('keys.edit', $id) }}" class='btn btn-default btn-xs'>
        <i class="glyphicon glyphicon-edit"></i>
    </a>
    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', [
        'type' => 'submit',
        'class' => 'btn btn-danger btn-xs',
        'onclick' => "return confirm('Esta seguro que desea eliminar la llave?')"
    ]) !!}
</div>
{!! Form::close() !!}
