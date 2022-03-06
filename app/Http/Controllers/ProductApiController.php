<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Modal;
use App\Models\Category;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;

use function PHPSTORM_META\map;

class ProductApiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $product = Product::all();
        $data = [
            'info' => 'Data Accepted Successfully',
            'status' => Response::HTTP_OK,
            'Product' => $product
        ];

        return response()->json($data, Response::HTTP_OK);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = Validator::make($request->all(),[
            'product_name' => 'required|max:255',
            'product_description' => 'required',
            'category_id' => 'required|integer',
            'image' => 'required|image',
            'stock' => 'required|integer',
            'price' => 'required|integer',
            'profit' => 'required|integer',
            'member_point' => 'required|integer'
        ]);

        if ($validatedData->fails()) {
            $data = [
                'info' => 'Error',
                'status' => Response::HTTP_BAD_REQUEST,
                'data' => $validatedData->errors()
            ];
            return response()->json($data, Response::HTTP_BAD_REQUEST);
        }

        try {
            $category = Category::where('id', '=', $request->category_id)->first();
            $formData = $request->all();
            if ($category !== null) {
                if ($request->file('image')) {
                    $formData['image'] = $request->file('image')->store('images');
                };
                $product = Product::create($formData);
                $product = Product::latest()->first();

                $modal = new Modal();
                $modal->product_id = $product->id;
                $modal->stock = $product->stock;
                $modal->cost = ($product->price - $product->profit) * $product->stock;
                $modal->save();

                $data = [
                    'info' => 'Data Created Successfully',
                    'status' => Response::HTTP_OK,
                    'data' => $product
                ];
                return response()->json($data, Response::HTTP_OK);
            }
        } catch (QueryException $e) {
            return response()->json($e, Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $product = Product::findOrFail($id);
        $data = [
            'info' => 'Data get successfully',
            'status' => 200,
            'data' => $product
        ];
        return response()->json($data, 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validatedData = Validator::make($request->all(),[
            'product_name' => 'required|max:255',
            'product_description' => 'required',
            'category_id' => 'required|integer',
            'stock' => 'required|integer',
            'price' => 'required|integer',
            'profit' => 'required|integer',
            'member_point' => 'required|integer'
        ]);
        if ($validatedData->fails()) {
            $data = [
                'info' => 'Error',
                'status' => Response::HTTP_BAD_REQUEST,
                'data' => $validatedData->errors()
            ];
            return response()->json($data, Response::HTTP_BAD_REQUEST);
        }
        try {
            $product = Product::findOrFail($id);
            $formData = $request->all();
            if ($request->file('image')) {
                Storage::delete($product->image);
                $formData['image'] = $request->file('image')->store('images');
            }
            $product->update($formData);

            $data = [
                'info' => 'Product updated successfully',
                'status' => 200,
                'data' => $product
            ];
            return response()->json($data, 200);
        } catch (QueryException $e) {
            return response()->json($e, Response::HTTP_INTERNAL_SERVER_ERROR);
        }
        $product = Product::findOrFail($id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        Storage::delete($product->image);
        $product->delete();

        $data = [
            'info' => 'Product deleted successfully',
            'status' => 200
        ];
        return response()->json($data, 200);
    }
}
