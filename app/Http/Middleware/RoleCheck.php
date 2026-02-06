<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RoleCheck
{
    public function handle(Request $request, Closure $next, string $role)
    {
        $user = Auth::user();

        if (!$user) {
            return redirect()->route('login.form');
        }

        if ($user->role !== $role) {
            abort(403, "Accès interdit : rôle requis = {$role}");
        }

        return $next($request);
    }
}
