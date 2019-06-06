@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
			<h3>Editar Produto</h3>

			{!! Form::model($produto, ['route' => ['produtos.update', $produto->id], 'class' => 'form', 'method' => 'post']) !!} {!! Form::hidden('_method', 'PATCH') !!}
			<div class="row">
					<div class="form-group col-md-4 input-group-lg">{!! Form::label('descricao', 'Descrição') !!} {!! Form::text('descricao', null, ['class' =>
						'form-control', 'maxlength' => 100, 'autocomplete' => 'off']) !!}</div>
					<div class="form-group col-md-4 input-group-lg">{!! Form::label('categoria_id', 'Categorias') !!} {!! Form::select('categoria_id', $lista_categorias,
						null, ['class' => 'form-control']) !!}</div>
				</div>
				<div class="row">
					<div class="form-group col-md-4"></div>
					<div class="form-group col-md-4">{!! Form::submit('Salvar Alteração', ['class' => 'btn btn-success btn-lg', 'style' => 'margin-left: 38px']) !!}</div>
				</div>
			{!! Form::close() !!}

		</div>
	</div>
</div>
@endsection
