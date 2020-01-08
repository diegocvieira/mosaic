{!! Form::open(['method' => 'POST', 'route' => 'save-store']) !!}
    {!! Form::text('name', null, ['placeholder' => 'Nome da loja']) !!}
    {!! Form::text('url_home', null, ['placeholder' => 'Url home da loja']) !!}
    {!! Form::text('url_search', null, ['placeholder' => 'Url busca da loja']) !!}

    @foreach ($categories as $category)
        {!! Form::checkbox('category[]', $category->id) !!} {{ $category->name }}
    @endforeach

    {!! Form::submit('Enviar') !!}
{!! Form::close() !!}
