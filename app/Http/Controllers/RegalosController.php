<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RegalosController extends Controller
{
    public function index(){
        return view('admin.regalos.index');
    }
}
