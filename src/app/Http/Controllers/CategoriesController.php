<?php

namespace App\Http\Controllers;

use App\Http\Requests\SaveCategoryRequest;
use Illuminate\Http\Request;
use App\Models\Category;

class CategoriesController extends Controller
{
    public function index()
    {
        return view('categories/index', [
            'categories' => Category::all(),
        ]);
    }

    public function create(SaveCategoryRequest $saveCategoryRequest)
    {
        $data = $saveCategoryRequest->validated();
        Category::create(['name' => $data['create_name']]);
        return redirect()->route('categories.index')->with('success', 'Категория создана.');
    }

    public function update(SaveCategoryRequest $saveCategoryRequest, $id)
    {
        $data = $saveCategoryRequest->validated();
        Category::where('id', $id)->update(['name' => $data['update_name'][$id]]);
        return redirect()->route('categories.index')->with('success', 'Категория обновлена.');
    }

    public function destroy($id)
    {
        Category::where('id', $id)->delete();
        return redirect()->route('categories.index')->with('success', 'Категория удалена.');
    }
}
