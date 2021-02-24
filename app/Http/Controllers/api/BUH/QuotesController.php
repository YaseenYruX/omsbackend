<?php
namespace App\Http\Controllers\api\BUH;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Quotes;
use App\Models\UserBrands;
use App\Models\Brands;
use Auth;
class QuotesController extends Controller
{
    public function get(Request $req,Quotes $quote){
        $brandcheck=$req->user()->userbrands()->where('brand_id',$quote->brand_id)->first();
        if($brandcheck){
            return Quotes::with('items','items.condition','items.brands',
            'purchaserquotes.purchaser',
            'purchaserquotes.quoteitems.brands',
            'purchaserquotes.quoteitems.condition',
            'purchaserquotes.quoteitems.prices.brand',
            'purchaserquotes.quoteitems.prices.condition',
            )->find($quote->id);
        }
        return response()->json(['status'=>0,'data'=>'Quote does not belong to you']);
    }

    public function brandquote(Request $request, Brands $brand)
    {
        if($brand->id)
        {
            $quotes = Quotes::where('brand_id',$brand->id)->paginate(20);
        }
        else
        {
            $quotes = Quotes::paginate(20);
        }
        return $quotes;
    }
}