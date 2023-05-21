<?php

namespace ofernandoavila\Community\Core;

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityRepository;
use ofernandoavila\Community\Helper\EntityManagerCreator;

class Repository
{
    public EntityRepository $repository;
    public ?EntityManager $entityManager = null;

    public function __construct(
        string $repositoryName
    ) {
        $this->entityManager = EntityManagerCreator::createEntityManager();
        $this->repository = $this->entityManager->getRepository($repositoryName);
    }

    public function save(object $obj)
    {
        $this->entityManager->persist($obj);
        $this->entityManager->flush();
    }

    public function get($id)
    {
        return $this->repository->find($id);
    }

    public function getAll()
    {
        return $this->repository->findAll();
    }

    public function update(object $obj)
    {
        return throw new \Exception("Este método deve ser sobrescrito!", 1);
    }
}