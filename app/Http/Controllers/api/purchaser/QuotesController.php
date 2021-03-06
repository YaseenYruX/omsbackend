<?php

namespace App\Http\Controllers\api\purchaser;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Quotes;
use App\Models\Quotes_item;
use App\Models\Quotes_purchaser_price;
use App\Models\Brands;
use App\Models\M_flag;
use App\Models\Purchaser_quote;
use Auth;
class QuotesController extends Controller
{
    public function answered(Request $request,Purchaser_quote $purchaser_quote)
    {
        $id = Purchaser_quote::where('id',$purchaser_quote->id)->update(['status'=>1,'lead_time'=>$request->lead_time,'additional_details'=>$request->additional_details,'shipping'=>$request->shipping]);
        if($id>0)
        {
            return response()->json(['status'=>1]);
        }
    }
    public function unanswered()
    {

        $perpage=!empty($_GET['perpage'])?intval($_GET['perpage']):20;
        $sortcol=!empty($_GET['sortcol'])?$_GET['sortcol']:'id';
        $sorttype=!empty($_GET['sorttype'])?$_GET['sorttype']:'desc';
    	//return Quotes::orderBy($sortcol,$sorttype)->paginate($perpage);
       return Purchaser_quote::with('quote.quote_brand')->where('purchaser_id',Auth::guard('api')->user()->id)->where('status',0)->orderBy($sortcol,$sorttype)->paginate($perpage);
    }

    public function itemquote(Request $request,Quotes_item $quotes_item)
    {
    
    	$purchaser = new Quotes_purchaser_price();
    	$purchaser->qty = $request->qty;
    	$purchaser->price = $request->price;
    	$purchaser->supplier_name = $request->supplier_name;
    	$purchaser->quotes_item_id = $quotes_item->id;
    	if($purchaser->save())
    	{
    		return response()->json(['status'=>1]);
    	}
    }

    public function multiitemquote(Request $request, Purchaser_quote $purchaser_quote,Quotes_item $quotes_item)
    {

       $quotes_item->prices()->delete();
       // $p = new Purchaser_quote;
       // $p->quote_id= $request->quote_id;
       // $p->shipping= $request->shipping;
       // $p->additional_details= $request->additional_details;
       // $p->lead_time= $request->lead_time;
       // $p->purchaser_id= Auth::guard('api')->user()->id;
       // $p->status=1;
       // $p->save(); 
        foreach ($request->purchaser as $items) {
            $purchaser = new Quotes_purchaser_price();
            $purchaser->qty = $items['qty'];
            $purchaser->item = $items['item'];
            $purchaser->description = $items['description'];
            $purchaser->price = $items['price'];
            $purchaser->brand_id = $items['brand_id'];
            $purchaser->condition_id = $items['condition_id'];
            $purchaser->supplier_name = $items['supplier_name'];
            $purchaser->quotes_item_id = $quotes_item->id;
            $purchaser->purchaser_quote_id=$purchaser_quote->id;
            $purchaser->purchaser_id=Auth::guard('api')->user()->id;
            $purchaser->save();
            
        }
        return response()->json(['status'=>1]);
    }
    public function getquotes($id)
    {
        //$quotes=Quotes::with('items','items.prices','lead','lead.sales','items.brands','items.condition')->findOrFail($id);
        $quotes=Purchaser_quote::with('quote','quote.items','quote.items.prices','quote.lead','quote.lead.sales','quote.items.brands','quote.items.condition')->findOrFail($id);
        return $quotes;
    }

    public function getbrands()
    {
        $brands = Brands::get();
        return $brands;
    }
    public function conditions()
    {
        $con = M_flag::where('flag_type','conditions')->get();
        return $con;
    }
    public function getitembrand()
    {
        $item_brand = M_flag::where('flag_type','brand')->get();
        return $item_brand;
    }
}
