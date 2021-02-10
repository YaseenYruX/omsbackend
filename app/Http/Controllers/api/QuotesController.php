<?php
namespace App\Http\Controllers\api;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Quotes;
use App\Models\Quotes_item;
class QuotesController extends Controller
{
    public function index(){
        $perpage=!empty($_GET['perpage'])?intval($_GET['perpage']):20;
        $sortcol=!empty($_GET['sortcol'])?$_GET['sortcol']:'id';
        $sorttype=!empty($_GET['sorttype'])?$_GET['sorttype']:'desc';
    	return Quotes::orderBy($sortcol,$sorttype)->paginate($perpage);
    }
    public function create_or_update(Request $request,Quotes $quotes){
   
    	$quotes->firstname=$request->firstname;
    	$quotes->lastname=$request->lastname;
    	$quotes->email=$request->email;
    	$quotes->website=$request->website;
    	$quotes->qoute_status=$request->qoute_status;
    	if($quotes->save()){
            foreach ($request->items as $item) {
                if(isset($item['id'])&&intval($item['id'])>0){
                    $quotes_item = Quotes_item::find($item['id']);
                }else{
                    $quotes_item = new Quotes_item;
                }
                $quotes_item->item=$item['item'];
                $quotes_item->sku=$item['sku'];
                $quotes_item->qty=$item['qty'];
                $quotes_item->price=$item['price'];
                $quotes_item->quotes_id=$quotes->id;
                $quotes_item->save();    
            }
    		return response()->json(['status'=>1,'id'=>$quotes->id]);
    	}
    	else{
    		return response()->json(['status'=>0]);
    	}
    }
    public function delete(Quotes $quotes){
        $id = $quotes->id;
    	$response = $quotes->delete();
        Quotes_item::where('quotes_id',$id)->delete();
        return response()->json(['status'=>1]);
    }
    public function get(Quotes $quotes){
    	return $quotes;
    }
}