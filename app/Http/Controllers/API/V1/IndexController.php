<?php

namespace App\Http\Controllers\API\V1;

use App\Models\Category;
use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function categoryList(Request $request)
    {
        $pageLength = $request->pageLength ?? 10;
        $categories = Category::orderBy('id', 'DESC')->get();

        $categories->map(function ($category) use ($pageLength) {
            $category->products = $category->products()
                ->orderBy('id', 'DESC')
                ->paginate($pageLength);

            return $category;
        });

        return response()->json([
            'success' => true,
            'message' => 'Category list with paginated products retrieved successfully',
            'payload' => $categories
        ], 200);
    }


    public function productList(Request $request)
    {
        $query = Product::with('category')->orderBy('id', 'DESC');

        $pageLength = $request->pageLength ?? 20;

        $products = $query->paginate($pageLength);

        return response()->json([
            'success' => true,
            'message' => 'Product list retrieved successfully',
            'payload' => $products
        ], 200);
    }

    public function productDetails($slug)
    {
        $product = Product::with('category')->where(['slug' => $slug])->first();
        return response()->json([
            'success' => true,
            'message' => 'Product Details retrieved successfully',
            'payload' => $product
        ], 200);
    }
}
