<?php

namespace App\Http\Middleware;

use Closure;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, string $role)
    {
        $roles = [
            'admin' => [2],
            'user' => [1, 2],
            'officer' => [3]
        ];

        $roleIds = $roles[$role] ?? [];

        if (!in_array(auth()->user()->role_id, $roleIds)) {
            abort(403);
        }

        return $next($request);
    }
}
