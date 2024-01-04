<?php

namespace App\Service;

class BaseUsersGetAll {
    function __construct(){
        $this->users = \App\User::orderBy('id')->get();
    }
}

class UsersGetAll extends BaseUsersGetAll {
    public function get_all_users(){
        return $this->users;
    }
}