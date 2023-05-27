<?php

namespace ofernandoavila\Community\Model;

use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\GeneratedValue;
use Doctrine\ORM\Mapping\Id;
use Doctrine\ORM\Mapping\ManyToOne;

#[Entity]
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

    #[Column(nullable: true)]
    public string $iconPath;

    #[Column(nullable: true)]
    public float $rating;

    public function setOwner(User $user) {
        $this->owner = $user;
    }
}