<?php namespace App\Http\Middleware;

use Closure;

class UserRoleMiddleware {

    /**
     * Run the request filter.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
				if (\Auth::user()->role == 'a')
				{
					return redirect('home');
				}

        return $next($request);
    }

}
