<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use KawsarJoy\RolePermission\Models\Role;
use Illuminate\Support\Facades\Validator;
use Exception;

class UserController extends Controller
{
    private $modelName = User::class;
    public $defaultFields = ['id', 'name', 'email'];
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->wantsJson()) {
            $query = User::query();
            if ($request->search) {
                $query->where('name', 'like', "%$request->search%")->orWhere('email', 'like', "%$request->search%");
            }
            $query->with('roles');
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
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'name' => ['required', 'string', 'max:255'],
            'password' => ['required', 'string', 'min:8'],
            'role_id' => ['required']
        ]);
        if ($validator->fails()) {
            return $this->sendValidationError($validator->errors());
        }

        DB::beginTransaction();
        try {
            $postData = $request->all();
            $postData['password'] = Hash::make($request['password']);
            if ($data = $this->modelName::create($postData)) {
                $role_id = [$request->role_id];
                $data->roles()->sync($role_id);

                DB::commit();
                return $this->sendAddSuccess($data);
            } else {
                DB::rollback();
                return $this->sendError();
            }
        } catch (Exception $e) {
            DB::rollback();
            return $this->sendError();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $user = User::with('roles:id as value,name as label')->find($id);
        $roles = Role::select('id as value', 'name as label')->get();
        $payload = [
            'data' => $user,
            'roles' => $roles
        ];
        return $this->sendSuccess($payload);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        $validated = Validator::make($request->all(), [
            'email' => 'bail|required|string|email|max:255|unique:users,email,' . $user->id,
            'name' => 'bail|required|string|max:255',
        ]);
        if ($validated->fails()) {
            return $this->sendValidationError($validated->errors());
        }
        DB::beginTransaction();
        try {
            if ($data = $user->update($request->all())) {
                $user->roles()->sync($request->roles);

                DB::commit();
                return $this->sendAddSuccess($user);
            } else {
                DB::rollBack();
                return $this->sendError();
            }
        } catch (Exception $e) {
            DB::rollBack();
            return $this->sendError();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        DB::beginTransaction();
        try {
            $user->roles()->delete();
            $payload = [
                'message' => "successfully delete"
            ];
            if ($user->delete()) {
                DB::commit();
                return $this->sendDeleteSuccess($payload);
            }
        } catch (\Throwable $th) {
            DB::rollBack();
            return $this->sendError();
        }
    }
}
