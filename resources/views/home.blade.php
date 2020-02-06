@extends('app')

@section('content')
    <div class="page page-home">
        <header class="{{ !$stores->count() ? 'header-no-store' : '' }}">
            <a href="{{ route('home') }}" class="logo">
                <img src="{{ asset('images/logo-mosaic.png') }}" alt="Mosaic" />

                <span class="logo-name">Mosaic</span>
            </a>

            @if ($stores->count())
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

                    @if ($stores->count())
                        <li>
                            <a href="{{ route('stores-filter-category', 'all') }}" class="stores-filter-category {{ (!session('filter_category') || session('filter_category') == 'all') ? 'active' : '' }}">Todas as lojas</a>
                        </li>

                        @foreach ($categories as $category)
                            <li>
                                <a href="{{ route('stores-filter-category', $category->slug) }}" class="stores-filter-category {{ session('filter_category') == $category->slug ? 'active' : '' }} ">{{ $category->name }}</a>
                            </li>
                        @endforeach
                    @endif
                </ul>
            </nav>
        </header>

        @if ($stores->count())
            <div class="stores" data-routestores="{{ $route_stores }}">
                <ul>
                    @foreach ($stores as $key => $store)
                        <li>
                            <a href="{{ $store->url_home }}" data-search="{{ $store->url_search }}" data-slug="{{ $store->slug }}" class="{{ $key == 0 ? 'active' : '' }}">{{ $store->name }}</a>
                        </li>
                    @endforeach
                </ul>
            </div>

            <div class="iframes">
                @foreach ($stores->take(4) as $key => $store)
                    <iframe src="{{ $store->url_home }}" is="x-frame-bypass" data-slug="{{ $store->slug }}" class="{{ $key == 0 ? 'active' : '' }}"></iframe>
                @endforeach
            </div>

            <?php /*<div class="no-store">
                <p>
                    Selecione uma loja antes de<br>fazer a sua pesquisa
                </p>
            </div>*/ ?>
        @else
            <div class="no-store">
                <p>
                    Toque em <img src="{{ asset('images/icon-menu.png') }}" alt="" /> para adicionar<br>lojas ao seu Mosaic
                </p>
            </div>
        @endif
    </div>
@endsection
