<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $product = Product::with('category')->get();
        $products = Product::paginate(3);
        return view('products.index', get_defined_vars());
    }


    public function create()
    {
        $category = Category::all();
        return view('products.create' , get_defined_vars());
    }
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0.01',
            'quantity' => 'required|integer|min:1',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'description' => 'required|string|max:1000',
        ]);
        // dd($request->all());

        $image = time() . '.' . $request->image->extension();
        $request->image->move(public_path('products'), $image);

        $product = new Product;
        $product->name = $request->name;
        $product->price = $request->price;
        $product->quantity = $request->quantity;
        $product->category_id=$request->category_id;
        $product->image = $image;
        $product->description = $request->description;
        $response = $product->save();
        if ($response == true) {
            return redirect('/product')->with('success', 'Form data submitted successfully!');
        }
        return redirect('products/create');
    }

    public function delete($id)
    {
        // dd($id);
        $product = Product::find($id);
        $product->delete();

        return redirect('/product');
    }

    public function edit($id)
    {
        $product = Product::find($id);
        $category = Category::all();
        return view('products.edit', get_defined_vars());
    }

    public function update($id, Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:1',
            'quantity' => 'required|integer|min:1',
            'description' => 'required|string|max:1000',
        ]);
        $product = Product::find($id);
        if (isset($request->image)) {

            $image = time() . '.' . $request->image->extension();
            $request->image->move(public_path('products'), $image);
            $product->image = $image;
        }

        $product->name = $request->name;
        $product->price = $request->price;
        $product->quantity = $request->quantity;
        $product->category_id=$request->category_id;
        $product->description = $request->description;
        $product->update();
        return redirect('/product')->with('success', 'Form data Updated successfully!');
    }
}
