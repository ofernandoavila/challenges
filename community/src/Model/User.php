<?php

namespace ofernandoavila\Community\Model;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\DBAL\Types\ArrayType;
use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\GeneratedValue;
use Doctrine\ORM\Mapping\Id;
use Doctrine\ORM\Mapping\ManyToMany;
use Doctrine\ORM\Mapping\OneToMany;
use ofernandoavila\Community\Controller\UserController;
use ofernandoavila\Community\Core\Model;
use ofernandoavila\Community\Repository\UserRepository;

#[Entity]
class User extends Model {

    #[Column, GeneratedValue, Id]
    public int $id;

    #[Column]
    public string $username;

    #[Column]
    private string $password;
    
    #[Column]
    public string $name;

    #[OneToMany(targetEntity: Project::class, mappedBy: 'owner', fetch: 'EAGER')]
    public $projects;

    #[ManyToMany(targetEntity: Project::class, inversedBy: 'userLikes')]
    public $likes;
    
    public function __construct(string $user, string $password)
    {
        $this->username = $user;
        $this->password = $password;

        $this->projects = new ArrayCollection();
        $this->likes = new ArrayCollection();

        parent::__construct(new UserRepository());
    }

    public function AddLike(Project $project)
    {
        if (!$this->likes->contains($project)) {
            $this->likes[] = $project;
            $project->AddLike($this);
        }
    }

    public function TotalProjectsLikes():int {
        $out = 0;
        
        foreach($this->projects as $project) {
            $out += $project->GetTotalLikes();
        }

        return $out;
    }

    public function GetTotalFaves():int {
        return $this->likes->count();
    }

    public function RemoveLike(Project $project) {
        if($this->likes->contains($project)) {
            $this->likes->removeElement($project);
            $project->RemoveLike($this);
        }
    }

    public function SetPassword($password) {
        $this->password = $password;
    }

    public function GetPassword() {
        return $this->password;
    }

    public function AddProject(Project $project) {
        $this->projects[] = $project;
    }

    public static function Authenticate(User $user) {
        $userController = new UserController();

        $tmpUser = $userController->GetUserByUsername($user->username);

        if ($tmpUser != null) {
            if ($user->username == $tmpUser->username) {
                if (password_verify($user->GetPassword(), $tmpUser->GetPassword())) {
                    return true;
                } else {
                    $_SESSION['msg']['type'] = "warning";
                    $_SESSION['msg']['text'] = "Username/Password incorrect";
                    return false;
                }
            }
        } else {
            $_SESSION['msg']['type'] = "warning";
            $_SESSION['msg']['text'] = "Username/Password incorrect";
            return false;
        }
    }

    public function GetProjects() {
        return $this->projects;
    }
}