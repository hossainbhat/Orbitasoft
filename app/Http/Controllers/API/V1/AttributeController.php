<?php

namespace App\Http\Controllers\API\V1;

use App\Models\Attribute;
use Illuminate\Http\Request;
use App\Models\AttributeValue;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class AttributeController extends Controller
{
    private $modelName = Attribute::class;
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
            'name' => 'bail|required|string|unique:attributes,name',
            'values' => 'bail|nullable|array',
            'values.*' => 'bail|string',
        ]);

        if ($validator->fails()) {
            return $this->sendValidationError($validator->errors());
        }

        DB::beginTransaction();

        try {
            $attribute = $this->modelName::create([
                'name' => $request->name,
            ]);

            if ($request->has('values') && is_array($request->values)) {
                $valuesData = [];
                foreach ($request->values as $value) {
                    $valuesData[] = [
                        'attribute_id' => $attribute->id,
                        'value' => $value,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ];
                }
                DB::table('attribute_values')->insert($valuesData);
            }

            DB::commit();
            cache()->flush();
            return $this->sendAddSuccess($attribute);
        } catch (\Exception $e) {
            DB::rollBack();
            return $this->sendError($e->getMessage());
        }
    }


    /**
     * Display the specified resource.
     */
    public function show(Attribute $attribute)
    {
        $payload = [
            'data' => $attribute->load([
                'attributeValue'
            ])
        ];
        return $this->sendSuccess($payload);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Attribute $attribute)
    {
        // Validate input
        $validator = Validator::make($request->all(), [
            'name' => 'bail|required|string|unique:attributes,name,' . $attribute->id,
            'values' => 'bail|nullable|array',
            'values.*' => 'bail|string',
        ]);

        if ($validator->fails()) {
            return $this->sendValidationError($validator->errors());
        }

        DB::beginTransaction();

        try {
            $attribute->update([
                'name' => $request->name,
            ]);

            if ($request->has('values') && is_array($request->values)) {
                AttributeValue::where('attribute_id', $attribute->id)->delete();

                // Insert new values
                $valuesData = [];
                foreach ($request->values as $value) {
                    $valuesData[] = [
                        'attribute_id' => $attribute->id,
                        'value' => $value,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ];
                }
                AttributeValue::insert($valuesData);
            }

            DB::commit();
            cache()->flush();

            return $this->sendUpdateSuccess($attribute);
        } catch (\Exception $e) {
            DB::rollBack();
            return $this->sendError($e->getMessage());
        }
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Attribute $attribute)
    {
        try {
            $attribute->attributeValue()->delete();
            $attribute->delete();

            cache()->flush();
            return $this->sendDeleteSuccess();
        } catch (\Exception $e) {
            return $this->sendValidationError([
                'message' => $e->getMessage(),
                'code' => $e->getCode(),
            ]);
        }
    }
}
