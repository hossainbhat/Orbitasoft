<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Models\Country;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CountryController extends Controller
{
    private $modelName = Country::class;
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
            'name' => 'bail|required|string|unique:countries,name',
            'iso_code' => 'bail|nullable',
        ]);

        if ($validator->fails()) {
            return $this->sendValidationError($validator->errors());
        }

        $dataToCreate = [
            'name' => $request->name,
            'iso_code' => $request->iso_code ?? null,
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
    public function show(Country $country)
    {
        $payload = [
            'data' => $country
        ];
        return $this->sendSuccess($payload);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Country $country)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'bail|required|string|unique:countries,name,' . $country->id,
            'iso_code' => 'bail|nullable',
        ]);

        if ($validator->fails()) {
            return $this->sendValidationError($validator->errors());
        }

      
        $dataToUpdate = [
            'name' => $request->name,
            'iso_code' => $request->iso_code ?? null,
        ];

        if ($country->update($dataToUpdate)) {
            cache()->flush();
            return $this->sendUpdateSuccess($country);
        }else{
            return $this->sendError();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Country $country)
    {
        try {
            if ($country->delete()) {
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
