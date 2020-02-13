@extends('app')

@section('content')
    <div class="page page-admin p-5">
        <h1 style="float: left;">Lojas</h1>

        <a href="{{ route('admin.store.create') }}" class="btn btn-primary" style="float: right;">CADASTRAR</a>

        <div class="table-responsive" style="margin-top: 100px;">
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th>Imagem</th>
                        <th>Nome</th>
                        <th>Url principal</th>
                        <th>Url busca</th>
                        <th>Data criação</th>
                        <th>Data edição</th>
                        <th>Editar</th>
                        <th>Excluir</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($stores as $store)
                        <tr>
                            <td><img src="{{ asset('storage/uploads/' . $store->image) }}" alt="{{ $store->name }}" style="width: 25px; height: 25px; object-fit: cover; object-position: center;" /></td>
                            <td>{{ $store->name }}</td>
                            <td>{{ $store->url_home }}</td>
                            <td>{{ $store->url_search }}</td>
                            <td>{{ date('d/m/Y', strtotime($store->created_at)) }}</td>
                            <td>{{ date('d/m/Y', strtotime($store->updated_at)) }}</td>
                            <td><a href="{{ route('admin.store.edit', $store->id) }}" class="btn btn-primary">EDITAR</a></td>
                            <td><a href="{{ route('admin.store.destroy', $store->id) }}" class="btn btn-primary delete-button">EXCLUIR</a></td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
