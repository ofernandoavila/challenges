<?php

namespace ofernandoavila\Community\Core;

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityRepository;
use Exception;
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
        try {
            $this->entityManager->persist($obj);
            $this->entityManager->flush();

            return true;
        } catch(Exception $error) {
            $_SESSION['msg']['type'] = "danger";
            $_SESSION['msg']['text'] = $error->getMessage();
            return false;
        }
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

    public function removeCollection(array $collection) {
        foreach($collection as $item) {
            $this->entityManager->remove($item);
        }

        return $this->entityManager->flush();
    }

    public function remove(object $obj) {
        try{
            $this->entityManager->remove($obj);
            $this->entityManager->flush();
            return true;
        } catch(Exception $error) {
            return $error;
        }
    }
}