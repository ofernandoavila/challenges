<?php

namespace ofernandoavila\Community\Core;

class Core {
    public Array $request;
    private Array $config;

    public function __construct() {
        $this->config = require_once __DIR__ . '/../config/config.php';
        $this->ConfigureRequest();
    }

    private function ConfigureRequest() {
        $requestData = str_replace($this->config['prefix'], "", filter_var($_SERVER['REQUEST_URI'], FILTER_SANITIZE_URL));
        $url = explode("?", $requestData)[0];
        
        var_dump($_SERVER);
        die;

        $this->request = array(
            'url' => $url,
            'method' => $_SERVER['REQUEST_METHOD']
        );

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

        if(isset($this->request['route'])) {
            return $this->request['route']['function']();
        } else {
            $controller = new BasicController();
            return $controller->Render('');
        }

    }

    private function GetRequestData() {
        switch($this->request['method']) {
            case "POST":
                break;
            default:
                $rawData = explode("?", str_replace($this->config['prefix'], "", filter_var($_SERVER['REQUEST_URI'])));

                if(isset($rawData[1])) {
                    if($rawData[1] != '') {
                        foreach(explode("&", $rawData[1]) as $item) {
                            $item = explode("=", $item);
                            $data[$item[0]] = $item[1];
                        }
                    } else {
                        return [];
                    }
                }
                break;
        }
    }
}