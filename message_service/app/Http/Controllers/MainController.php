<?php

namespace App\Http\Controllers;

use App\Http\Requests\MessageFormPost;
use App\Service\Message;
use App\Service\UserAuthGet;
use App\Service\UsersGetAll;

class MainController extends Controller{
    public function form_message(){
        // Экземпляр класса UserAuthGet()
        $user_auth_get = new UserAuthGet();
        // Получает почту, текущего пользователя
        $email = $user_auth_get->user_email();

        // Экземпляр класса UsersGetAll()
        $users_get_all = new UsersGetAll();
        // Получает всех пользователей, с сортировкой по id
        $users = $users_get_all->get_all_users();

        return view('form_message', ['users_list' => $users, 'email' => $email]);
    }

    public function create_message(MessageFormPost $request){
        // Экземпляр класса UserAuthGet()
        $user_auth_get = new UserAuthGet();
        // Получает id, текущего пользователя
        $id_user_now = $user_auth_get->user_id();

        // Экземпляр класса Message()
        $message = new Message();
        // Создает новое сообщение
        $message->create_message($request, $id_user_now);

        return redirect()->route('all_messages');
    }

    public function all_messages(){
        // Экземпляр класса UserAuthGet()
        $user_auth_get = new UserAuthGet();
        // Получает текущего пользователя
        $user_now = $user_auth_get->get_user();
        // Получает id, текущего пользователя
        $id_user_now = $user_auth_get->user_id();

        // Экземпляр класса UsersGetAll()
        $users_get_all = new UsersGetAll();
        // Получает всех пользователей, с сортировкой по id
        $users = $users_get_all->get_all_users();

        // Экземпляр класса Message()
        $message = new Message();
        // Формирует список сообщений
        $message_arg = $message->messages_owner_all_modified($id_user_now, $users);

        return view('all_messages', [
            'messages' => $message_arg["messages_modified"],
            'user' => $user_now,
            'count_new_messages' => $message_arg["count_new_messages"]
        ]);
    }
}
