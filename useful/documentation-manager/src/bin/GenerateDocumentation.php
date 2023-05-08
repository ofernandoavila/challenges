<?php

use ofernandoavila\challenges\core\FileManager;
use ofernandoavila\challenges\core\XMLFactory;

use function ofernandoavila\challenges\helpers\Debug;
use function ofernandoavila\challenges\helpers\DebugMessage;

require_once '../config.php';
require_once '../helpers/helpers.php';
require DOCUMENTATION_MANAGER_PATH . '/vendor/autoload.php';

$documentation = FileManager::GetJSON(DOCUMENTATION_MANAGER_SRC_PATH . '/Documentation.json');
$modules = FileManager::GetJSON(DOCUMENTATION_MANAGER_SRC_PATH . '/Modules.json');

$data = $documentation;
$data['modules'] = $modules;
$data['settings_build_date'] = date("m/d/Y H:i:s");

foreach($modules as $module) {
    DebugMessage("Generating module '" . $module['name'] . "' ...", true);
    DebugMessage(FileManager::GetModuleDocument($module) ? "Done!\n" : "Error\n", true);
}

DebugMessage("Generating home.html file", true);
$data['settings_root_path'] = '..';
$data['settings_css_path'] = '../useful/lib/style';
$data['settings_js_path'] = '../useful';
GenerateHomeHTML($data);

function GenerateHomeHTML($data) {
    $html = FileManager::GetContentAsString(DOCUMENTATION_MANAGER_TEMPLATE_PATH . '/pages/home.php', true, $data);
    DebugMessage(FileManager::ExportToHTML(ROOT_DOCUMENTATION_DIR_PATH . "/index", $html) !== false ? "Created!" : "Error\n", true);
}

foreach($modules as $module) {
    DebugMessage("Generating refference.html for '" . $module['name'] . "' ...", true);

    $xml = XMLFactory::GetXMLFile(USEFUL_LIB_PATH . '/' . $module['path'] . '/documentation/documentation.xml');

    $data['slug'] = $module['slug'];
    $data['page_title'] = $xml->title;
    $data['description'] = $xml->description;
    $data['documentation_list'] = $xml->itens;
    $data['meta_description'] = $xml->title . " documentation page builded by ofernandoavila access https://github.com/ofernandoavila/challenges";

    $data['settings_root_path'] = ROOT_ROOT_PATH;
    $data['settings_css_path'] = ROOT_CSS_LIB_PATH;
    $data['settings_js_path'] = ROOT_JS_LIB_PATH;
    $data['module'] = $module;

    GenerateRefferenceHTML($data, $module);
    GenerateMainHTML($data, $module);
}

function GenerateRefferenceHTML($data, $module) {
    $html = FileManager::GetContentAsString(DOCUMENTATION_MANAGER_TEMPLATE_PATH . '/pages/refference_template.php', true, $data);
    DebugMessage(FileManager::ExportToHTML(USEFUL_LIB_PATH . '/' . $module['path'] . '/documentation' . "/refference", $html) !== false ? "Created!" : "Error\n", true);
}

function GenerateMainHTML($data, $module) {
    $html = FileManager::GetContentAsString(DOCUMENTATION_MANAGER_TEMPLATE_PATH . '/pages/main_docitem_page.php', true, $data);
    DebugMessage(FileManager::ExportToHTML(USEFUL_LIB_PATH . '/' . $module['path'] . '/documentation' . "/index", $html) !== false ? "Created!" : "Error\n", true);
}