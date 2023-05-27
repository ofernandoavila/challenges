<?php

namespace ofernandoavila\Community\Controller;

use ofernandoavila\Community\Core\BasicViewController;
use ofernandoavila\Community\Core\Router;

class DashboardController extends BasicViewController {
    public function DashboardPage($data = []) {
        Router::CheckIfUserIsLogged();

        return $this->render('dashboard/DashboardPage', $data);
    }
}