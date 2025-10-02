<?php

namespace App\Http\Controllers\API\V1;

use App\Models\DeliveryInfo;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class DeliveryInfoController extends Controller
{
    private $modelName = DeliveryInfo::class;
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->wantsJson()) {
            $query = $this->modelName::query();
            if ($request->search) {
                $query->where('full_name', 'like', "%$request->search%");
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
            'full_name' => 'required',
            'phone' => 'required',
            'email' => 'required',
            'address_line1' => 'required',
            'address_line2' => 'bail|nullable',
            'country_id' => 'required',
            'city_id' => 'required',
            'state' => 'required',
            'postal_code' => 'required',
        ]);

        if ($validator->fails()) {
            return $this->sendValidationError($validator->errors());
        }

        $dataToCreate = [
            'full_name' => $request->full_name,
            'user_id' =>  $request->user_id,
            'country_id' => $request->country_id,
            'city_id' => $request->city_id,
            'phone' => $request->phone,
            'email' => $request->email,
            'address_line1' => $request->address_line1,
            'address_line2' => $request->address_line2,
            'state' => $request->state,
            'postal_code' => $request->postal_code,
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
    public function show(DeliveryInfo $delivery_info)
    {
        $payload = [
            'data' => $delivery_info->load([
                'user',
                'country',
                'city'
            ])
        ];
        return $this->sendSuccess($payload);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, DeliveryInfo $delivery_info)
    {
        $validator = Validator::make($request->all(), [
            'full_name' => 'required',
            'user_id' => 'required',
            'phone' => 'required',
            'email' => 'required',
            'address_line1' => 'required',
            'address_line2' => 'bail|nullable',
            'country_id' => 'required',
            'city_id' => 'required',
            'state' => 'required',
            'postal_code' => 'required',
        ]);

        if ($validator->fails()) {
            return $this->sendValidationError($validator->errors());
        }

        $dataToUpdate = [
            'full_name' => $request->full_name,
            'user_id' => $request->user_id,
            'country_id' => $request->country_id,
            'city_id' => $request->city_id,
            'phone' => $request->phone,
            'email' => $request->email,
            'address_line1' => $request->address_line1,
            'address_line2' => $request->address_line2,
            'state' => $request->state,
            'postal_code' => $request->postal_code,
        ];

        if ($delivery_info->update($dataToUpdate)) {
            cache()->flush();
            return $this->sendUpdateSuccess($delivery_info);
        } else {
            return $this->sendError();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(DeliveryInfo $delivery_info)
    {
        try {
            if ($delivery_info->delete()) {
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
