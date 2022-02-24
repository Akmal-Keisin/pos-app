<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\Modal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductAdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::all();
        if (request('search')) {
            $products = Product::where('product_name', 'like' , '%' .  request('search') . '%')->get();
        }
        return view('admin.web.dashboard', [
            'products' => $products
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        return view('admin.web.insert', [
            'categories' => $categories
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'product_name' => 'required',
            'image' => 'required|image',
            'product_description' => 'required',
            'category' => 'required',
            'product_description' => 'required',
            'stock' => 'required|integer',
            'price' => 'required|integer',
            'profit' => 'required|integer'
        ]);

        if ($image = $request->file('image')) {
            $validatedData['image'] = $request->file('image')->store('images');
        };


        $validatedData['category_id'] = $validatedData['category'];
        Product::create($validatedData);

        $product = Product::latest()->first();

        $modal = new Modal();
        $modal->product_id = $product->id;
        $modal->stock = $product->stock;
        $modal->cost = ($product->price - $product->profit) * $product->stock;
        $modal->save();


        return redirect('/admin')->with('success', 'Product created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit($admin)
    {
        $product = Product::findOrFail($admin);
        $categories = Category::all();
        return view('admin.web.edit', [
            'product' => $product,
            'categories' => $categories
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $admin)
    {
        $validatedData = $request->validate([
            'product_name' => 'required',
            'product_description' => 'required',
            'category' => 'required',
            'product_description' => 'required',
            'stock' => 'required|integer',
            'price' => 'required|integer',
            'profit' => 'required|integer'
        ]);
        $product = Product::findOrFail($admin);

        if ($request->file('image')) {
            Storage::delete($product->image);
            $validatedData['image'] = $request->file('image')->store('images');
        }
        $validatedData['category_id'] = $validatedData['category'];
        $product->update($validatedData);

        return redirect('/admin')->with('Product Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy($admin)
    {
        $product = Product::findOrFail($admin);
        Storage::delete($product->image);
        $product->delete();
        return redirect('/admin');
    }
}
