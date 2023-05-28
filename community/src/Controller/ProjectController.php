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

    public function DeleteProject(Project $project) {
        return $this->repository->remove($project);
    }

    public function GetProjectByHash(string $hash) {
        return $this->repository->getBy('projectHash', $hash);
    }

    public function GetProjects() {
        return $this->repository->getCollectionBy('isPublic', true);
    }

    public function RenderProject($data) {
        $data['project'] = $this->GetProjectByHash($data['id']);

        if($data['project'] == null) {
            $_SESSION['msg']['type'] = 'warning';
            $_SESSION['msg']['text'] = 'Project not found!';

            return Redirect('/projects');
        }

        return $this->Render('project/ViewProject', $data);
    }

    public function RenderProjects($data)
    {
        $data['projects'] = $this->GetProjects();

        return $this->Render('project/ProjectPage', $data);
    }
}