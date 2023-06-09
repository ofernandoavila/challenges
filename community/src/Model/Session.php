<?php

namespace ofernandoavila\Community\Model;

use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\GeneratedValue;
use Doctrine\ORM\Mapping\Id;
use Exception;
use ofernandoavila\Community\Controller\UserController;
use ofernandoavila\Community\Core\Model;
use ofernandoavila\Community\Model\User;
use ofernandoavila\Community\Repository\SessionRepository;

#[Entity]
class Session extends Model {

    #[Column, GeneratedValue, Id]
    public int $id;

    #[Column]
    public int $user_id;
    
    #[Column]
    public string $hash;

    public User $user;

    public function __construct(User $user)
    {
        $this->user = $user;
        $this->user_id = $user->id;
        $this->hash = $this->GenerateHashSession($user);

        parent::__construct(new SessionRepository());
    }

    public function SetUser(User $user) {
        $this->user = $user;
    }

    private function GenerateHashSession(User $user) {
        $key = $user->id . $user->username . date('d/m/Y H:i:s');

        return hash( 'sha256' , $key);
    }

    public static function RegisterSession(Session $session) {
        $_SESSION['user_session'] = $session->hash;
    }

    public static function GetCurrentUser() {
        if(!isset($_SESSION['user_session'])) throw new Exception('There is no user session saved');

        $userController = new UserController();

        return $userController->GetUserBySessionHash($_SESSION['user_session']);
    }
}