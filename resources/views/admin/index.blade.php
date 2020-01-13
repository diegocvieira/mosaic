@extends('app')

@section('content')
    <div class="page page-admin">
        <div class="span12 text-center" style="margin-top: 100px;">
            <a href="{{ route('admin-show-store-register') }}" class="btn btn-primary">CADASTRAR LOJA</a>

            <a href="{{ route('admin-show-category-register') }}" class="btn btn-primary" style="margin-left: 20px;">CADASTRAR CATEGORIA</a>
        </div>
    </div>
@endsection
