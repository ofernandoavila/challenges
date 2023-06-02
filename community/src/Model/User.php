<?php

namespace ofernandoavila\Community\Model;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\GeneratedValue;
use Doctrine\ORM\Mapping\HasLifecycleCallbacks;
use Doctrine\ORM\Mapping\Id;
use Doctrine\ORM\Mapping\InverseJoinColumn;
use Doctrine\ORM\Mapping\JoinColumn;
use Doctrine\ORM\Mapping\JoinTable;
use Doctrine\ORM\Mapping\ManyToMany;
use Doctrine\ORM\Mapping\OneToMany;
use Doctrine\ORM\Mapping\PrePersist;
use ofernandoavila\Community\Controller\UserController;
use ofernandoavila\Community\Core\FileManager;
use ofernandoavila\Community\Core\Model;
use ofernandoavila\Community\Repository\UserRepository;

#[Entity, HasLifecycleCallbacks]
class User extends Model {

    #[Column, GeneratedValue, Id]
    public int $id;

    #[Column]
    public string $username;

    #[Column]
    private string $password;
    
    #[Column]
    public string $name;

    #[Column]
    public string $email;

    #[Column]
    public string $userHash;

    public ?string $profileImage;

    #[OneToMany(targetEntity: Project::class, mappedBy: 'owner', fetch: 'EAGER')]
    public $projects;

    #[ManyToMany(targetEntity: Project::class, inversedBy: 'userLikes')]
    public $likes;

    #[ManyToMany(targetEntity: User::class, inversedBy: "followers")]
    #[JoinTable(name: "user_follows")]
    #[JoinColumn(name: "user_id", referencedColumnName: "id")]
    #[InverseJoinColumn(name: "follower_id", referencedColumnName: "id")]
    private $followings;

    #[ManyToMany(targetEntity: User::class, mappedBy: "followings")]
    private $followers;

    public bool $currentUserFollow;
    
    public function __construct(string $user, string $password)
    {
        $this->username = $user;
        $this->password = $password;

        $this->projects = new ArrayCollection();
        $this->likes = new ArrayCollection();

        $this->followings = new ArrayCollection();
        $this->followers = new ArrayCollection();

        parent::__construct(new UserRepository());
    }

    #[PrePersist]
    public function setUserHash() {
        $this->userHash = sha1(uniqid(mt_rand(), true));
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

    public function IsFollowing(User $user) {
        $followings = $this->GetFollowings();

        return $followings->contains($user);
    }

    /**
     * @return Collection|User[]
     */
    public function GetFollowings(): Collection
    {
        return $this->followings;
    }

    public function GetFollowingsCount(): int {
        return $this->followings->count();
    }

    public function AddFollowing(User $user): void
    {
        if (!$this->followings->contains($user)) {
            $this->followings[] = $user;
        }
    }

    public function RemoveFollowing(User $user): void
    {
        $this->followings->removeElement($user);
    }

    /**
     * @return Collection|User[]
     */
    public function GetFollowers(): Collection
    {
        return $this->followers;
    }

    public function GetFollowersCount(): int {
            return $this->followers->count();
        }

    public function AddFollower(User $user): void
    {
        if (!$this->followers->contains($user)) {
            $this->followers[] = $user;
        }
    }

    public function RemoveFollower(User $user): void
    {
        $this->followers->removeElement($user);
    }

    public function GetProfilePicture() {
        if(FileManager::CheckIfFileExists('/users/' . $this->userHash . '/media/profile_image.png')) {
            return '/users/'. $this->userHash. '/media/profile_image.png';
        } else {
            return '/assets/profile_image.png';
        }
    }
}