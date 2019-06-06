@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
			<h3>Consulta de Categorias</h3>
			<p>
				<a href="categorias/create" class="btn btn-primary" role="button" aria-pressed="true">Nova Categoria</a>
			</p>

			<table id="tabela" class="table table-bordered table-striped">
				<thead>
					<tr>
						<th>Descrição</th>
						<th colspan="1">Edição</th>
						<th colspan="1">Exclusão</th>
					</tr>
				</thead>
				<tbody>
					@foreach ($categorias as $categoria)
					<tr>
						<td>{{ $categoria->descricao }}</td>
						<td><a href="{{ action('CategoriasController@edit', $categoria->id) }}" class="btn btn-warning" data-toggle="tooltip" data-placement="top" title="Editar">Editar</a></td>
						<td><a href="{{ url('categoria', $categoria->id) }}" class="btn btn-danger" data-toggle="tooltip" data-placement="top" title="Excluir">Excluir</a></td>
					</tr>
					@endforeach
				</tbody>
			</table>

    	</div>
    </div>
</div>
@endsection
