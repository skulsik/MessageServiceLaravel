<?php

namespace App\Service;

class BaseUserAuthGet{
    function __construct(){
        // Получает текущего пользователя
        $this->user_now = auth()->user();
    }
}

class UserAuthGet extends BaseUserAuthGet {
    public function get_user(){
        return $this->user_now;
    }

    public function user_id(){
        //
        return $this->user_now->id;
    }

    public function user_email(){
        return $this->user_now->email;
    }
}
