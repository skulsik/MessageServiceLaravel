<?php

namespace App\Http\Controllers;

use App\Http\Requests\MessageFormPost;
use App\MessageModel;
use http\Client\Curl\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
        // Получает текущего пользователя
        $user_now = auth()->user();
        $id_user_now = $user_now->id;

        // Получает всех пользователей, с сортировкой по id
        $users = \App\User::orderBy('id')->get();

        // Запрвшивает сообщения, которые принадлежат текущему пользователю
        $messages = DB::table('message_models')->where('user_id', $id_user_now)->orWhere('client_id', $id_user_now)->get();
        $messages_modified = array();
        foreach ($messages as $message){
            // Узнает с кем идет переписка
            if ($message->user_id == $id_user_now) $key = $message->client_id;
            else $key = $message->user_id;

            // Добавляет собеседника в массив, если его там нет. Собеседнику добавляет объект сообщения.
            if (!array_key_exists($key, $messages_modified)) {
                $messages_modified[$key] = [$users[$key-1], [$message]];
            }
            else {
                array_push($messages_modified[$key][1], $message);
            }
        }

        return view('all_messages', ['messages' => $messages_modified, 'user' => $user_now]);
    }
}
