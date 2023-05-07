<?php

namespace ofernandoavila\challenges\core;

use function ofernandoavila\challenges\helpers\Debug;

class Core {

    public static function Init() {
        global $routes;

        if(isset($_GET["page"])) {
            foreach( $routes->routes as $route ) {
                if($route['path'] == $_GET["page"]) {
                    return $route['function']();
                }
            }
        }
    }
}