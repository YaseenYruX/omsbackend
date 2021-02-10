<?php

namespace App\Http\Controllers\api\purchaser;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Quotes;
use App\Models\Quotes_item;
use App\Models\Quotes_purchaser_price;

class QuotesController extends Controller
{
    public function unanswered()
    {

        $perpage=!empty($_GET['perpage'])?intval($_GET['perpage']):20;
        $sortcol=!empty($_GET['sortcol'])?$_GET['sortcol']:'id';
        $sorttype=!empty($_GET['sorttype'])?$_GET['sorttype']:'desc';
    	return Quotes::orderBy($sortcol,$sorttype)->where('qoute_status','Open')->paginate($perpage);
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

    public function multiitemquote(Request $request, Quotes_item $quotes_item)
    {
       $quotes_item->prices()->delete();
        foreach ($request->purchaser as $items) {
            $purchaser = new Quotes_purchaser_price();
            $purchaser->qty = $items['qty'];
            $purchaser->price = $items['price'];
            $purchaser->supplier_name = $items['supplier_name'];
            $purchaser->quotes_item_id = $quotes_item->id;
            $purchaser->save();
            
        }
        return response()->json(['status'=>1]);
    }
}
