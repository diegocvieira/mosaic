@extends('app')

@section('content')
    <div class="page page-admin">
        @if (isset($category))
            {!! Form::model($category, ['method' => 'PUT', 'route' => ['admin.category.update', $category->id], 'class' => 'p-5']) !!}
        @else
            {!! Form::open(['method' => 'POST', 'route' => 'admin.category.store', 'class' => 'p-5']) !!}
        @endif

            <div class="form-group">
                {!! Form::label('name', 'Nome da categoria') !!}
                {!! Form::text('name', null, ['placeholder' => 'Esporte', 'id' => 'name', 'class' => 'form-control', 'required']) !!}
            </div>

            {!! Form::submit('SALVAR', ['class' => 'btn btn-primary']) !!}
        {!! Form::close() !!}
    </div>
@endsection
