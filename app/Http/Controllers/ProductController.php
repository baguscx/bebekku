<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::all();
        return view('product.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $metapage = [
            'title' => 'Create Product',
            'description' => 'Create a new product',
            'keywords' => 'product, create, new',
            'button' => 'Create',
            'route' => route('product.store'),
            'method' => 'POST'
        ];
        return view('product.form', compact('metapage'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images'), $imageName);
        }

        $product = Product::create([
            'user_id' => Auth::id(),
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
            'stock' => $request->stock,
            'image' => $imageName,
        ]);


        return redirect()->route('product.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        if(Auth::user()->phone || Auth::user()->address){
            return view('product.show', compact('product'));
        }
        return redirect()->route('profile.edit');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {

        $metapage = [
            'title' => 'Edit Product',
            'description' => 'Update a new product',
            'keywords' => 'product, Edit, update',
            'button' => 'Edit',
            'route' => route('product.update', $product->id),
            'method' => 'PUT'
        ];

        return view('product.form', compact('metapage', 'product'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        $imageName = $product->image;
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images'), $imageName);
        }

        $product->update([
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
            'stock' => $request->stock,
            'image' => $imageName,
        ]);

        return redirect()->route('product.index');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        //
    }
}
