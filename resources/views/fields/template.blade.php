@if(isset($extraFields))
    @foreach($extraFields as $field)
        @switch($field->type)
            @case('text')
            <div class="form-group col-sm-6">
                {!! Form::label('property_'.$field->id, $field->label) !!}
                {!! Form::text('property_'.$field->id, null, ['class' => 'form-control']) !!}
            </div>
            @break
            @case('number')
            <div class="form-group col-sm-6">
                {!! Form::label('property_'.$field->id, $field->label) !!}
                {!! Form::number('property_'.$field->id, null, ['class' => 'form-control']) !!}
            </div>
            @break
            @case('link')
            <div class="form-group col-sm-6">
                {!! Form::label('property_'.$field->id, $field->label) !!}
                {!! Form::text('property_'.$field->id, null, ['class' => 'form-control']) !!}
            </div>
            @break
            @case('image')
            <div class="form-group col-sm-6">
                {!! Form::label('property_'.$field->id, $field->label) !!}
                {!! Form::text('property_'.$field->id, null, ['class' => 'form-control']) !!}
            </div>
            @break
            @case('color')
            <div class="form-group col-sm-6">
                {!! Form::label('property_'.$field->id, $field->label) !!}
                {!! Form::color('property_'.$field->id, null, ['class' => 'form-control']) !!}
            </div>
            @break
            @case('textarea')
            <div class="form-group col-sm-6">
                {!! Form::label('property_'.$field->id, $field->label) !!}
                {!! Form::textarea('property_'.$field->id, null, ['class' => 'form-control']) !!}
            </div>
            @break
        @endswitch
    @endforeach
@endif

