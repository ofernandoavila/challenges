<?php

namespace ofernandoavila\Community\Model;

class User {
    public string $username;
    private string $password;
    public string $name;
    
    public function __construct(string $user, string $password)
    {
        $this->username = $user;
        $this->password = $password;   
    }

    public function GetPassword() {
        return $this->password;
    }

    public static function CreateUser(User $user) {
        $createdUser = [
            'name' => $user->name,
            'username' => $user->username,
            'password' => password_hash($user->GetPassword(), PASSWORD_ARGON2I)
        ];

        if(isset($_SESSION['user'])) {
            if($_SESSION['user']['username'] == $user->username) {
                $_SESSION['error_msg'] = "Username already been used";
                return false;
            } else {
                unset($_SESSION['user']);
            }
        }

        $_SESSION['user'] = $createdUser;

        return true;
    }

    public static function Authenticate(User $user) {
        if(isset($_SESSION['user'])) {
            if ($user->username == $_SESSION['user']['username']) {
                if(password_verify($user->GetPassword(), $_SESSION['user']['password'])) {
                    return true;
                } else {
                    $_SESSION['error_msg'] = "Username/Password incorrect";
                    return false;
                }
            }
        } else {
            $_SESSION['error_msg'] = "There is no user saved into session";
            return false;
        }
    }
}