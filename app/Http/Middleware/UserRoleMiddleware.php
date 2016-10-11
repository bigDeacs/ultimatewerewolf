<?php namespace App\Http\Middleware;

use Closure;
use Illuminate\Contracts\Auth\Guard;

class UserRoleMiddleware {

		/**
		 * Create a new filter instance.
		 *
		 * @param  Guard  $auth
		 * @return void
		 */
		public function __construct(Guard $auth)
		{
			$this->auth = $auth;
		}

    /**
     * Run the request filter.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
				if ($this->auth->role == 'a')
				{
					return redirect('home');
				}

        return $next($request);
    }

}
