<?php

namespace App\Http\Middleware;

use Closure;

class Admin
{
    private $message;

    public function __construct()
    {
        $this->message = ["message" => "Unauthenticated-admin"];
    }
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $user = $request->user('api');
        if(empty($user)){
            return response()->json($this->message);
        }
        if($user->role == 1){
            return $next($request);
        }else{
            return response()->json($this->message);
        }
    }
}
