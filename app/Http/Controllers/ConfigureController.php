<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;

class ConfigureController extends Controller
{
    function index(){
        return view('configure');
    }
}
