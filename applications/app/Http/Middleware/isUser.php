<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\RedirectResponse;

class isUser
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

      if(session('level') == '1' || session('level') == '2' || session('level') == '3' || session('level') == '4' || session('level') == '5')
      {
        return $next($request);
      }

      return new RedirectResponse(route('index'));
    }
}
