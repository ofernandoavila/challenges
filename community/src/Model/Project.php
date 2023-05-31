<?php

namespace ofernandoavila\Community\Model;

use DateTime;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\GeneratedValue;
use Doctrine\ORM\Mapping\HasLifecycleCallbacks;
use Doctrine\ORM\Mapping\Id;
use Doctrine\ORM\Mapping\ManyToMany;
use Doctrine\ORM\Mapping\ManyToOne;
use Doctrine\ORM\Mapping\PrePersist;

#[Entity, HasLifecycleCallbacks]
class Project
{
    #[Column, GeneratedValue, Id]
    public int $id;
    #[ManyToOne(targetEntity: User::class, inversedBy: 'projects')]
    public User $owner;
    #[Column]
    public string $name;
    #[Column]
    public string $description;
    #[Column]
    public string $filePath;
    #[Column]
    public bool $isPublic;
    #[Column]
    public string $projectHash;
    #[Column(type: 'datetime')]
    public $uploadDate;
    #[Column(nullable: true)]
    public string $iconPath;
    #[Column(nullable: true)]
    public float $rating;
    #[ManyToMany(targetEntity: User::class, mappedBy: 'likes')]
    public $userLikes;

    public function __construct() {
        $this->userLikes = new ArrayCollection();
    }

    public function AddLike(User $user) {
        if(!$this->userLikes->contains($user)) {
            $this->userLikes[] = $user;
            $user->AddLike($this);
        }
    }

    public function GetTotalLikes() {
        return $this->userLikes->count();
    }

    public function RemoveLike(User $user) {
        if($this->userLikes->contains($user)) {
            $this->userLikes->removeElement($user);
            $user->RemoveLike($this);
        }
    }

    public function CheckLike(User $user) {
        if($this->userLikes->contains($user)) {
            return true;
        } else {
            return false;
        }
    }

    public function setOwner(User $user) {
        $this->owner = $user;
    }

    #[PrePersist]
    public function setCreationDate() {
        $this->uploadDate = new DateTime();
    }

    #[PrePersist]
    public function setProjectHash() {
        $this->projectHash = sha1(uniqid(mt_rand(), true));
    }

    public function IsOwner(User $user) {
        if($this->owner->id == $user->id) {
            return true;
        } else return false;
    }

    public function GetUploadDate() {
        return $this-> uploadDate->format('m/d/Y H:i:s');
    }

    public function GetUsersLiked():ArrayCollection {
        return new ArrayCollection($this->userLikes->toArray());
    }
}