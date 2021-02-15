<?php
namespace App\Http\Controllers\api;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Lead;
use Auth;
use Illuminate\Support\Facades\Storage;

class LeadController extends Controller
{
    public function index(){
        $perpage=!empty($_GET['perpage'])?intval($_GET['perpage']):20;
        $sortcol=!empty($_GET['sortcol'])?$_GET['sortcol']:'id';
        $sorttype=!empty($_GET['sorttype'])?$_GET['sorttype']:'desc';
        return Lead::orderBy($sortcol,$sorttype)->paginate($perpage);
    }
    public function create_or_update(Request $request,Lead $lead){

        /* On update delete old image */

        if(intval($lead->id)>0){
            Storage::delete($lead->image);}
            /* deleting ends*/

        $lead->brand_id=$request->brand_id;
        $lead->assigned_id=$request->assigned_id;
        $lead->lead_owner=Auth::guard('api')->user()->id;
        $lead->user_id=Auth::guard('api')->user()->id;
        $lead->title=$request->title;
        $lead->company=$request->company;
    	$lead->firstname=$request->firstname;
    	$lead->lastname=$request->lastname;
    	$lead->email=$request->email;
        $lead->mobile=$request->mobile;
    	$lead->website=$request->website;
        $lead->lead_source=$request->lead_source;
    	$lead->lead_status=$request->lead_status;
        $lead->Industry=$request->industry;
        $lead->total_employees=$request->total_employees;
        $lead->annual_revenue=$request->annual_revenue;
        $lead->ratings=$request->ratings;
        $lead->skype_id=$request->skype_id;
        $lead->twitter=$request->twitter;
        $lead->secondary_email=$request->secondary_email;
        $lead->street=$request->street;
        $lead->state=$request->state;
        $lead->city=$request->city;
        $lead->zip_code=$request->zip_code;
        $lead->country=$request->country;
        $lead->currency=$request->currency;
        $lead->description=$request->description;

        //for image
        if($request->hasFile('image'))
        {
            $path = $request->file('image')->store('leads');
            $lead->image=$path;
        }


    	if($lead->save()){
    		return response()->json(['status'=>1]);
    	}
    	else{
    		return response()->json(['status'=>0]);
    	}
    }
    public function delete(Lead $lead){
    	$response = $lead->delete();
    	return response()->json(['status'=>1]);
    }
    public function get(Lead $lead){
        $leads=Lead::with('sales')->findOrFail($lead->id);
        //return $quotes;
    	return $leads;
    }
}
