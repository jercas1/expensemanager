<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Models\Role;
use App\Models\RoleFunction;
use App\Models\RoleDetail;
use App\Models\User;
use App\Http\Requests\Role\StoreRoleRequest;

class RoleApiController extends Controller
{
    public function store(StoreRoleRequest $request)
    {
        $validated = $request->validated();

        $response = DB::transaction(function () use ($request, $validated) {
            $role = new Role;
            foreach ($validated as $key => $value) {
                if ($key !== 'role_details') {
                    $role[$key] = $value;
                }
            }
            $role->save();

            if (array_key_exists('role_details', $validated)) {
                $data = [];
                $role_detail = new RoleDetail;
                $role_detail->role_id = $role->id;
                foreach ($validated['role_details'] as $value) {
                    $role_detail->role_function_id = $value;
                    array_push($data, $role_detail->toArray());
                }

                RoleDetail::insert($data);
            }

            return response()->json([
                'success' => true,
                'title' => 'Create Success',
                'message' => 'The creation of role is successful!',
                'role' => $role,
            ]);
        });

        return $response;
    }

    public function get(Request $request)
    {
        $roles = Role::with('roleDetails')->get();

        return response()->json([
            'success' => true,
            'roles' => $roles,
        ]);
    }

    public function find(Role $role)
    {
        return response()->json([
            'success' => true,
            'role' => $role,
        ]);
    }

    public function update(StoreRoleRequest $request, Role $role)
    {
        $validated = $request->validated();

        $response = DB::transaction(function () use ($request, $validated, $role) {
            foreach ($validated as $key => $value) {
                if ($key !== 'role_details') {
                    $role[$key] = $value;
                }
            }
            $role->save();

            RoleDetail::where('role_id', $role->id)
                ->when(array_key_exists('role_details', $validated), function ($query) use ($validated) {
                    $query->whereNotIn('role_function_id', $validated['role_details']);
                })
                ->delete();

            if (array_key_exists('role_details', $validated)) {
                $role_detail = new RoleDetail;
                $role_detail->role_id = $role->id;
                foreach ($validated['role_details'] as $value) {
                    $role_detail->role_function_id = $value;
                    RoleDetail::firstOrCreate($role_detail->toArray());
                }
            }

            return response()->json([
                'success' => true,
                'title' => 'Update Success',
                'message' => 'The update of role is successful!',
                'role' => $role,
            ]);
        });

        return $response;
    }

    public function delete(Request $request, Role $role)
    {
        $response = DB::transaction(function () use ($role, $request) {
            $role->delete();

            return response()->json([
                'success' => true,
                'title' => 'Delete Success',
                'message' => 'The delete of role is successful!'
            ]);
        });

        return $response;
    }

    public function getRoleFunction(Request $request)
    {
        $role_functions = RoleFunction::get();

        return response()->json([
            'success' => true,
            'role_functions' => $role_functions,
        ]);
    }

    public function getAuthRoleFunction(Request $request)
    {
        $user_functions = User::select('role_functions.*')
        ->join('roles', 'users.role_id', 'roles.id')
        ->join('role_details', 'roles.id', 'role_details.role_id')
        ->join('role_functions', 'role_details.role_function_id', 'role_functions.id')
        ->where('users.id', $request->user()->id)
        ->get();

        return response()->json([
            'success' => true,
            'user_functions' => $user_functions,
        ]);
    }
}
