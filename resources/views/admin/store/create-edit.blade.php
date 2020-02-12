@extends('app')

@section('content')
    <div class="page page-admin">
        @if (isset($store))
            {!! Form::model($store, ['method' => 'PUT', 'route' => ['admin.store.update', $store->id], 'files' => true, 'class' => 'p-5']) !!}
        @else
            {!! Form::open(['method' => 'POST', 'route' => 'admin.store.store', 'files' => true, 'class' => 'p-5']) !!}
        @endif

            <div class="form-group">
                {!! Form::label('name', 'Nome da loja') !!}
                {!! Form::text('name', null, ['placeholder' => 'Naslojas', 'id' => 'name', 'class' => 'form-control-file', 'required']) !!}
            </div>

            <div class="form-group">
                {!! Form::label('url_home', 'Url principal da loja') !!}
                {!! Form::text('url_home', null, ['placeholder' => 'https://www.naslojas.com', 'id' => 'url_home', 'class' => 'form-control', 'required']) !!}
            </div>

            <div class="form-group">
                {!! Form::label('url_search', 'Url de busca da loja') !!}
                {!! Form::text('url_search', null, ['placeholder' => 'https://www.naslojas.com/busca/__keyword__', 'id' => 'url_search', 'class' => 'form-control', 'required']) !!}
            </div>

            <div class="form-group">
                {!! Form::label('image', 'Imagem da loja') !!}
                {!! Form::file('image', null, ['id' => 'url_search', 'class' => 'form-control', 'required']) !!}
            </div>

            <div class="form-group form-check">
                @foreach ($categories as $category)
                    {!! Form::checkbox('category[]', $category->id, (isset($store) && in_array($category->id, $store_categories)) ? true : false, ['class' => 'form-check-input', 'id' => 'category-' . $category->slug]) !!}
                    {!! Form::label('category-' . $category->slug, $category->name) !!}
                    <br>
                @endforeach
            </div>

            {!! Form::submit('SALVAR', ['class' => 'btn btn-primary']) !!}
        {!! Form::close() !!}
    </div>
@endsection
