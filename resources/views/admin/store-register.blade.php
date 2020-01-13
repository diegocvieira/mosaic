@extends('app')

@section('content')
    <div class="page page-admin">
        {!! Form::open(['method' => 'POST', 'route' => 'save-store', 'class' => 'p-5']) !!}
            @if (session('flash_message'))
                <div class="alert alert-info" role="alert">
                    {{ session('flash_message') }}
                </div>
            @endif

            <div class="form-group">
                {!! Form::label('name', 'Nome da loja') !!}
                {!! Form::text('name', null, ['placeholder' => 'Naslojas', 'id' => 'name', 'class' => 'form-control', 'required']) !!}
            </div>

            <div class="form-group">
                {!! Form::label('url_home', 'Url principal da loja') !!}
                {!! Form::text('url_home', null, ['placeholder' => 'https://www.naslojas.com', 'id' => 'url_home', 'class' => 'form-control', 'required']) !!}
            </div>

            <div class="form-group">
                {!! Form::label('url_search', 'Url de busca da loja') !!}
                {!! Form::text('url_search', null, ['placeholder' => 'https://www.naslojas.com/busca/__keyword__', 'id' => 'url_search', 'class' => 'form-control', 'required']) !!}
            </div>

            <div class="form-group form-check">
                @foreach ($categories as $category)
                    {!! Form::checkbox('category[]', $category->id, null, ['class' => 'form-check-input', 'id' => 'category-' . $category->slug]) !!}
                    {!! Form::label('category-' . $category->slug, $category->name) !!}
                    <br>
                @endforeach
            </div>

            {!! Form::submit('Enviar', ['class' => 'btn btn-primary']) !!}
        {!! Form::close() !!}
    </div>
@endsection
