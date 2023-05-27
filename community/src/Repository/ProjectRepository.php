<?php

namespace ofernandoavila\Community\Repository;

use ofernandoavila\Community\Core\Repository;
use ofernandoavila\Community\Model\Project;

class ProjectRepository extends Repository {
    public function __construct() {
        parent::__construct(Project::class);
    }
}