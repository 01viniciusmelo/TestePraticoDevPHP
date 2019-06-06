@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
			<h3>Consulta de Produtos</h3>
			<p>
				<a href="produtos/create" class="btn btn-primary" role="button" aria-pressed="true">Novo Produto</a>
			</p>

			<table id="tabela" class="table table-bordered table-striped">
				<thead>
					<tr>
						<th>Descrição</th>
						<th>Categoria</th>
						<th colspan="1">Edição</th>
						<th colspan="1">Exclusão</th>
					</tr>
				</thead>
				<tbody>
					@foreach ($produtos as $produto)
					<tr>
						<td>{{ $produto->descricao }}</td>
						<td>{{ $produto->descricao_categoria }}</td>
						<td><a href="{{ action('ProdutosController@edit', $produto->id) }}" class="btn btn-warning" data-toggle="tooltip" data-placement="top" title="Editar">Editar</a></td>
						<td><a href="{{ url('produto', $produto->id) }}" class="btn btn-danger" data-toggle="tooltip" data-placement="top" title="Excluir">Excluir</a></td>
					</tr>
					@endforeach
				</tbody>
			</table>

    	</div>
    </div>
</div>
@endsection
