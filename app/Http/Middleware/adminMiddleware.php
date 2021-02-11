<?php
namespace App\Http\Middleware;
use Closure;
use Auth;
use Illuminate\Http\Request;
class adminMiddleware
{
    public function handle(Request $request, Closure $next){
        if(Auth::user()->user_type==1){
        	$response = $next($request);
        	return $response;
        }
        return response()->json(['status'=>0,'data','Authenticate as an admin']);
    }
}