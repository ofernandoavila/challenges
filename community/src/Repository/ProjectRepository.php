<?php

namespace ofernandoavila\Community\Repository;

use ofernandoavila\Community\Core\Repository;
use ofernandoavila\Community\Helper\EntityManagerCreator;
use ofernandoavila\Community\Model\Project;
use ofernandoavila\Community\Model\User;

class ProjectRepository extends Repository {
    public function __construct() {
        parent::__construct(Project::class);
    }

    public function CheckIfUserLikes(int $userId, int $projectId):bool {
        $em = EntityManagerCreator::createEntityManager();
        $user = $em->getRepository(User::class)->find($userId);
        $project = $em->getRepository(Project::class)->find($projectId);
        
        return $project->CheckLike($user);
    }
}