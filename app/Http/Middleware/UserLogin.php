<?php

namespace App\Http\Middleware;

use Closure;

class userlogin
{
    public function handle($request, Closure $next)
    {
        if(!session('userid')){
            return redirect('/');
        }

        return $next($request);
    }
}
