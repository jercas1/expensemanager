<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Models\Role;
use App\Http\Requests\Role\StoreRoleRequest;

class RoleApiController extends Controller
{
    public function store(StoreRoleRequest $request)
    {
        $validated = $request->validated();

        $response = DB::transaction(function () use ($request, $validated) {
            $role = new Role;
            foreach ($validated as $key => $value) {
                $role[$key] = $value;
            }
            $role->save();

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
        $roles = Role::get();

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
        if ($role->id === 1) {
            return response()->json([
                'success' => false,
                'title' => 'Update Unsuccessful',
                'message' => 'The administrator role cannot be updated.',
            ]);
        } // TODO can be move to gate

        $validated = $request->validated();

        $response = DB::transaction(function () use ($request, $validated, $role) {
            foreach ($validated as $key => $value) {
                $role[$key] = $value;
            }
            $role->save();

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
        if ($role->id === 1) {
            return response()->json([
                'success' => false,
                'title' => 'Delete Unsuccessful',
                'message' => 'The administrator role cannot be deleted.',
            ]);
        } // TODO can be move to gate

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
}
