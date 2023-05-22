<?php

namespace ofernandoavila\Community\Controller;

use Exception;
use ofernandoavila\Community\Model\Session;
use ofernandoavila\Community\Model\User;
use ofernandoavila\Community\Repository\SessionRepository;
use ofernandoavila\Community\Repository\UserRepository;

class SessionController
{
    public function SaveSession(User $user)
    {
        $repo = new SessionRepository();

        $session = new Session($user);

        if ($repo->save($session)) {

            Session::RegisterSession($session);

            return true;
        } else {
            return false;
        }
    }

    public function GetSessionByHash(string $hash)
    {
        $repo = new SessionRepository();
        $userController = new UserController();

        /**
         * @var Session $session
         */
        $session = $repo->repository->findBy(['hash' => $hash]);

        $session = $this->GetSessionByID($session[0]->id);
        $user = $userController->GetUserBySessionHash($hash);
        
        $session->SetUser($user);
        
        return $session;
    }

    public function GetSessionByID(int $id) {
        $repo = new SessionRepository();

        return $repo->get($id);
    }

    public function CheckIfUserExist(User $user)
    {
        $repo = new UserRepository();

        $user = $repo->repository->findBy(['username' => $user->username]);
        return $user;
    }

    public function DeleteSessionsByUser(User $user)
    {
        $repo = new SessionRepository();
        $sessions = $repo->repository->findBy(['user_id' => $user->id]);

        return $repo->removeCollection($sessions);
    }

    public function DeleteSessionByUser(User $user)
    {
        $repo = new SessionRepository();
        $session = $repo->repository->findBy(['user_id' => $user->id])[0];

        return $repo->remove($session);
    }

    public static function ClearSession() {
        unset($_SESSION['user_session']);
    }

    public static function DeleteCurrentSession()
    {
        if(isset($_SESSION['user_session'])) {
            $repo = new SessionRepository();
            $session = $repo->repository->findBy(['hash' => $_SESSION['user_session']])[0];

            unset($_SESSION['user_session']);

            return $repo->remove($session);
        } else throw new Exception('There is no session to be destroy');
    }

    public static function DefineErrorMessage(string $text)
    {
        $_SESSION['msg']['type'] = 'danger';
        $_SESSION['msg']['text'] = $text;
    }

    public static function DefineMessage(string $text, string $type)
    {
        $_SESSION['msg']['type'] = $type;
        $_SESSION['msg']['text'] = $text;
    }
}
