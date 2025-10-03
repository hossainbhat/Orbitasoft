<?php

namespace App\Http\Controllers\API\V1;

use App\Models\Cart;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class CartController extends Controller
{
    public function addToCart(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'user_id'    => 'required|exists:users,id',
            'product_id' => 'required|exists:products,id',
            'quantity'   => 'required|integer|min:1',
            'size'       => 'nullable|string',
            'price'      => 'required|numeric|min:0',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validation error',
                'errors'  => $validator->errors(),
            ], 422);
        }

        $cartItem = Cart::where('user_id', $request->user_id)
            ->where('product_id', $request->product_id)
            ->where('size', $request->size)
            ->first();

        if ($cartItem) {
            $cartItem->quantity += $request->quantity;
            $cartItem->save();
        } else {
            $cartItem = Cart::create($request->only([
                'user_id',
                'product_id',
                'quantity',
                'size',
                'price',
            ]));
        }

        return response()->json([
            'success' => true,
            'message' => 'Product added to cart successfully',
            'payload' => $cartItem
        ], 200);
    }


    public function viewCart($userId)
    {
        $cartItems = Cart::with('product')
            ->where('user_id', $userId)
            ->get();

        return response()->json([
            'success' => true,
            'message' => 'Cart retrieved successfully',
            'payload' => $cartItems
        ], 200);
    }


    public function removeFromCart($id)
    {
        $cartItem = Cart::find($id);

        if (!$cartItem) {
            return response()->json([
                'success' => false,
                'message' => 'Cart item not found'
            ], 404);
        }

        $cartItem->delete();

        return response()->json([
            'success' => true,
            'message' => 'Item removed from cart successfully'
        ], 200);
    }
}
