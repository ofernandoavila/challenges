<?php

namespace ofernandoavila\challenges\core;

use Exception;

use function ofernandoavila\challenges\helpers\Debug;

class XMLFactory
{
    public static function GetXMLFile($path)
    {
        if (file_exists($path)) {
            $xml = simplexml_load_file($path);
            return $xml;
        } else {
            throw new Exception("XML File not found! Path=(" . $path . ")");
        }
    }

    public static function ArrayToXML($array, $parentNodeName = 'root')
    {
        $xml = new \SimpleXMLElement('<' . $parentNodeName . '/>');
        self::ArrayToXMLElement($array, $xml);

        return $xml->asXML();
    }

    public static function ArrayToXMLElement($array, &$xml, $parent = '')
    {
        foreach ($array as $key => $value) {
            if (is_array($value)) {
                $subxml = $xml->addChild($key);
                Debug($parent, true);
                self::ArrayToXMLElement($value, $subxml, $key);
            } else {
                $xml->addChild($key, $value);
            }
        }
    }

    public static function DocumentationToXML($data) {
        $xml = new \SimpleXMLElement('<documentation/>');

        $xml->addChild('title', $data['title']);
        $xml->addChild('description', $data['description']);

        $itens = $xml->addChild('itens');

        foreach($data['itens'] as $item) {
            $itemNode = $itens->addChild('item');
            $itemNode->addChild('function', $item['function']);

            $params = $itemNode->addChild('params');

            if(sizeof($item['params']) > 0) {
                foreach($item['params'] as $param) {
                    $paramNode = $params->addChild('param');
                    $paramNode->addAttribute('type', $param['type']);
                    $paramNode->addAttribute('variable', $param['variable']);
                    $paramNode->addAttribute('description', $param['description']);
                }
            }

            $itemNode->addChild('signature', $item['signature']);
            $itemNode->addChild('description', $item['description']);
            $itemNode->addChild('return', $item['return']);
            $itemNode->addChild('title', $item['title']);
        }

        return $xml->asXML();
    }

    public static function ExportXML($data, $savePath)
    {
        return file_put_contents($savePath . '/documentation.xml', $data);
    }
}
