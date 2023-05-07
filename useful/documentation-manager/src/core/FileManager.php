<?php

namespace ofernandoavila\challenges\core;

use Exception;

use function ofernandoavila\challenges\helpers\Debug;
use function ofernandoavila\challenges\helpers\GetContentBetweenDelimiters;
use function ofernandoavila\challenges\helpers\GetStringFirstWord;
use function ofernandoavila\challenges\helpers\RemoveFromString;

class FileManager {
    public static function GetContentAsString($path, $useBuffer = false, $data = array()) {
        if(file_exists($path)) {
            if(!$useBuffer) return file_get_contents($path);
            else {
                extract($data);
                ob_start();
                $php = file_get_contents($path);

                eval('?>'.$php);

                $html = ob_get_contents();
                ob_end_clean();
                return $html;
            }
        } else throw new Exception("File not found! File=(". $path .")");
    }

    public static function ExportToHTML($path, $data) {
        return file_put_contents($path . '.html', $data);
    }

    public static function GetJSON($path) {
        $json = json_decode(self::GetContentAsString($path), true);
        
        return $json;
    }

    public static function GetAllModulesToImport() {
        $modules = json_decode(self::GetContentAsString(DOCUMENTATION_MANAGER_SRC_PATH . '/Modules.json'), true);
        
        return $modules;
    }

    public static function GetModuleDocument($module) {
        $result = self::CreateDocumentation(
            $module['name'],
            $module['description'],
            USEFUL_LIB_PATH . '/' . $module['path'] . '/' . $module['file'] . '.js',
            USEFUL_LIB_PATH . '/' . $module['path'] . '/documentation'
        );

        if($result !== false) return true;
        else false;
    }
    
    public static function CreateDocumentation($title, $description, $path, $pathOut) {
        $file = self::GetContentAsString($path);
        
        $documentation['title'] = $title;
        $documentation['description'] = $description;
        $documentation['itens'] = self::GetDocumentationData($file);
        
        $xml = XMLFactory::DocumentationToXML($documentation);
        
        $xml = str_replace("&&", "&amp;", $xml);
        $xml = str_replace(" &", "&amp;", $xml);
        return XMLFactory::ExportXML($xml, $pathOut);
    }
    
    public static function GetDocumentationData($rawData) {
        $itens = [];
        $data = explode("/**", $rawData);
    
        $data = array_filter($data, function($array) {
            return !empty($array);
        });   
        
        foreach($data as $line) {
            $item['item'] = self::ReturnDocumentationItem($line);
            //$item['id'] = sizeof($itens) + 1;
            array_push($itens, $item['item']);
        }
    
        $itens = array_filter($itens, function($array) {
            return !empty($array);
        }); 
    
        return $itens;
    }
    
    public static function ReturnDocumentationItem($line) {
        $tmpItem = explode("\n", GetContentBetweenDelimiters($line, "*", ") {"));
            $docc = GetContentBetweenDelimiters($line, "*", "*/") . "*/\r";
    
            
            $item['function'] = trim(RemoveFromString(RemoveFromString($line, $docc), " *"));
            $item['functionSignature'] = "";
            $item['params'] = [];
            foreach($tmpItem as $key => $subitem) {
                if(strpos($subitem, " *")) {
                    $subitem = GetContentBetweenDelimiters($subitem, " *", "\r");
                }
    
                if($subitem == null) return;
    
                $subitem = trim($subitem);
    
                $type = "";
                $variable = "";
                $item['signature'] = "";
    
                if(strpos($subitem, "@param")) {
                    $subitem = RemoveFromString($subitem, "@param ");
                    $subitem = RemoveFromString($subitem, "* ");
                    
                    $type = GetContentBetweenDelimiters($subitem, "{", "}");
    
                    $subitem = RemoveFromString($subitem, "{" . $type .  "} ");
                    
                    $variable = GetStringFirstWord($subitem);
    
    
                    $subitem = RemoveFromString($subitem, $variable . " ");
    
                    $description = $subitem;
                    
                    $param['type'] = $type;
                    $param['variable'] = $variable;
                    $param['description'] = $description;
                    
                    $item['params'][] = $param;
                } else if(strpos($subitem, "@returns")) { 
                    $item['return'] = $subitem;
                } else if(strpos($subitem, "@description ") !== false) { 
                    $subitem = RemoveFromString($subitem, "@description");
                    $item['description'] = trim($subitem);
                } else {
                    if ($subitem != "/") {
                        if ($key + 1 == sizeof($tmpItem)) {
                            $item['signature'] .= $subitem . ")";
                        } else $item['signature'] .= $subitem;
                    }
                }
            } 
            
            if(!isset($item['return'])) {
                $item['return'] = '';
            } else {
                $item['return'] = RemoveFromString($item['return'], "* ");
            }

            $item['signature'] = RemoveFromString($item['signature'], "*/");
            $item['title'] = GetContentBetweenDelimiters($item['signature'], "function ", "(");
            
           return $item;
    }
}