<?php

namespace ofernandoavila\Community\Core;

class Model
{
    public Repository $repo;

    public function __construct(Repository $repo)
    {
        $this->repo = $repo;
    }
}