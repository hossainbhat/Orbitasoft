<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
class ProductController extends Controller
{
    private $modelName = Product::class;
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->wantsJson()) {
            $query = $this->modelName::query();
            if ($request->search) {
                $query->where('name', 'like', "%$request->search%");
            }
            // default order
            $query->orderBy('id', 'DESC');
            if ($request->sortBy) {
                $query->orderBy($request->sortBy, $request->sort);
            }

            $pageLength = ($request->pageLength) ? $request->pageLength  : 60;
            if ($pageLength == -1) {
                return $query->paginate($query->get()->count());
            } else {
                return $query->paginate($pageLength);
            }
        }
    }

    /**
     * Store a newly created resource in storage.
     */

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'bail|required|string|unique:products,name',
            'description' => 'bail|nullable',
            'price' => 'bail|required|integer',
            'discount' => 'bail|nullable|integer',
            // 'cover_image' => 'bail|required',
            'category_id' => 'bail|required|integer',
        ]);

        if ($validator->fails()) {
            return $this->sendValidationError($validator->errors());
        }

        $slug = Str::slug($request->name);

        $originalSlug = $slug;
        $counter = 1;
        while (Product::where('slug', $slug)->exists()) {
            $slug = $originalSlug . '-' . $counter;
            $counter++;
        }

        $dataToCreate = [
            'name' => $request->name,
            'category_id' => $request->category_id,
            'description' => $request->description,
            'price' => $request->price,
            'discount' => $request->discount,
            'slug' => $request->discount,
        ];

        if ($data = $this->modelName::create($dataToCreate)) {
            cache()->flush();
            return $this->sendAddSuccess($data);
        }

        return $this->sendError();
    }


    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        $payload = [
            'data' => $product
        ];
        return $this->sendSuccess($payload);
    }

    /**
     * Update the specified resource in storage.
     */
     public function update(Request $request, Product $product)
    {
         $validator = Validator::make($request->all(), [
            'name' => 'bail|required|string',
            'description' => 'bail|nullable',
            'price' => 'bail|required|integer',
            'discount' => 'bail|nullable|integer',
            // 'cover_image' => 'bail|required',
            'category_id' => 'bail|required|integer',
        ]);

        if ($validator->fails()) {
            return $this->sendValidationError($validator->errors());
        }

        $dataToUpdate = [
            'name' => $request->name,
            'category_id' => $request->category_id,
            'description' => $request->description,
            'price' => $request->price,
            'discount' => $request->discount,
        ];

        if ($product->update($dataToUpdate)) {
            cache()->flush();
            return $this->sendUpdateSuccess($product);
        } else {
            return $this->sendError();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        try {
            if ($product->delete()) {
                cache()->flush();
                return $this->sendDeleteSuccess();
            } else {
                return $this->sendError();
            }
        } catch (\Exception $e) {
            $payload = [
                'message' => $e->getMessage(),
                'code' => $e->getCode(),
            ];
            return $this->sendValidationError($payload);
        }
    }
}
