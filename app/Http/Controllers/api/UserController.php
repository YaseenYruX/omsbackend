<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    public function index()
    {

    	return User::paginate(20);
    }

    public function create_or_update(Request $request,Brands $brands)
    {
    	$brands->name=$request->name;
    	$brands->image=$request->image;
   
    	if($brands->save())
    	{
    		return response()->json(['status'=>1]);
    	}
    	else
    	{
    		return response()->json(['status'=>0]);
    	}
    }
    public function delete(Brands $brands)
    {
    	$response = $brands->delete();
    	return response()->json(['status'=>1]);
    }
    public function get(Brands $brands)
    {
    	return $brands;
    }
}
