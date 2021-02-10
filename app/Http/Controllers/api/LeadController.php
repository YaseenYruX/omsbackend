<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Lead;

class LeadController extends Controller
{
    //


    public function index()
    {

    	return Lead::paginate(20);
    }

    public function create_or_update(Request $request,Lead $lead)
    {
    	$lead->firstname=$request->firstname;
    	$lead->lastname=$request->lastname;
    	$lead->email=$request->email;
    	$lead->website=$request->website;
    	$lead->lead_tag=$request->lead_tag;
    	if($lead->save())
    	{
    		return response()->json(['status'=>1]);
    	}
    	else
    	{
    		return response()->json(['status'=>0]);
    	}
    }
    public function delete(Lead $lead)
    {
    	$response = $lead->delete();
    	return response()->json(['status'=>1]);
    }
    public function get(Lead $lead)
    {
    	return $lead;
    }
}
