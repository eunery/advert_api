<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

class Cors
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {

        $headers = [
            'Access-Control-Allow-Headers' => '*',
            'Access-Control-Allow-Origin' => '*',
            'Access-Control-Allow-Methods' => "GET, POST, PUT, DELETE, OPTIONS",
            ];
        if ($request->isMethod("OPTIONS")) {
            // The client-side application can set only headers allowed in Access-Control-Allow-Headers
            return Response::make('OK', 200, $headers);
            // return $response('');
        }
        //$request->headers->set('Accept', 'application/json');

//        return $next($request);

        return $next($request)
            ->header('Access-Control-Allow-Headers', '*')
            ->header('Access-Control-Allow-Origin', '*')
            ->header('Access-Control-Allow-Methods', "GET, POST, PUT, DELETE, OPTIONS");
    }
}
