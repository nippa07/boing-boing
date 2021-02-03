<?php

namespace App\Http\Controllers\AdminArea;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HomeController extends ParentController
{
    public function index()
    {
        return view('AdminArea.pages.dashboard.index');
    }
}
