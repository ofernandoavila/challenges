<?php

namespace ofernandoavila\Community\Controller\DisplayView;

use ofernandoavila\Community\Core\BasicViewController;
use ofernandoavila\Community\Core\Router;
use ofernandoavila\Community\Interfaces\IDisplayView;

class DashboardDisplayViewController extends BasicViewController implements IDisplayView {
    public function BasicContext($data = []) {}
    public function DashboardPage($data = []) {
        Router::CheckIfUserIsLogged();

        return $this->render('dashboard/DashboardPage', $data);
    }
}