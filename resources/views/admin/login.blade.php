@extends('app')

@section('content')
    <div class="page page-admin">
        {!! Form::open(['method' => 'POST', 'route' => 'admin-send-login', 'class' => 'p-5']) !!}
            @if (session('flash_message'))
                <div class="alert alert-info" role="alert">
                    {{ session('flash_message') }}
                </div>
            @endif

            <div class="form-group">
                {!! Form::label('password', 'Senha') !!}
                {!! Form::input('password', 'password', null, ['id' => 'password', 'class' => 'form-control', 'required']) !!}
            </div>

            {!! Form::submit('Enviar', ['class' => 'btn btn-primary']) !!}
        {!! Form::close() !!}
    </div>
@endsection
