<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Response;
class AccessControlList
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $role_id)
    {
          if($request->user() === null){
            return response('Please Login', 401);
          }
          $permission=$request->user()->AllowToAccess($role_id);


          if($permission==true){
            return $next($request);
          }
       
          return redirect('home');
        //return new Response(view('NotFoundPage'));
    }
}
