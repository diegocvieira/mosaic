@extends('app')

@section('content')
    @include ('inc._header')

    <div class="page">
        <div class="stores">
            <ul>
                @foreach ($categories as $category)
                    <li>
                        {{ $category->name }}
                        ->>
                        @foreach ($category->stores as $store)
                            {{ $store->name }},
                        @endforeach
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
@endsection
