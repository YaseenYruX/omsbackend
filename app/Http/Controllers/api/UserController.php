<?php
namespace App\Http\Controllers\api;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
class UserController extends Controller
{
    public function index(){
        $perpage=!empty($_GET['perpage'])?intval($_GET['perpage']):20;
        $sortcol=!empty($_GET['sortcol'])?$_GET['sortcol']:'id';
        $sorttype=!empty($_GET['sorttype'])?$_GET['sorttype']:'desc';
        return User::orderBy($sortcol,$sorttype)->paginate($perpage);
    }
    public function create_or_update(Request $request,Brands $brands){
    	$brands->name=$request->name;
    	$brands->image=$request->image;
    	if($brands->save()){
    		return response()->json(['status'=>1]);
    	}
    	else{
    		return response()->json(['status'=>0]);
    	}
    }
    public function delete(Brands $brands){
    	$response = $brands->delete();
    	return response()->json(['status'=>1]);
    }
    public function get(Brands $brands){
    	return $brands;
    }
}
