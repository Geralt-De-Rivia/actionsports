<div class='btn-group'>
    {{--<a href="{{ route('clients.show', $id) }}" class='btn btn-default btn-xs'>--}}
    {{--<i class="fa fa-eye"></i>--}}
    {{--</a>--}}
    <a href="{{ route('clients.edit', $id) }}" class='btn btn-default btn-xs'>
        <i class="fa fa-edit"></i>
    </a>
    @if($model->client_status_id==2)
        {!! Form::open(['route' => ['clients.update', $id], 'method' => 'put']) !!}
        <input type="hidden" name="client_status_id" value="3">
        {!! Form::button('<i class="fa fa-times"></i>', [
            'type' => 'submit',
            'class' => 'btn btn-danger btn-xs',
            'onclick' => "return confirm('Esta seguro de actualizar el estado del cliente?')"
        ]) !!}
        {!! Form::close() !!}
    @else
        {!! Form::open(['route' => ['clients.update', $id], 'method' => 'put']) !!}
        <input type="hidden" name="client_status_id" value="2">
        {!! Form::button('<i class="fa fa-check"></i>', [
            'type' => 'submit',
            'class' => 'btn btn-success btn-xs',
            'onclick' => "return confirm('Esta seguro de actualizar el estado del cliente?')"
        ]) !!}
        {!! Form::close() !!}
    @endif


</div>
