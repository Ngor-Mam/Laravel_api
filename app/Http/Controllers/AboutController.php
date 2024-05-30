<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AboutController extends Controller
{
    public function index(){
        return "Welcome to About Page";
    }
    public function sayMorning(){
        return "hello , good morning";
    }

}
