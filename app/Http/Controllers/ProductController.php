<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(){
        $products = Product::all();
        return view('products.index',get_defined_vars() );
    }

    public function create(){

        return view ('products.create');
    }
    public function store(Request $request){
        $validated = $request->validate([
            'name' => 'required',
            'price' => 'required',
            'description' => 'required',
        ]);

        $product = new Product;
        $product->name = $request->name;
        $product->price = $request->price;
        $product->description = $request->description;
        $response= $product->save();
        if ($response==true) {
            return redirect('/product');
        }
        return redirect('products/create');
    }

    public function delete($id){
        // dd($id);
        $product= Product::find($id);
        $product->delete();

        return redirect('/product');
    }

    public function edit($id){
        $product = Product::find($id);
        return view('products.edit' , get_defined_vars());
    }

    public function update($id, Request $request){
        $validated = $request->validate([
            'name' => 'required',
            'price' => 'required',
            'description' => 'required',
        ]);
        $product = Product::find($id);
        $product->name = $request->name;
        $product->price = $request->price;
        $product->description = $request->description;
        $product->update();
        return redirect('/product');
    }
    
    
}
