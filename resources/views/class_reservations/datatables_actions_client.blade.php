@if(!empty($model))
    <a href="/clients/{{$model->client->id}}">{{$model->client->dni}}</a>
@endif
