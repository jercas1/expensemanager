<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Models\User;

class CheckUserRoleFunction
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $route = Route::current();

        $user_has_function = User::join('roles', 'users.role_id', 'roles.id')
        ->join('role_details', 'roles.id', 'role_details.role_id')
        ->join('role_functions', 'role_details.role_function_id', 'role_functions.id')
        ->where([
            ['users.id', $request->user()->id],
            ['role_functions.uri', $route->uri]
        ])
        ->exists();

        if ($user_has_function) {
            return $next($request);
        } else {
            return response()->json([
                'success' => false,
                'title' => 'Forbidden Request',
                'message' => 'You are not allowed to do this request.',
            ], 403);
        }
    }
}
