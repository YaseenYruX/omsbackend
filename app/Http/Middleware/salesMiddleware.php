<?php
namespace App\Http\Middleware;
use Closure;
use Auth;
use Illuminate\Http\Request;
class salesMiddleware
{
    public function handle(Request $request, Closure $next){
        if(Auth::user()->user_type==4){
        	$response = $next($request);
        	return $response;
        }
        return response()->json(['status'=>0,'data'=>'Authenticate as Sales person']);
    }
}