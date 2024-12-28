<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, $role)
    {

        $user = Auth::user(); // Get authenticated user

        // Check if the user has the required role
        Log::info($user->role);
        Log::info($role);
        if ($user && $user->role === $role) {
            return $next($request);
        }

        // If the user doesn't have the role, deny access
        return response()->json(['message' => 'Unauthorized.'], 403);

        /*if ($request->user()->role !== $role) {
            //return redirect('/unauthorized'); // Redirect if the role doesn't match
            return response()->json([
                'success'=>'false',
                'message'=>'Unauthenticated',
            ],401); // Redirect if the role doesn't match
        }

        return $next($request);*/
    }
}
