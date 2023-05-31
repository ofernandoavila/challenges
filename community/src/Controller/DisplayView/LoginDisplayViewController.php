<?php

namespace ofernandoavila\Community\Controller\DisplayView;

use ofernandoavila\Community\Controller\SessionController;
use ofernandoavila\Community\Core\BasicViewController;
use ofernandoavila\Community\Interfaces\IDisplayView;
use ofernandoavila\Community\Model\User;

class LoginDisplayViewController extends BasicViewController implements IDisplayView {
    public function BasicContext($data = []) {}
    public function LoginPage($data)
    {
        return $this->Render('LoginPage', $data);
    }

    public function CreateAccountPage($data = []) {
        return $this->Render('CreateAccountPage', $data);
    }

    public function Logoff()
    {
        try {
            if (SessionController::DeleteCurrentSession()) {
                SessionController::DefineMessage("Your session was destroyed!", 'success');
                Redirect('/');
            }
        } catch (\Exception $error) {
            SessionController::DefineErrorMessage($error->getMessage());
        }
    }
}