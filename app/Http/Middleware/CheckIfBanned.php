<?php

namespace App\Http\Middleware;

use Closure;

class CheckIfBanned
{
    public function handle($request, Closure $next)
    {
        if (auth()->check() && auth()->user()->is_banned) {
            auth()->logout();

            $message = 'Your account has been suspended.';

            return redirect()->route('login')->withMessage($message);
        }

        return $next($request);
    }
}
