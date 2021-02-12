<?php
namespace App\Http\Controllers\api\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Admin\UserCURequest;
use App\Models\Brands;
use Hash;
class LeadController extends Controller
{
    public function fetchbrands(){
    	return Brands::select('id','name')->get();
    }
}
