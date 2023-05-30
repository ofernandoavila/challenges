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

        $user = new UserController();
        $project = new ProjectController();

        $data['user'] = $user->GetUserByUsername($data['username']);

        if($data['user'] != null) $data['projects'] = $project->GetProjectsByUser($data['user']);

        return $this->render('profile/ProfilePage', $data);
    }
}