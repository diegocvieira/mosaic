@extends('app')

@section('content')
    <div class="page page-home">
        <header class="{{ !$categories->count() ? 'header-no-store' : '' }}">
            <a href="{{ route('home') }}" class="logo">
                <img src="{{ asset('images/logo-mosaic.png') }}" alt="Mosaic" />

                <span class="logo-name">Mosaic</span>
            </a>

            @if ($categories->count())
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

                    @if ($categories->count())
                        <li>
                            <a href="{{ route('stores-filter-category', 'all') }}" class="stores-filter-category {{ (!session('filter_category') || session('filter_category') == 'all') ? 'active' : '' }}">Todas as lojas</a>
                        </li>

                        @foreach ($categories_filter as $category)
                            <li>
                                <a href="{{ route('stores-filter-category', $category->slug) }}" class="stores-filter-category {{ session('filter_category') == $category->slug ? 'active' : '' }} ">{{ $category->name }}</a>
                            </li>
                        @endforeach
                    @endif
                </ul>
            </nav>
        </header>

        @if ($categories->count())
            <div class="stores">
                @foreach ($categories as $category)
                    <h4 class="category-name">{{ $category->name }}</h4>

                    @if (session('keyword'))
                        <span class="advice">Selecione uma loja para ver os produtos</span>
                    @endif

                    @foreach ($category->stores as $store)
                        <a href="{{ session('keyword') ? str_replace('__keyword__', session('keyword'), $store->url_search) : $store->url_home }}" data-search="{{ $store->url_search }}" class="store">
                            <!-- <div class="store-image"> -->
                            <img src="{{ asset('storage/uploads/' . $store->image) }}" alt="{{ $store->name }}" class="store-image" />
                            <!-- </div> -->

                            <h3 class="store-name">{{ $store->name }}</h3>
                        </a>
                    @endforeach
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
