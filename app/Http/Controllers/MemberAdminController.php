<?php

namespace App\Http\Controllers;

use App\Models\MemberProduct;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MemberAdminController extends Controller
{
    public function index() {
        $products = MemberProduct::all();
        return view('admin.web.member-product', [
            'products' => $products
        ]);
    }

    public function create() {
        return view('admin.web.member-product-create');
    }

    public function store(Request $request) {
        $validatedData = $request->validate([
            'product_name' => 'required|max:255',
            'image' => 'required|image',
            'product_description' => 'required',
            'stock' => 'required|integer',
            'point' => 'required|integer'
        ]);

        if ($image = $request->file('image')) {
            $validatedData['image'] = $request->file('image')->store('images');
        };

        MemberProduct::create($validatedData);

        return redirect('/member_admin')->with('success', 'Product added successfully');
    }

    public function edit($member_admin) {
        $product = MemberProduct::findOrFail($member_admin);
        return view('admin.web.member-product-edit', [
            'product' => $product
        ]);
    }

    public function update(Request $request, $member_admin) {
        $validatedData = $request->validate([
            'product_name' => 'required|max:255',
            'image' => 'required|image',
            'product_description' => 'required',
            'stock' => 'required|integer',
            'point' => 'required|integer'
        ]);

        $product = MemberProduct::findOrFail($member_admin);
        if ($request->file('image')) {
            Storage::delete($product->image);
            $validatedData['image'] = $request->file('image')->store('images');
        }

        $product->update($validatedData);
        return redirect('/member_admin')->with('success', 'Product edited successfully');
    }

    public function destroy($member_admin) {
        $product = MemberProduct::findOrFail($member_admin);
        Storage::delete($product->image);
        $product->delete();
        return redirect('/member_admin')->with('success', 'Product deleted successfully');
    }
}
