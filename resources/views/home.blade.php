@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Consultas</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <p>
                        <div class="row">
                            <div class="col-md-4">
                                <a href="categorias" class="btn btn-primary btn-lg" role="button" aria-pressed="true">Consulta de Categorias</a>
                            </div>
                            <div class="col-md-4">
                                <a href="produtos" class="btn btn-primary btn-lg" role="button" aria-pressed="true">Consulta de Produtos</a>
                            </div>
                        </div>
                    </p>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection
