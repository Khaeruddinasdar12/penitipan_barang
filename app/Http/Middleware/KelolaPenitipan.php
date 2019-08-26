<?php

namespace App\Http\Middleware;

use Closure;

class KelolaPenitipan
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next) {
        if ($request->user() && $request->user()->role == 'superadmin' || 
            $request->user() && $request->user()->role == 'kasir') {
            // return 'wkwkwk';
            return $next($request);
            // return Response(view('unauthorized')->with('role', 'ADMIN'));
            // return Response(array('status' => 'error' , 'pesan' => 'Hanya Kasir atau SuperAdmin ' ));
            // return $arrayName = array('status' => 'error' , 'pesan' => 'Hanya SuperAdmin' );
        }
            
            return Response(array('status' => 'error' , 'pesan' => 'Hanya Kasir atau SuperAdmin ' ));
    }
}
