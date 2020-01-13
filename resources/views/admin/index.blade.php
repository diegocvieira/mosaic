@extends('app')

@section('content')
    <div class="page page-admin">
        <div class="span12 text-center" style="margin-top: 100px;">
            <a href="{{ route('admin.store.index') }}" class="btn btn-primary">LOJAS</a>

            <a href="{{ route('admin.category.index') }}" class="btn btn-primary" style="margin-left: 20px;">CATEGORIAS</a>
        </div>
    </div>
@endsection
