<?php
namespace App\Http\Controllers\api\Sales;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Quotes;
use App\Models\Quotes_item;
use App\Models\Purchaser_quote;
use App\Models\User;
use App\Models\UserBrands;
use App\Models\M_flag;
use Auth;
class QuotesController extends Controller
{
    public function index(){
        $perpage=!empty($_GET['perpage'])?intval($_GET['perpage']):20;
        $sortcol=!empty($_GET['sortcol'])?$_GET['sortcol']:'id';
        $sorttype=!empty($_GET['sorttype'])?$_GET['sorttype']:'desc';
    	return Quotes::with('quote_brand')->where('owner',Auth::guard('api')->user()->id)->orderBy($sortcol,$sorttype)->paginate($perpage);
    }
    public function create_or_update(Request $request,Quotes $quotes){
        $pu_create=1;
        if($quotes->id)
        {
            $pu_create=0;
        }
    	$quotes->firstname=$request->firstname;
    	$quotes->lastname=$request->lastname;
    	$quotes->email=$request->email;
    	$quotes->owner=Auth::guard('api')->user()->id;
        $quotes->mobile=$request->mobile;
        $quotes->lead_id=$request->lead_id;
        $quotes->brand_id=$request->brand_id;
    	$quotes->company=$request->company;
        $quotes->street=$request->street;
        $quotes->city=$request->city;
        $quotes->state=$request->state;
        $quotes->zip_code=$request->zip_code;
        $quotes->country=$request->country;
        $quotes->currency=$request->currency;
        $quotes->lead_time = $request->lead_time;
        $quotes->additional_details= $request->additional_details;
        $quotes->shipping=($request->shipping==null)?$request->shipping:0;
        $quotes->vat=($request->vat==null)?$request->vat:0;
        $quotes->description=$request->description;
        $quotes->quote_status=$request->quote_status;
    	if($quotes->save())
        {
            if($pu_create==1)
            {

                $brand_user = UserBrands::select('user_id')->where('brand_id',$request->brand_id)->get();
                foreach ($brand_user as $u) 
                {
                    $user = User::where('user_type',3)->where('id',$u->user_id)->first();
                    if($user)
                    {
                        $purchaser_quote = new Purchaser_quote;
                        $purchaser_quote->quote_id = $quotes->id;
                        $purchaser_quote->purchaser_id= $user->id;
                        $purchaser_quote->lead_time = $request->lead_time;
                        $purchaser_quote->shipping = 0;
                        $purchaser_quote->additional_details = $request->additional_details;
                        $purchaser_quote->status = 0;
                        $purchaser_quote->save();
                    }
                }
            }
            
            foreach ($request->items as $item) {
                if(isset($item['id'])&&intval($item['id'])>0){
                    $quotes_item = Quotes_item::find($item['id']);
                }else{
                    $quotes_item = new Quotes_item;
                }
                $quotes_item->brand=$item['brand'];
                $quotes_item->item=$item['item'];
                // $quotes_item->sku=$item['sku'];
                $quotes_item->description=$item['description'];
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
        Quotes_item::where('quote_id',$id)->delete();
        return response()->json(['status'=>1]);
    }
    public function get($id){
        $quotes=Quotes::with('items','items.prices','lead','lead.sales')->findOrFail($id);
    	return $quotes;
    }
    public function getbrands()
    {
        $brandids= UserBrands::with('brand_get')->where('user_id',Auth::guard('api')->user()->id)->get();
        foreach ($brandids as $key => $value) 
        {
          $brand[$key] = $value->brand_get;
        }
        return $brand;
    }
    public function getitembrand()
    {
        $item_brand = M_flag::where('flag_type','brand')->get();
        return $item_brand;
    }
}