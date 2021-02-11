<?php
namespace App\Http\Middleware;
use Closure;
use Auth;
use Illuminate\Http\Request;
class buhMiddleware
{
    public function handle(Request $request, Closure $next){
        if(Auth::user()->user_type==2){
        	$response = $next($request);
        	return $response;
        }
        return response()->json(['status'=>0,'data','Authenticate as an BUH']);
    }
}