<?php

namespace ofernandoavila\Community\Controller;

use ofernandoavila\Community\Core\BasicViewController;
use ofernandoavila\Community\Core\Router;

class AccountController extends BasicViewController
{
    public function MyAccountPage($data = [])
    {
        Router::CheckIfUserIsLogged();
        
        return $this->Render('account/MyAccount', $data);
    }

    public function EditAccountPage($data = [])
    {
        Router::CheckIfUserIsLogged();

        return $this->Render('account/EditAccount', $data);
    }

    public function SettingsAccountPage($data = [])
    {
        Router::CheckIfUserIsLogged();

        return $this->Render('account/SettingsAccount', $data);
    }
}
