<?php

namespace ofernandoavila\Community\Core;

use ofernandoavila\Community\Controller\SessionController;

class Core {
    public Array $request;
    private Array $config;

    public function __construct(string $mode = '') {
        $this->config = Config::GetConfigs($mode);
        $this->request['data'] = [];

        $this->request['config'] = $this->config;
        $this->ConfigureRequest();
        if(!$this->request['isJson']) $this->GetLoggedUserData();
    }

    private function GetLoggedUserData() {
        if(isset($_SESSION['user_session'])) {
            $sessionController = new SessionController();
            $session = $sessionController->GetSessionByHash($_SESSION['user_session']);
            
            if($session != null) $this->request['data']['session'] = $session;
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

        
        $apacheHeaders = apache_request_headers();
        
        if(isset($apacheHeaders['Content-Type']) && $apacheHeaders['Content-Type'] == "application/json") {
            $this->request['isJson'] = true;
        } else {
            $this->request['isJson'] = false;
        }
        
        $this->request['data'] = $this->GetRequestData();
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
        if($this->request['isJson']) {
            header('Content-Type: application/json');
        }

        if(isset($this->request['route'])) {
            $this->request['data']['config'] = $this->config;

            return $this->request['route']['function']($this->request['data']);
        } else {
            $controller = new BasicViewController();
            return $controller->Render('');
        }

    }

    private function GetRequestData() {
        switch($this->request['method']) {
            case "POST":
                $out = [];
                if($this->request['isJson'] && file_get_contents('php://input') != null) {
                    $out = json_decode( file_get_contents('php://input'), true );
                    return $out;
                }

                if(sizeof($_FILES) > 0) {
                    foreach($_FILES as $key => $value) {
                        $out[$key] = $value;
                    }
                }

                if(sizeof($_POST) > 0) {
                    foreach($_POST as $key => $value) {
                        $out[$key] = $value;
                    }
                }

                return $out;
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