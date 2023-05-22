<?php

namespace ofernandoavila\Community\Model;

use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\GeneratedValue;
use Doctrine\ORM\Mapping\Id;
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
        return hash( 'sha256' , $user->id . $user->username . date('m/d/Y'));
    }

    public static function RegisterSession(Session $session) {
        $_SESSION['user_session'] = $session->hash;
    }
}