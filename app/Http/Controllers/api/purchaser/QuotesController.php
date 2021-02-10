<?php

namespace App\Http\Controllers\api\purchaser;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Quotes;

class QuotesController extends Controller
{
    public function unanswered()
    {

        $perpage=!empty($_GET['perpage'])?intval($_GET['perpage']):20;
        $sortcol=!empty($_GET['sortcol'])?$_GET['sortcol']:'id';
        $sorttype=!empty($_GET['sorttype'])?$_GET['sorttype']:'desc';
    	return Quotes::orderBy($sortcol,$sorttype)->where('qoute_status','Open')->paginate($perpage);
    }
}
