@extends('app')

@section('content')
    <div class="page page-admin">
        {!! Form::open(['method' => 'POST', 'route' => 'save-category', 'class' => 'p-5']) !!}
            @if (session('flash_message'))
                <div class="alert alert-info" role="alert">
                    {{ session('flash_message') }}
                </div>
            @endif

            <div class="form-group">
                {!! Form::label('name', 'Nome da categoria') !!}
                {!! Form::text('name', null, ['placeholder' => 'Esporte', 'id' => 'name', 'class' => 'form-control', 'required']) !!}
            </div>

            {!! Form::submit('Enviar', ['class' => 'btn btn-primary']) !!}
        {!! Form::close() !!}
    </div>
@endsection
