<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CustomerValidate
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
        if (!Auth::check()) {
            return redirect(route('login'));
        } else {
            switch (Auth::user()->user_level) {
                case User::USER_LEVEL['ADMIN']:
                    return redirect(route('admin.index'));
                    break;
                default:
                    break;
            }
        }
        return $next($request);
    }
}
