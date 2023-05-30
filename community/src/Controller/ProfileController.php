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

        $data['user'] = $user->GetUserByUsername($data['username']);

        return $this->render('profile/ProfilePage', $data);
    }
}