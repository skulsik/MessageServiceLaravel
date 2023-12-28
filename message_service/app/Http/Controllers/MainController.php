<?php

namespace App\Http\Controllers;

use App\Http\Requests\MessageFormPost;
use Illuminate\Http\Request;

class MainController extends Controller{
    public function form_message(){
        return view('form_message');
    }

    public function create_message(MessageFormPost $request){
        dd($request);
    }

    public function read_new_message(){
        return view('read_new_message');
    }

    public function all_messages(){
        return view('all_messages');
    }
}
