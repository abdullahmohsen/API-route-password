<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class ChangeLanguage
{
    
    public function handle(Request $request, Closure $next)
    {
        app()->setLocale('en'); //Default

        if (isset($request->lang ) && $request->lang == 'ar')
        {
            app()->setLocale('ar');
        }
        return $next($request);
    }
}
