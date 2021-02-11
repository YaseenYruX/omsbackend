<?php
namespace App\Http\Middleware;
use Closure;
use Auth;
use Illuminate\Http\Request;
class purchaserMiddleware
{
    public function handle(Request $request, Closure $next){
        if(Auth::user()->user_type==3){
        	$response = $next($request);
        	return $response;
        }
        return response()->json(['status'=>0,'data','Authenticate as Purchaser']);
    }
}