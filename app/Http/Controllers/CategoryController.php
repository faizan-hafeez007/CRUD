<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        return view('category.index', get_defined_vars());
    }
    public function create()
    {
        return view("category.create");
    }
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required',
            'tag' => 'required',
        ]);
        $category = new Category();
        $category->name = $request->name;
        $category->tag = $request->tag;
        $response = $category->save();
        if ($response == true) {
            return redirect('/category');
        }
        return redirect('/category/create');
    }
    public function edit($id)
    {
        $category = Category::find($id);
        return view('category.edit', get_defined_vars());
    }
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'name' => 'required',
            'tag' => 'required',
        ]);
        
        $category = Category::find($id);
        $category->name = $request->name;
        $category->tag = $request->tag;
        $category->update();

        return redirect('/category');
    }
    public function delete($id)
    {
        $category = Category::find($id);
        $category->delete();
        return redirect('/category');
    }
}
