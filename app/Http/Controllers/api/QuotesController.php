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
    	$quotes->owner=$request->owner;
        $quotes->mobile=$request->mobile;
        $quotes->lead_id=$request->lead_id;
    	$quotes->company=$request->company;
        $quotes->street=$request->street;
        $quotes->city=$request->city;
        $quotes->state=$request->state;
        $quotes->zip_code=$request->zip_code;
        $quotes->country=$request->country;
        $quotes->currency=$request->currency;
        $quotes->shipping=$request->shipping;
        $quotes->vat=$request->vat;
        $quotes->description=$request->description;
        $quotes->quote_status=$request->quote_status;
    	if($quotes->save()){
            foreach ($request->items as $item) {
                if(isset($item['id'])&&intval($item['id'])>0){
                    $quotes_item = Quotes_item::find($item['id']);
                }else{
                    $quotes_item = new Quotes_item;
                }
                $quotes_item->item=$item['item'];
                $quotes_item->sku=$item['sku'];
                $quotes_item->conditions=$item['conditions'];
                $quotes_item->qty=$item['qty'];
                $quotes_item->price=$item['price'];
                $quotes_item->quote_id=$quotes->id;
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
    public function get($id){
        $quotes=Quotes::with('items','items.prices','lead','lead.sales')->findOrFail($id);
    	return $quotes;
    }
}