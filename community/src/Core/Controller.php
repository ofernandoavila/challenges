<?php

namespace ofernandoavila\Community\Core;

class Controller {

    protected Repository $repository;
    protected array $config;

    public function __construct(Repository $repo)
    {
        $this->repository = $repo;
        $this->config = Config::GetConfigs();
    }

    public function Render($path, $dataTransfer = [])
    {
        global $data;

        $data = $dataTransfer;

        $filePath = $this->config['template_dir'] . $path . '.php';

        if (file_exists($filePath)) {
            require_once $filePath;
        } else {
            require_once $this->config['template_dir'] . '404.php';
        }
    }
}