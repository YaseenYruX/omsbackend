<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Quotes;
use App\Models\Quotes_item;

class QuotesitemController extends Controller
{
    //
    public function index(){
        $perpage=!empty($_GET['perpage'])?intval($_GET['perpage']):20;
        $sortcol=!empty($_GET['sortcol'])?$_GET['sortcol']:'id';
        $sorttype=!empty($_GET['sorttype'])?$_GET['sorttype']:'desc';
    	return Quotes_item::orderBy($sortcol,$sorttype)->paginate($perpage);
    }
    public function create_or_update(Request $request,Quotes_item $quotes_item){
   
			$quotes_item->item=$request->item;
			$quotes_item->sku=$request->sku;
			$quotes_item->qty=$request->qty;
			$quotes_item->total=$request->total;
			// $quotes_item->quotes_id=$quotes->id; 
    	if($quotes_item->save()){
    		return response()->json(['status'=>1,'id'=>$quotes_item->id]);
    	}
    	else{
    		return response()->json(['status'=>0]);
    	}
    }
    public function delete(Quotes_item $quotes_item){
        
    	$response = $quotes_item->delete();
        return response()->json(['status'=>1]);
    }
    public function get(Quotes_item $quotes_item){
    	return $quotes_item;
    }
}
