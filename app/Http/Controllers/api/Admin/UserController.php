<?php
namespace App\Http\Controllers\api\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Admin\UserCURequest;
use App\Models\User;
use Hash;
class UserController extends Controller
{
    public function index(){
    	$perpage=!empty($_GET['perpage'])?intval($_GET['perpage']):20;
        $sortcol=!empty($_GET['sortcol'])?$_GET['sortcol']:'id';
        $sorttype=!empty($_GET['sorttype'])?$_GET['sorttype']:'desc';
        $usertype=!empty($_GET['usertype'])?$_GET['usertype']:1;
        return User::where('user_type',$usertype)->orderBy($sortcol,$sorttype)->paginate($perpage);
    }
	public function get(User $user){
		return $user;
	}
	public function cu(UserCURequest $req,User $user){
		$validated = $req->validated();
		$user->name=$req->name;
		$user->email=$req->email;
		$user->password=Hash::make($req->password);
		$user->user_type=$req->user_type;
		if($user->save()){
			$user->api_token=md5($user->id.$req->email.$req->password.$req->user_type);
			$user->save();
			return response()->json(['status'=>1]);
		}else{
			return response()->json(['status'=>0,'data'=>'Unable to create/update user']);
		}
	}
	public function delete(User $user){
		$user->delete();
		return response()->json(['status'=>1]);
	}
}
