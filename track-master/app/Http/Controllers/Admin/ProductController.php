<?php

namespace App\Http\Controllers\Admin;

use App\Models\Product;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;


class ProductController extends Controller
{
    public function index(Request $request)
    {
        $pesquisa = $request->criterio;
        $data = Product::when(!empty($pesquisa), function ($query) use ($pesquisa) {
                return $query->where('title','like' , '%'. $pesquisa .'%');})
            ->orderBy('name', 'asc')
            ->paginate(10);

        return view('products.index', compact('data'));
    }

    public function create()
    {
        return view('products.create');
    }
    public function sale($id)
    {
        $item = Product::findOrFail($id);
        
        return view('products.sale', compact('item'));
    }

    public function store(Request $request)
    {
        Validator::make(
            $request->all(),
            $this->rules($request)
        )->validate();


        $inputs = $request->all();
        Product::create($inputs);

        return redirect()->route('products.index')
            ->withStatus('Registro criado com sucesso.');
    }

    public function show($id)
    {
        $item = Product::findOrFail($id);

        return view('products.show', compact('item'));
    }

    public function edit($id)
    {
        $item = Product::orderBy('description')->findOrFail($id);

        return view('products.edit', compact('item'));
    }
   

    public function update(Request $request, $id)
    {
        $item = Product::findOrFail($id);

        Validator::make(
            $request->all(),
            $this->rules($request, $item->getKey())
        )->validate();


        $item->fill($request->all())->save();

        return redirect()->route('products.index')
            ->withStatus('Registro atualizado com sucesso.');
    }

    public function destroy($id)
    {
        $item = Product::findOrFail($id);

        try {
            $item->delete();
            return redirect()->route('products.index')
                ->withStatus('Registro deletado com sucesso.');
        } catch (\Exception $e) {
            return redirect()->route('products.index')
                ->withError('Registro vinculado á outra tabela, somente poderá ser excluído se retirar o vinculo.');
        }
    }

    private function rules(Request $request, $primaryKey = null, bool $changeMessages = false)
    {
        $rules = [
            'name' => ['required'],
            'ncm' => ['required'],
            'cest' => ['required'],
            'cod' => ['required'],
            'amount' => ['required'],
            'weight' => ['required'],
            'unit' => ['required'],
            'origin' => ['required'],
            'subtotal' => ['required'],
            'total' => ['required'],
        ];

        $messages = [];

        return !$changeMessages ? $rules : $messages;
    }
}
