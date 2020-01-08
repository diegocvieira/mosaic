<header>
    <a href="{{ route('home') }}" class="logo">
        <img src="{{ asset('images/logo-mosaic.png') }}" alt="Mosaic" />
    </a>

    {!! Form::open(['method' => 'GET', 'class' => 'form-search']) !!}
        {!! Form::text('keyword', null, ['placeholder' => 'Pesquisar produto', 'autocomplete' => 'off']) !!}

        {!! Form::submit('') !!}
    {!! Form::close() !!}

    <nav>
        <button type="button" class="open-menu"></button>

        <ul>
            <li>
                <a href="#">EDITAR LOJAS</a>
            </li>

            @foreach ($categories as $category)
                <li>
                    <a href="{{ route('stores-filter-category', $category->slug) }}" class="stores-filter-category">{{ $category->name }}</a>
                </li>
            @endforeach
        </ul>
    </nav>
</header>
