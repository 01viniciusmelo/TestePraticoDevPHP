<?php
namespace App\Http\Controllers;

use App\Models\Categorias;
use App\Models\Produtos;
use Illuminate\Http\Request;

class ProdutosController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $produtos = Produtos::join('categorias', 'produtos.categoria_id', '=', 'categorias.id')
            ->select('produtos.*', 'categorias.descricao as descricao_categoria')
            ->where([
                [
                    'produtos.status',
                    '1',
                ],
            ])
            ->get();

        return view('produtos.index', [
            'produtos' => $produtos,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $lista_categorias = Categorias::pluck('descricao', 'id');
        return view('produtos.create', [
            'lista_categorias' => $lista_categorias,
        ]);
    }

    /**
     * Store data.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'descricao' => 'required',
        ],
            ['descricao.required' => 'A descrição é obrigatória.']
        );

        $produto = new Produtos();

        $produto->descricao = $request->input('descricao');
        $produto->categoria_id = $request->input('categoria_id');

        $produto->save();

        return redirect('produtos')->with('success', 'Novo Produto adicionado.');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $produto = Produtos::findOrFail($id);
        $lista_categorias = Categorias::pluck('descricao', 'id');
        return view('produtos.edit', [
            'produto' => $produto,
            'id' => $id,
            'lista_categorias' => $lista_categorias,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $produto = Produtos::findOrFail($id);

        $this->validate(request(), [
            'descricao' => 'required',
        ], [
            'descricao.required' => 'A descrição é obrigatória.',
        ]);

        $produto->descricao = $request->get('descricao');
        $produto->categoria_id = $request->get('categoria_id');

        $produto->save();

        return redirect('produtos')->with('success', 'Um Produto foi atualizado.');
    }

    /**
     * Desativar registro
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function desativar($id)
    {
        $produtos = Produtos::where('status', '1')->get();

        if ($produtos->count() == 1) {
            return redirect('produtos')->withErrors([
                'message' => 'Não é permitido excluir a produto selecionado.',
            ]);
        }

        $produto = Produtos::findOrFail($id);
        $produto->status = 0;
        $produto->save();

        return redirect('produtos')->with('success', 'Um Produto foi excluído.');
    }
}
