<?php

namespace App\Http\Middleware;

use Closure;

class SuperAdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next) {
        if ($request->user() && $request->user()->role != 'superadmin') {
            // return 'wkwkwk';
            // return Response(view('unauthorized')->with('role', 'ADMIN'));
            return Response(array('status' => 'error' , 'pesan' => 'Hanya SuperAdmin ' ));
            // return $arrayName = array('status' => 'error' , 'pesan' => 'Hanya SuperAdmin' );
        }
            
            return $next($request);
    }
}
