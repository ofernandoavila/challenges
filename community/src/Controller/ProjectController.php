<?php

namespace ofernandoavila\Community\Controller;
use ofernandoavila\Community\Core\Controller;
use ofernandoavila\Community\Model\Project;
use ofernandoavila\Community\Model\User;
use ofernandoavila\Community\Repository\ProjectRepository;

class ProjectController extends Controller {
    public function __construct()
    {
        parent::__construct(new ProjectRepository());
    }

    public function GetProjectById(int $id) {
        return $this->repository->get($id);
    }

    public function AddProject(Project $project) {
        return $this->repository->save($project);
    }

    public function DeleteAllUserProjects(User $user) {
        return $this->repository->removeCollection($user->GetProjects());
    }
}