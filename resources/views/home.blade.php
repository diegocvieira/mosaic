@php
    header("X-Frame-Options: SAMEORIGIN");
@endphp

@extends('app')

@section('content')
    @include ('inc._header')

    <div class="page full-height">
        <div class="stores">
            <ul>
                @foreach ($stores as $store)
                    <li>
                        <a href="{{ $store->url_home }}" data-search="{{ $store->url_search }}">{{ $store->name }}</a>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
@endsection
