<?php

namespace ofernandoavila\challenges\helpers;

use Exception;

function Debug($content, $console = false) {
    if(!$console) {
        echo '<pre>';
        var_dump($content);
        echo '</pre>';
    } else var_dump($content);
}

function DebugMessage($message, $console = false) {
    if(!$console) {
        echo '<pre>';
        echo $message . "\n";
        echo '</pre>';
    } else echo $message . "\n";
}

function GetHeader($data = array()) {
    extract($data);
    require DOCUMENTATION_MANAGER_TEMPLATE_PATH . '/common/header.php';
}

function GetFooter($data = array()) {
    extract($data);
    require DOCUMENTATION_MANAGER_TEMPLATE_PATH . '/common/footer.php';
}

function GetFile($path, $data = []) {
    if(file_exists(DOCUMENTATION_MANAGER_TEMPLATE_PATH . $path . '.php')) {
        require DOCUMENTATION_MANAGER_TEMPLATE_PATH . $path . '.php';
    } else throw new Exception("File not found! Path=(" . DOCUMENTATION_MANAGER_TEMPLATE_PATH . $path . '.php'. ")");
}

function GetContentBetweenDelimiters($string, $delimiterInitial, $delimiterFinal) {
    $initialPosition = strpos($string, $delimiterInitial);
    if ($initialPosition === false) {
        return "";
    }
    $initialPosition += strlen($delimiterInitial);
    $finalPosition = strpos($string, $delimiterFinal, $initialPosition);
    if ($finalPosition === false) {
        return "";
    }
    $tamanho = $finalPosition - $initialPosition;
    return substr($string, $initialPosition, $tamanho);
}

function RemoveFromString($string, $toBeRemove) {
    return str_replace($toBeRemove, "", $string);
}

function GetStringFirstWord($string) {
    $words = explode(' ', $string);
    return $words[0];
}