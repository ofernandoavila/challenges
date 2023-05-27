<?php

namespace ofernandoavila\Community\Controller;

use Exception;
use ofernandoavila\Community\Model\User;
use ofernandoavila\Community\Repository\ProjectRepository;
use ofernandoavila\Community\Repository\SessionRepository;
use ofernandoavila\Community\Repository\UserRepository;

class UserController {
    public function SaveUser(User $user) {
        $repo = new UserRepository();

        $user->SetPassword(password_hash($user->GetPassword(), PASSWORD_ARGON2I));
        
        if($repo->save($user)) {
            $_SESSION['msg']['type'] = "success";
            $_SESSION['msg']['text'] = "Success creating account";
            return true;
        } else {
            return false;
        }
    }

    public function DeleteUser(User $user)
    {
        $repo = new UserRepository();

        /**
         * @var User $user
         */
        $user = $repo->get($user->id);

        if($user->GetProjects()->count() > 0) {
            foreach($user->GetProjects() as $project) {
                $projectRepo = new ProjectRepository();
                $projectRepo->remove($project);
            }
        }

        $sessionController = new SessionController();
        $sessionController->DeleteSessionsByUser($user);
        SessionController::ClearSession();

        if ($repo->remove($user)) {
            $_SESSION['msg']['type'] = "success";
            $_SESSION['msg']['text'] = "Your account was deleted! We're gonna miss you...";
            return true;
        } else {
            return false;
        }
    }

    public function GetUserByID(int $id)
    {
        $repo = new UserRepository();
        $user = $repo->get($id);

        return $user;
    }

    public function GetUserBySessionHash(string $hash)
    {
        $sessionRepo = new SessionRepository();

        $session = $sessionRepo->repository->findBy(['hash' => $hash]);
        if ($session) {
            return $this->GetUserByID($session[0]->user_id);
        } else {
            return null;
        }
    }

    public function GetUserByUsername(string $username)
    {
        $userRepo = new UserRepository();

        $user = $userRepo->repository->findBy(['username' => $username]);
        if ($user) {
            return $this->GetUserByID($user[0]->id);
        } else {
            return null;
        }
    }

    public function CheckIfUserExist(User $user) {
        $repo = new UserRepository();

        $user = $repo->repository->findBy(['username' => $user->username]);
        return $user;
    }
}