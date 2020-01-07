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

            <li>
                <a href="#">Teste</a>
            </li>
        </ul>
    </nav>
</header>
