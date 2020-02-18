@extends('app')

@section('content')
    <div class="page page-home">
        <header class="{{ !$stores->count() ? 'header-no-store' : '' }}">
            <a href="{{ route('home') }}" class="logo">
                <img src="{{ asset('images/logo-mosaic.png') }}" alt="Mosaic" />

                <span class="logo-name">Mosaico</span>
            </a>

            @if ($stores->count())
                {!! Form::open(['method' => 'GET', 'class' => 'form-search']) !!}
                    {!! Form::text('keyword', session('keyword'), ['placeholder' => 'Pesquisar em todas as lojas', 'autocomplete' => 'off']) !!}

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
                            <a href="{{ route('stores-filter-category', 'all') }}" class="stores-filter-category {{ (!session('filter_category') || session('filter_category') == 'all') ? 'active' : '' }}" data-slug="all">Todas as lojas</a>
                        </li>

                        @foreach ($categories as $category)
                            <li>
                                <a href="{{ route('stores-filter-category', $category->slug) }}" class="stores-filter-category {{ session('filter_category') == $category->slug ? 'active' : '' }} " data-slug="{{ $category->slug }}">{{ $category->name }}</a>
                            </li>
                        @endforeach
                    @endif
                </ul>
            </nav>
        </header>

        @if ($stores->count())
            <div class="stores">
                <h4 class="category-name">{{ (session('filter_category') && session('filter_category') != 'all') ? $stores->first()->categories[0]->name : 'Todas as lojas' }}</h4>

                @if (session('keyword'))
                    <span class="advice">Selecione uma loja para ver os produtos</span>
                @endif

                @foreach ($stores as $store)
                    <a href="{{ session('keyword') ? str_replace('__keyword__', session('keyword'), $store->url_search) : $store->url_home }}" data-search="{{ $store->url_search }}" class="store">
                        <img src="{{ asset('storage/uploads/' . $store->image) }}" alt="{{ $store->name }}" class="store-image" />

                        <h3 class="store-name">{{ $store->name }}</h3>
                    </a>
                @endforeach
            </div>
        @else
            <div class="no-store">
                <p>
                    Toque em <img src="{{ asset('images/icon-menu.png') }}" alt="" /> para adicionar<br>lojas ao seu Mosaico
                </p>
            </div>
        @endif
    </div>
@endsection
