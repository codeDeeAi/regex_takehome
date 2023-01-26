<?php

namespace App\Http\Middleware;

use App\Models\AccessToken;
use Closure;
use Illuminate\Http\Request;

class AccessTokenMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $token = $request->bearerToken();
        if (!empty($token)) {
            $access = AccessToken::where('token', $token)->with('user')->first();
            $user = (!is_null($access) && $access->user) ? $access->user : null;
            $request->merge(['user' => $user]);
        } else {
            $request->merge(['user' => null]);
        }
        return $next($request);
    }
}
