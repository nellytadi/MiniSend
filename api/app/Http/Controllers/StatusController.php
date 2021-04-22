<?php

namespace App\Http\Controllers;

use App\Helpers\Helper;

class StatusController extends Controller
{
    public function getStatuses(){
        return response()->json((new Helper)->getStatuses());
    }
}
