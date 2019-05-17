<?php

namespace App\Http\Controllers\Demo;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DemoController extends Controller
{
    //
    public function demo() {
        $user = auth('api')->user();
        dd($user);
    }
}
