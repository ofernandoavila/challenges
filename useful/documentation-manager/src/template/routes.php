<?php

use ofernandoavila\challenges\core\XMLFactory;

use function ofernandoavila\challenges\helpers\GetFile;

global $routes;

$routes->AddRoute('string-manager-refference', function () {
    $teste = XMLFactory::GetXMLFile(USEFUL_LIB_PATH . '/notifications/documentation/documentation.xml');

    $data['slug'] = "string-manager-refference";
    $data['page_title'] = $teste->title;
    $data['description'] = $teste->description;
    $data['documentation_list'] = $teste->itens;
    $data['meta_description'] = $teste->title . " documentation page builded by ofernandoavila access https://github.com/ofernandoavila/challenges";

    GetFile('/refference_template', $data);
});

$routes->AddRoute('forms-refference', function () {
    $teste = XMLFactory::GetXMLFile(USEFUL_LIB_PATH . '/forms/documentation/documentation.xml');

    $data['slug'] = "forms-refference";
    $data['page_title'] = $teste->title;
    $data['description'] = $teste->description;
    $data['documentation_list'] = $teste->itens;
    $data['meta_description'] = $teste->title . " documentation page builded by ofernandoavila access https://github.com/ofernandoavila/challenges";

    GetFile('/refference_template', $data);
});
