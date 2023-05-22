<?php

namespace ofernandoavila\Community\Model;

use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\GeneratedValue;
use Doctrine\ORM\Mapping\Id;
use ofernandoavila\Community\Controller\UserController;
use ofernandoavila\Community\Core\Model;
use ofernandoavila\Community\Repository\UserRepository;

#[Entity]
class User extends Model {

    #[Column, GeneratedValue, Id]
    public int $id;

    #[Column]
    public string $username;

    #[Column]
    private string $password;
    
    #[Column]
    public string $name;
    
    public function __construct(string $user, string $password)
    {
        $this->username = $user;
        $this->password = $password;

        parent::__construct(new UserRepository());
    }

    public function SetPassword($password) {
        $this->password = $password;
    }

    public function GetPassword() {
        return $this->password;
    }

    public static function Authenticate(User $user) {
        $userController = new UserController();

        $tmpUser = $userController->GetUserByUsername($user->username);

        if ($tmpUser != null) {
            if ($user->username == $tmpUser->username) {
                if (password_verify($user->GetPassword(), $tmpUser->GetPassword())) {
                    return true;
                } else {
                    $_SESSION['msg']['type'] = "warning";
                    $_SESSION['msg']['text'] = "Username/Password incorrect";
                    return false;
                }
            }
        } else {
            $_SESSION['msg']['type'] = "warning";
            $_SESSION['msg']['text'] = "Username/Password incorrect";
            return false;
        }
    }
}