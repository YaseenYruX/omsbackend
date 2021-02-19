<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\M_flag;

class M_flagController extends Controller
{
    //
    public function conditions($value='')
    {
    	# code...
    	return M_flag::where('flag_type','conditions')->get();
    	
    }
}
