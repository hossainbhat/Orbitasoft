<?php

namespace App\Http\Controllers\API\V1;

use DateTime;
use Exception;
use App\Model\User;
use App\Models\Permission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use KawsarJoy\RolePermission\Models\Role;

class RoleController extends Controller
{
    private $modelName = Role::class;

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->wantsJson()) {
            $queruy = Role::query();
            if ($request->search) {
                $queruy->where('name', 'like', "%$request->search%")->orWhere('description', 'like', "%$request->search%");
            }
            // default order
            $queruy->orderBy('id', 'DESC');
            if ($request->sortBy) {
                $queruy->orderBy($request->sortBy, $request->sort);
            }
            $pageLength = ($request->pageLength) ? $request->pageLength  : 60;
            return $queruy->paginate($pageLength);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
        public function store(Request $request)
    {
        $loginValidator = Validator::make($request->all(), [
            'name' => 'required|unique:roles,name',
            'description' => 'required|min:3',
        ]);
        if ($loginValidator->fails()) {
            return $this->sendValidationError($loginValidator->errors());
        }

        DB::beginTransaction();
        try {
            $role = Role::create(['name' => $request->name, 'description' => $request->description]);
            if ($request->item_ids) {
                $role->permissions()->sync($request->item_ids);
                DB::commit();
            } else {
                DB::rollback();
            }
        } catch (Exception $e) {
            DB::rollback();
        }

        $payload = [
            'data' => $request->all()
        ];
        return $this->sendSuccess($payload);
    }

    /**
     * Display the specified resource.
     */
     public function show($id)
    {
        $role = Role::find($id);
        $payload = [
            'data' => ['role' => $role, 'permission' => $role->permissions],
        ];
        return $this->sendSuccess($payload);
    }



    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Role $role)
    {
        # code...   
        $loginValidator = Validator::make($request->all(), [
            'name' => 'required|unique:roles,name,' . $role->id,
            'description' => 'required|min:3',
        ]);

        if ($loginValidator->fails()) {
            return $this->sendValidationError($loginValidator->errors());
        }
        DB::beginTransaction();
        try {

            $role->name = $request->name;
            $role->description = $request->description;
            $role->save();
            if ($request->item_ids) {
                $role->permissions()->sync($request->item_ids);
                DB::commit();
            } else {
                DB::rollback();
            }
        } catch (Exception $e) {
            DB::rollback();
        }

        $payload = [
            'data' => $request->all()
        ];
        return $this->sendSuccess($payload);
    }
    /**
     * Remove the specified resource from storage.
     */
     public function destroy(Role $role)
    {
        if ($role->delete()) {
            return $this->sendDeleteSuccess();
        } else {
            return $this->sendError();
        }
    }
    
    public function all_permission()
    {
        $data = new Permission();
        $payload = [
            'data' => $data->parent_permission(),
        ];
        return $this->sendSuccess($payload);
    }
}
