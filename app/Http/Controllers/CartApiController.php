<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Database\QueryException;
use Symfony\Component\HttpFoundation\Response;

use function PHPUnit\Framework\isEmpty;

class CartApiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            $cart = Cart::all();
            $data = [
                'info' => 'Cart All Data',
                'status' => Response::HTTP_OK,
                'data' => $cart
            ];
            return response()->json($data, Response::HTTP_OK);
        } catch (QueryException $e) {
            $data = [
                'info' => $e,
                'status' => Response::HTTP_INTERNAL_SERVER_ERROR
            ];
            return response()->json($data, Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = Validator::make($request->all(), [
            'product_id' => 'required|integer',
            'user_id' => 'required|integer',
            'qty' => 'required|integer',
        ]);

        $product = Product::findOrFail($request->product_id);
        $validatedData['cost'] = $request->qty * $product->price;
        $product = Product::create($validatedData);

        $data = [
            'info' => 'Cart added successfully',
            'status' => Response::HTTP_OK,
            'data' => Cart::where('user_id', '=', $request->user_id)->get()
        ];
        return response()->json($data, Response::HTTP_OK);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (!$id) {
            $data = [
                'info' => 'Error',
                'status' => Response::HTTP_BAD_REQUEST,
                'data' => 'Id is empty'
            ];
            return response()->json($data, Response::HTTP_BAD_REQUEST);
        }
        try {
            $cart = Cart::where('user_id', '=', $id)->get();
            if (isEmpty($cart)) {
                $data = [
                    'info' => 'Cart Is Empty',
                    'status' => Response::HTTP_OK,
                    'data' => $cart
                ];
            return response()->json($data, Response::HTTP_OK);
        }
        $data = [
            'info' => 'Cart Get Success',
            'status' => Response::HTTP_OK,
            'data' => $cart
        ];
        return response()->json($data, Response::HTTP_OK);
        } catch (QueryException $e) {
            return response()->json([
                'message' => 'Failed ' . $e->errorInfo
            ]);
        }

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
        $validatedData = Validator::make($request->all(), [
            'qty' => 'required|integer'
        ]);
        $cart = Cart::findOrFail($id);
        $product = Product::findOrFail($cart->product_id);
        $cart->qty = $validatedData['qty'];
        $cart->cost = $validatedData['qty'] * $product->price;
        $cart->update($cart);

        $data = [
            'info' => 'Cart updated successfully',
            'status' => Response::HTTP_OK,
            'data' => $cart
        ];
        return response()->json($data, Response::HTTP_OK);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $cart = Cart::findOrFail($id);
        $cart->delete();

        $data = [
            'info' => 'Cart deleted successfully',
            'status' => Response::HTTP_OK
        ];
        return response()->json($data, Response::HTTP_OK);
    }
}
