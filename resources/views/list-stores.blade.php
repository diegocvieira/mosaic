@extends('app')

@section('content')
    <div class="page page-list-stores">
        <header class="header-simple">
            <a href="{{ route('home') }}" class="back-link">VOLTAR</a>
        </header>

        <div class="list-categories">
            @foreach ($categories as $category)
                <div class="item">
                    <button type="button" class="category-name">{{ $category->name }}</button>

                    <div class="list-stores">
                        @foreach ($category->stores as $store)
                            <div class="store" data-storeid="{{ $store->id }}">
                                <h3 class="store-name">{{ $store->name }}</h3>

                                <div class="store-status">
                                    <span class="switch {{ _isStoreActive($store->id) ? 'active' : '' }}"></span>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endforeach
        </div>

        <div class="suggest-store">
            <h4>SUGERIR LOJA</h4>

            {!! Form::open(['method' => 'POST', 'route' => 'store-suggest']) !!}
                {!! Form::text('store_name', null, ['placeholder' => 'Nome da loja']) !!}

                {!! Form::text('store_url', null, ['placeholder' => 'Site da loja']) !!}

                {!! Form::submit('ENVIAR') !!}
            {!! Form::close() !!}
        </div>
    </div>
@endsection
