<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckPassword
{
    public function handle(Request $request, Closure $next)
    {
        if ($request->api_password != env('API_PASSWORD', 'QFN2YVkiTfcSkQBEXSbb8x'))
        {
            return response()->json(['message' => 'Unauthenticated.']);
        }
        return $next($request);
    }
}
