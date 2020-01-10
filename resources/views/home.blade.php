@extends('app')

@section('content')
    <div class="page page-home">
        <header class="{{ !_getStoreCookie() ? 'header-no-store' : '' }}">
            <a href="{{ route('home') }}" class="logo">
                <img src="{{ asset('images/logo-mosaic.png') }}" alt="Mosaic" />

                <span class="logo-name">Mosaic</span>
            </a>

            @if (_getStoreCookie())
                {!! Form::open(['method' => 'GET', 'class' => 'form-search']) !!}
                    {!! Form::text('keyword', null, ['placeholder' => 'Pesquisar produto', 'autocomplete' => 'off']) !!}

                    {!! Form::submit('') !!}
                {!! Form::close() !!}
            @endif

            <nav>
                <button type="button" class="open-menu"></button>

                <ul>
                    <li>
                        <a href="{{ route('stores-list') }}">EDITAR LOJAS</a>
                    </li>

                    @if (_getStoreCookie())
                        <li>
                            <a href="{{ route('stores-filter-category') }}" class="stores-filter-category active">Todos</a>
                        </li>

                        @foreach ($categories as $category)
                            <li>
                                <a href="{{ route('stores-filter-category', $category->slug) }}" class="stores-filter-category">{{ $category->name }}</a>
                            </li>
                        @endforeach
                    @endif
                </ul>
            </nav>
        </header>

        @if (_getStoreCookie())
            <div class="stores">
                <ul>
                    @foreach ($stores as $store)
                        <li>
                            <a href="{{ $store->url_home }}" data-search="{{ $store->url_search }}">{{ $store->name }}</a>
                        </li>
                    @endforeach
                </ul>
            </div>
        @else
            <div class="no-store">
                <p>
                    Toque em <img src="{{ asset('images/icon-menu.png') }}" alt="" /> para adicionar<br>lojas ao seu Mosaic
                </p>
            </div>
        @endif
    </div>
@endsection
