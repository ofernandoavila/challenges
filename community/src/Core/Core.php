<?php

namespace ofernandoavila\Community\Core;

use ofernandoavila\Community\Controller\SessionController;

class Core {
    public Array $request;
    private Array $config;

    public function __construct() {
        $this->config = require_once __DIR__ . '/../config/config.php';
        $this->ConfigureRequest();
        $this->GetLoggedUserData();
    }

    private function GetLoggedUserData() {
        if(isset($_SESSION['user_session'])) {
            $sessionController = new SessionController();
            $session = $sessionController->GetSessionByHash($_SESSION['user_session']);

            $this->request['data']['session'] = $session;
            $this->request['data']['user'] = $session->user;
        }
    }

    private function ConfigureRequest() {
        $requestData = str_replace($this->config['prefix'], "", filter_var($_SERVER['REQUEST_URI'], FILTER_SANITIZE_URL));
        $url = explode("?", $requestData)[0];

        $this->request = array(
            'url' => $url,
            'method' => $_SERVER['REQUEST_METHOD']
        );

        $this->request['data'] = $this->GetRequestData();

        $apacheHeaders = apache_request_headers();

        if(isset($apacheHeaders['Content-Type'])) {
            $this->request['isJson'] = true;
        }
    }

    public function Init() {
        global $router;

        foreach($router->GetRoutes() as $route) {
            
            if($this->request['method'] == $route['method']) {
                if($this->request['url'] == $route['path']) {
                    $this->request['route'] = $route;
                }
            }
        }

        // echo '<pre>';
        // var_dump($this->request);
        // echo '</pre>';
        // die;
        if(isset($this->request['route'])) {
            return $this->request['route']['function']($this->request['data']);
        } else {
            $controller = new BasicViewController();
            return $controller->Render('');
        }

    }

    private function GetRequestData() {
        switch($this->request['method']) {
            case "POST":
                    return $_POST;
                break;
            default:
                $rawData = explode("?", str_replace($this->config['prefix'], "", filter_var($_SERVER['REQUEST_URI'])));
                $data = [];

                if(isset($rawData[1])) {
                    if($rawData[1] != '') {
                        foreach(explode("&", $rawData[1]) as $item) {
                            $item = explode("=", $item);
                            $data[$item[0]] = $item[1];
                        }

                        return $data;
                    } else {
                        return [];
                    }
                }
                break;
        }
    }
}