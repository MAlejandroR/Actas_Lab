<?php

namespace App\Http\Middleware;

use Closure;

class edad
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        /*

        if ($request->edad<=20)
            return redirect('p1');
*/
        return $next($request);
    }
}
