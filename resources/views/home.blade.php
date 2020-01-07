@extends('app')

@section('content')
    @include ('inc._header')

    <div class="page full-height">
        <div class="stores">
            <ul>
                <li>
                    <a href="https://www.submarino.com.br/" data-search="https://www.submarino.com.br/busca/">Submarino</a>
                </li>

                <li>
                    <a href="https://www.americanas.com.br/" data-search="https://www.americanas.com.br/busca/">Americanas</a>
                </li>

                <li>
                    <a href="https://www.mercadolivre.com.br/" data-search="https://lista.mercadolivre.com.br/">Mercado Livre</a>
                </li>
            </ul>
        </div>
    </div>
@endsection
