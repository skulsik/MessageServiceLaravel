<?php

namespace App\Service;

use App\MessageModel;

class Message {
    function get_messages_user_auth(int $user_id) {
        // получает список объектов (сообщения) принадлежащих авторизованному пользователяю
        $this->messages_owner_all = MessageModel::where('user_id', $user_id)->orWhere('client_id', $user_id)->orderBy('id', 'desc')->get();
    }

    public function messages_owner_all_modified(int $user_id, Object $users) {
        // Запрвшивает сообщения, которые принадлежат текущему пользователю
        $this->get_messages_user_auth($user_id);

        $messages_modified = array();
        $count_new_messages = 0;

        foreach ($this->messages_owner_all as $message){
            // Узнает с кем идет переписка
            if ($message->user_id == $user_id) $key = $message->client_id;
            else{
                $key = $message->user_id;

                // Считает количество непрочитанных
                if ($message->read) $count_new_messages++;
            }

            // Превращает объект в коллекцию(нужно для отображения непрочитанных сообщений)
            $message_col = collect($message->toArray())->all();

            // Добавляет собеседника в массив, если его там нет. Собеседнику добавляет объект сообщения.
            if (!array_key_exists($key, $messages_modified)) {
                $messages_modified[$key] = [$users[$key-1], [$message_col]];
            }
            else {
                array_push($messages_modified[$key][1], $message_col);
            }

            // Ставит статус владельца сообщения false - прочитано
            if ($message->client_id == $user_id and $message->read){
                $message->read = false;
                $message->save();
            }
        }

        return array("messages_modified" => $messages_modified, "count_new_messages" => $count_new_messages);
    }

    public function create_message($request, $user_id){
        // Создает новое сообщение
        $message = new MessageModel();
        $message->message_text = $request->input('message_text');
        $message->user_id = $user_id;
        $message->client_id = $request->input('client_id');
        $message->read = true;
        $message->created_at = now();
        $message->save();
    }
}