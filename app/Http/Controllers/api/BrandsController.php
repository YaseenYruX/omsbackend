<?php
namespace App\Http\Controllers\api;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Brands;
use Illuminate\Support\Facades\Storage;
class BrandsController extends Controller
{
	public function index(){
        $perpage=!empty($_GET['perpage'])?intval($_GET['perpage']):20;
        $sortcol=!empty($_GET['sortcol'])?$_GET['sortcol']:'id';
        $sorttype=!empty($_GET['sorttype'])?$_GET['sorttype']:'desc';
        return Brands::orderBy($sortcol,$sorttype)->paginate($perpage);
    }
    public function create_or_update(Request $request,Brands $brands){
        if(intval($brands->id)>0){
            Storage::delete($brands->image);}
    	$brands->name=$request->name;
        $path = $request->file('image')->store('brands');
    	$brands->image=$path;
    	if($brands->save()){

    		return response()->json(['status'=>1]);
    	}
    	else{
    		return response()->json(['status'=>0]);
    	}
    }
    public function delete(Brands $brands){
        Storage::delete($brands->image);
    	$response = $brands->delete();
    	return response()->json(['status'=>1]);
    }
    public function get(Brands $brands){
    	return $brands;
    }
    public function fileurl($filepath){
        $url = asset('storage/brands/'.$filepath);
        return response()->json(['url'=>$url]);
    }
}