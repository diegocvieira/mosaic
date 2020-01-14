@extends('app')

@section('content')
    <div class="page page-admin p-5">
        <h1 style="float: left;">Categorias</h1>

        <a href="{{ route('admin.category.create') }}" class="btn btn-primary" style="float: right;">CADASTRAR</a>

        <div class="table-responsive" style="margin-top: 100px;">
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th>Nome</th>
                        <th>Data criação</th>
                        <th>Data edição</th>
                        <th>Editar</th>
                        <th>Excluir</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($categories as $category)
                        <tr>
                            <td>{{ $category->name }}</td>
                            <td>{{ date('d/m/Y', strtotime($category->created_at)) }}</td>
                            <td>{{ date('d/m/Y', strtotime($category->updated_at)) }}</td>
                            <td><a href="{{ route('admin.category.edit', $category->id) }}" class="btn btn-primary">EDITAR</a></td>
                            <td><a href="{{ route('admin.category.destroy', $category->id) }}" class="btn btn-primary delete-button">EXCLUIR</a></td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
