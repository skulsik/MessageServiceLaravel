<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MainController extends Controller{
    public function create_message(){
        return view('create_message');
    }

    public function read_new_message(){
        return view('read_new_message');
    }

    public function all_messages(){
        return view('all_messages');
    }
}
