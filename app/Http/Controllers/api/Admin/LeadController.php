<?php
namespace App\Http\Controllers\api\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Admin\UserCURequest;
use App\Models\Brands;
use App\Models\User;
use Hash;
class LeadController extends Controller
{
    public function fetchbrands(){
    	return Brands::select('id','name')->get();
    }
    public function fetchsalesperson($brandid=0){
    	$user=User::select('id','email');
    	if($brandid>0){

    	}
    	return $user->where('user_type',4)->get();
    }
}
