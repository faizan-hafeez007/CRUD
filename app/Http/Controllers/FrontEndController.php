<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class FrontEndController extends Controller
{
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function index()
    {
        $products = Product::all();
        return view('frontend.pages.products', get_defined_vars());
    }
    public function filters($id)
    {
        $products = Product::where('category_id', '=', $id)->get();

        return view('frontend.pages.products', get_defined_vars());
    }
    // public function search(Request $request)
    // {
    //     $name = $request->input('name');
    //     $products = Product::where('name', 'like', '%' . $name . '%')->get();
    //     return view('frontend.pages.products', compact('products'));
    // }
    public function search(Request $request)
    {
        $name = $request->input('name');
        $selectedCategory = $request->input('category');
        // dd($selectedCategory);
        if (!$selectedCategory) {
            $name = $request->input('name');
            $products = Product::where('name', 'like', '%' . $name . '%')->get();
            return view('frontend.pages.products', compact('products'));
        }
        $products = Product::where('name', 'like', '%' . $name . '%')
            ->where('category_id', $selectedCategory)
            ->get();
        return view('frontend.pages.products', get_defined_vars());
    }



    /**
     * Write code on Method
     *
     * @return response()
     */
    public function cart()
    {
        return view('frontend.pages.cart');
    }

    /**
     * Write code on Method
     *
     * @return response()
     */
    public function addToCart($id)
    {
        $product = Product::find($id);
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

    /**
     * Write code on Method
     *
     * @return response()
     */
    public function update(Request $request)
    {
        if ($request->id && $request->quantity) {
            $cart = session()->get('cart');
            $cart[$request->id]["quantity"] = $request->quantity;
            session()->put('cart', $cart);
            session()->flash('success', 'Cart updated successfully');
        }
    }

    /**
     * Write code on Method
     *
     * @return response()
     */
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
