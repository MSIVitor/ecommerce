<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        // Buscar todos os produtos no banco de dados
        $products = Product::all();

        // Passar os produtos para a view
        return view('products.index', compact('products'));
    }

    public function show($id)
    {
        $product = Product::findOrFail($id);
        return view('products.show', compact('product'));
    }


    public function dashboard()
    {
        $products = Product::all();
        return view('dashboard', compact('products'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'price' => 'required|numeric',
            'image' => 'required|url'
        ]);

        Product::create($request->all());

        return redirect()->route('dashboard')->with('success', 'Produto adicionado com sucesso!');
    }

    public function edit(Product $product)
    {
        return response()->json($product);
    }

    public function update(Request $request, Product $product)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'price' => 'required|numeric',
            'image' => 'required|url'
        ]);

        $product->update($request->all());

        return redirect()->route('dashboard')->with('success', 'Produto atualizado com sucesso!');
    }

    public function destroy(Product $product)
    {
        $product->delete();

        return redirect()->route('dashboard')->with('success', 'Produto removido com sucesso!');
    }
}
