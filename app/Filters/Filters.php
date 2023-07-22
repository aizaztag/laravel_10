<?php

namespace App\Filters;

use Closure;

class Filters
{
    public function handle($request, Closure $next)
    {
        if (! request()->has('title')) {
            return $next($request);
        }

        return $next($request)->where('title', request()->input('title'));
    }
}
