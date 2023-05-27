<?php

namespace ofernandoavila\Community\Core;

class Controller {

    protected Repository $repository;

    public function __construct(Repository $repo)
    {
        $this->repository = $repo;
    }
}