<?php

namespace App\Http\Controllers;

use App\Http\Requests\MessageFormPost;
use App\MessageModel;
use http\Client\Curl\User;
use Illuminate\Http\Request;

class MainController extends Controller{
    public function form_message(){
        $user_now = auth()->user();
        $users = new \App\User();
        return view('form_message', ['users_list' => $users->all(), 'email' => $user_now->email]);
    }

    public function create_message(MessageFormPost $request){
        $user_now = auth()->user();
        $id_user_now = $user_now->id;
        $message = new MessageModel();
        $message->message_text = $request->input('message_text');
        $message->user_id = $id_user_now;
        $message->client_id = $request->input('client_id');
        $message->read = true;
        $message->created_at = now();
        $message->save();

        return redirect()->route('form_message');
    }

    public function read_new_message(){
        return view('read_new_message');
    }

    public function all_messages(){
        return view('all_messages');
    }
}
