<?php

namespace App\Http\Controllers\CustomerArea;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HomeController extends ParentController
{
    public function index()
    {
        return view('CustomerArea.pages.dashboard.index');
    }
}
