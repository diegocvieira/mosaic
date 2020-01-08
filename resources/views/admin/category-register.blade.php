{!! Form::open(['method' => 'POST', 'route' => 'save-category']) !!}
    {!! Form::text('name', null, ['placeholder' => 'Nome da categoria']) !!}

    {!! Form::submit('Enviar') !!}
{!! Form::close() !!}
