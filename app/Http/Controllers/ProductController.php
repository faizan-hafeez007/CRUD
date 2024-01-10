<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;


class ProductController extends Controller
{
    public function index()
    {
        // $products = Product::with('category')->orderByDesc('name')->paginate(5);
        // dd($products);
        $products = Product::orderBy('created_at', 'desc')->paginate(4);
        return view('products.index', get_defined_vars());
    }


    public function create()
    {
        $category = Category::all();
        return view('products.create', get_defined_vars());
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
        $request->image->storeAs('products', $image, 'public');

        $product = new Product;
        $product->name = $request->name;
        $product->price = $request->price;
        $product->quantity = $request->quantity;
        $product->category_id = $request->category_id;
        $product->image = $image;
        $product->description = $request->description;
        $response = $product->save();
        if ($response == true) {
            return redirect('/admin/product')->with('success', 'Form data submitted successfully!');
        }
        return redirect('/admin/products/create');
    }

    public function delete($id)
    {
        // dd($id);
        $product = Product::find($id);
        $product->delete();

        return redirect('/admin/product');
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
        $product->category_id = $request->category_id;
        $product->description = $request->description;
        $product->update();
        return redirect('/admin/product')->with('success', 'Form data Updated successfully!');
    }
    public function product_show()
    {
        $products = Product::all();
        return view('frontend.index', get_defined_vars());
    }
    public function cart()
    {
        return view('cart');
    }
    public function addToCart($id)
    {
        $product = Product::findOrFail($id);

        $cart = session()->get('cart', []);

        if (isset($cart[$id])) {
            $cart[$id]['quantity']++;
        } else {
            $cart[$id] = [
                "name" => $product->name,
                "quantity" => 1,
                "price" => $product->price,
                "image" => $product->image
            ];
        }

        session()->put('cart', $cart);
        return redirect()->back()->with('success', 'Product added to cart successfully!');
    }
    public function update_cart(Request $request)
    {
        if ($request->id && $request->quantity) {
            $cart = session()->get('cart');
            $cart[$request->id]["quantity"] = $request->quantity;
            session()->put('cart', $cart);
            session()->flash('success', 'Cart updated successfully');
        }
    }
    public function remove(Request $request)
    {
        if ($request->id) {
            $cart = session()->get('cart');
            if (isset($cart[$request->id])) {
                unset($cart[$request->id]);
                session()->put('cart', $cart);
            }
            session()->flash('success', 'Product removed successfully');
        }
    }
    

}
