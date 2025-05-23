<?php

namespace App\Http\Controllers;

use App\Http\Requests\SaveProductRequest;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\Product;

class ProductsController extends Controller
{
    public function index()
    {
        return view('products/index', [
            'products' => Product::with('category')->paginate(10),
        ]);
    }

    public function create()
    {
        return view('products/form', [
            'categories' => Category::all(),
        ]);
    }

    public function store(SaveProductRequest $request)
    {
        Product::create($request->data());
        return redirect()->route('products.index')->with('success', 'Товар добавлен.');
    }

    public function show($id)
    {
        return view('products/view', [
            'product' => Product::findOrFail($id),
        ]);
    }

    public function edit($id)
    {
        return view('products/form', [
            'product' => Product::findOrFail($id),
            'categories' => Category::all(),
        ]);
    }

    public function update(SaveProductRequest $request, $id)
    {
        Product::findOrFail($id)->update($request->data());
        return redirect()->route('products.index')->with('success', 'Товар обновлен.');
    }

    public function destroy($id)
    {
        Product::findOrFail($id)->delete();
        return redirect()->route('products.index')->with('success', 'Товар удален.');
    }
}
