<?php

namespace ofernandoavila\Community\Controller\DisplayView;

use ofernandoavila\Community\Core\BasicViewController;
use ofernandoavila\Community\Core\Router;
use ofernandoavila\Community\Interfaces\IDisplayView;

class AccountDisplayViewController extends BasicViewController implements IDisplayView {
    public function BasicContext($data = []){}
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
