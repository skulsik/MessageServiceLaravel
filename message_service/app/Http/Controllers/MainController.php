<?php

namespace App\Http\Controllers;

use App\Http\Requests\MessageFormPost;
use App\MessageModel;
use Illuminate\Support\Facades\DB;

class MainController extends Controller{
    public function form_message(){
        // Полоучает текущего пользователя
        $user_now = auth()->user();
        // Получает почту, текущего пользователя
        $email = $user_now->email;

        // Получает всех пользователей
        $users = \App\User::all();
        return view('form_message', ['users_list' => $users, 'email' => $email]);
    }

    public function create_message(MessageFormPost $request){
        // Полоучает текущего пользователя
        $user_now = auth()->user();
        // Получает id, текущего пользователя
        $id_user_now = $user_now->id;

        // Создает новое сообщение
        $message = new MessageModel();
        $message->message_text = $request->input('message_text');
        $message->user_id = $id_user_now;
        $message->client_id = $request->input('client_id');
        $message->read = true;
        $message->created_at = now();
        $message->save();

        return redirect()->route('all_messages');
    }

    public function read_new_message(){
        // Получает текущего пользователя
        $user_now = auth()->user();
        // Получает id, текущего пользователя
        $id_user_now = $user_now->id;

        // Запрвшивает сообщения, которые принадлежат текущему пользователю
        $count_messages = DB::table('message_models')->where('user_id', $id_user_now)->orWhere('client_id', $id_user_now)->where('read', true)->count();

        return redirect()->route('all_messages', ['$count_messages' => $count_messages]);
    }

    public function all_messages(){
        // Получает текущего пользователя
        $user_now = auth()->user();
        // Получает id, текущего пользователя
        $id_user_now = $user_now->id;

        // Получает всех пользователей, с сортировкой по id
        $users = \App\User::orderBy('id')->get();

        // Запрвшивает сообщения, которые принадлежат текущему пользователю
        $messages = DB::table('message_models')->where('user_id', $id_user_now)->orWhere('client_id', $id_user_now)->orderBy('id', 'desc')->get();
        $messages_modified = array();
        $count_new_messages = 0;
        foreach ($messages as $message){
            // Считает количество непрочитанных
            if ($message->read == true) $count_new_messages++;

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

        return view('all_messages', [
            'messages' => $messages_modified,
            'user' => $user_now,
            'count_new_messages' => $count_new_messages
        ]);
    }
}
