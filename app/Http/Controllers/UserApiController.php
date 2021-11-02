<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

use App\Models\User;
use App\Http\Requests\User\StoreUserRequest;
use App\Http\Requests\User\UpdateUserRequest;

class UserApiController extends Controller
{
    public function store(StoreUserRequest $request)
    {
        $validated = $request->validated();

        $response = DB::transaction(function () use ($request, $validated) {
            $user = new User;
            foreach ($validated as $key => $value) {
                $user[$key] = $value;
            }
            $user->password = Hash::make($user->password);
            $user->save();

            return response()->json([
                'success' => true,
                'title' => 'Create Success',
                'message' => 'The creation of user is successful!',
                'user' => $user,
            ]);
        });

        return $response;
    }

    public function get(Request $request)
    {
        $users = User::select('users.*', 'roles.display_name AS role_display_name')
            ->join('roles', 'users.role_id', 'roles.id')
            ->get();

        return response()->json([
            'success' => true,
            'users' => $users,
        ]);
    }

    public function find(User $user)
    {
        return response()->json([
            'success' => true,
            'user' => $user,
        ]);
    }

    public function update(UpdateUserRequest $request, User $user)
    {
        if ($user->role_id === 1) {
            return response()->json([
                'success' => false,
                'title' => 'Update Unsuccessful',
                'message' => 'The user with a role of administrator cannot be updated.',
            ]);
        } // TODO can be move to gate

        $validated = $request->validated();

        $response = DB::transaction(function () use ($request, $validated, $user) {
            foreach ($validated as $key => $value) {
                if ($value) {
                    if ($key === 'password') {
                        $user[$key] = Hash::make($value);
                    } else {
                        $user[$key] = $value;
                    }
                }
            }
            $user->save();

            return response()->json([
                'success' => true,
                'title' => 'Update Success',
                'message' => 'The update of user is successful!',
                'user' => $user,
            ]);
        });

        return $response;
    }

    public function delete(Request $request, User $user)
    {
        if ($user->role_id === 1) {
            return response()->json([
                'success' => false,
                'title' => 'Delete Unsuccessful',
                'message' => 'The user with a role of administrator cannot be deleted.',
            ]);
        } // TODO can be move to gate

        $response = DB::transaction(function () use ($user, $request) {
            $user->delete();

            return response()->json([
                'success' => true,
                'title' => 'Delete Success',
                'message' => 'The delete of user is successful!'
            ]);
        });

        return $response;
    }
}
