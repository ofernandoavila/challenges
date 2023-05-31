<?php

namespace ofernandoavila\Community\Controller;

use ofernandoavila\Community\Core\Controller;
use ofernandoavila\Community\Repository\UserRepository;

class ProfileController extends Controller {
    public function __construct()
    {
        parent::__construct(new UserRepository());
    }

    public function ProfilePage($data = []) {

        $userController = new UserController();
        $project = new ProjectController();


        $data['profile_user'] = $userController->GetUserByUsername($data['username']);

        if(isset($data['user'])) {
            $currentUser = $userController->GetUserByID($data['user']->id);
            
            $data['isFollowing'] = $userController->IsFollowing($currentUser, $data['profile_user']);
        } else {
            $data['isFollowing'] = false;
        }

        if($data['profile_user'] != null) $data['projects'] = $project->GetProjectsByUser($data['profile_user']);

        return $this->render('profile/ProfilePage', $data);
    }
}