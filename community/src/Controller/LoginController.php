<?php

namespace ofernandoavila\Community\Controller;

use ofernandoavila\Community\Core\BasicViewController;
use ofernandoavila\Community\Model\User;

class LoginController extends BasicViewController {
    public function LoginPage()
    {
        return $this->Render('LoginPage');
    }

    public function CreateAccountPage() {
        return $this->Render('CreateAccountPage');
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