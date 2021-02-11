<?php
namespace App\Http\Controllers\Api\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use Hash;
use App\Models\User;
class AuthController extends Controller
{
    public function login(Request $req){
    	if(!empty($req->email)&&!empty($req->password)){
    		$userfind=User::where('email',$req->email)->first();
    		if($userfind){
    			/*means found user*/
    			if(Hash::check($req->password,$userfind->password)){
    				/*matched password*/
    				Auth::login($userfind);
    				if(Auth::check()){
    					return response()->json(['status'=>1,'data'=>$userfind->api_token]);
    				}else{
    					return response()->json(['status'=>0,'data'=>'Login Failed']);
    				}
    				/*matched password end*/
    			}else{
    				return response()->json(['status'=>0,'data'=>'Password is invalid']);
    			}
    			/*means found user end*/
    		}else{
    			return response()->json(['status'=>0,'data'=>'User does not exist']);
    		}
    	}else{
    		return response()->json(['status'=>0,'data'=>'Email and password is required']);
    	}
    }
}
