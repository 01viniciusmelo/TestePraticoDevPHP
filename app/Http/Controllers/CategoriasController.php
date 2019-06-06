<?php
namespace App\Http\Controllers;

use App\Models\Categorias;
use Illuminate\Http\Request;

class CategoriasController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categorias = Categorias::where([
            [
                'status',
                '1',
            ],
        ])
            ->orderBy('id', 'desc')
            ->get();

        return view('categorias.index', [
            'categorias' => $categorias,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('categorias.create');
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
            [
                'descricao.required' => 'A descrição é obrigatória.',
            ]
        );

        $categoria = new Categorias();

        $categoria->descricao = $request->input('descricao');

        $categoria->save();

        return redirect('categorias')->with('success', 'Nova Categoria adicionada.');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $categoria = Categorias::findOrFail($id);
        return view('categorias.edit', [
            'categoria' => $categoria,
            'id' => $id,
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
        $categoria = Categorias::findOrFail($id);

        $this->validate(request(), [
            'descricao' => 'required',
        ],
            [
                'descricao.required' => 'A descrição é obrigatória.',
            ]
        );

        $categoria->descricao = $request->get('descricao');

        $categoria->save();

        return redirect('categorias')->with('success', 'Uma Categoria foi atualizada.');
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
        $categorias = Categorias::where('status', '1')->get();

        if ($categorias->count() == 1) {
            return redirect('categorias')->withErrors([
                'message' => 'Não é permitido excluir a categoria selecionada.',
            ]);
        }

        $categoria = Categorias::findOrFail($id);
        $categoria->status = 0;
        $categoria->save();

        return redirect('categorias')->with('success', 'Uma Categoria foi excluída.');
    }
}
