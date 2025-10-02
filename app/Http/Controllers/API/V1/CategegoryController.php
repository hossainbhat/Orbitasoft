<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;

class CategegoryController extends Controller
{
    private $modelName = Category::class;
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
            'name' => 'bail|required|string|unique:categories,name',
            'parent_id' => 'bail|nullable|integer|exists:categories,id',
        ]);

        if ($validator->fails()) {
            return $this->sendValidationError($validator->errors());
        }

        $slug = Str::slug($request->name);

        $originalSlug = $slug;
        $counter = 1;
        while (Category::where('slug', $slug)->exists()) {
            $slug = $originalSlug . '-' . $counter;
            $counter++;
        }

        $dataToCreate = [
            'name' => $request->name,
            'slug' => $slug,
            'parent_id' => $request->parent_id ?? null,
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
    public function show(Category $category)
    {
        $payload = [
            'data' => $category
        ];
        return $this->sendSuccess($payload);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category $category)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'bail|required|string|unique:categories,name,' . $category->id,
            'parent_id' => 'bail|nullable|integer|exists:categories,id',
        ]);

        if ($validator->fails()) {
            return $this->sendValidationError($validator->errors());
        }

        $slug = Str::slug($request->name);
        $originalSlug = $slug;
        $counter = 1;
        while (Category::where('slug', $slug)->where('id', '!=', $category->id)->exists()) {
            $slug = $originalSlug . '-' . $counter;
            $counter++;
        }

        $dataToUpdate = [
            'name' => $request->name,
            'slug' => $slug,
            'parent_id' => $request->parent_id ?? null,
        ];

        if ($category->update($dataToUpdate)) {
            cache()->flush();
            return $this->sendUpdateSuccess($category);
        }else{
            return $this->sendError();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        try {
            if ($category->delete()) {
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
