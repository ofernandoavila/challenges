<?php

namespace ofernandoavila\Community\Core;

use Doctrine\Common\Collections\ArrayCollection;
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
        global $em;
        
        $this->entityManager = $em;
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
            throw $error;
        }
    }

    public function getCollectionBy(string $property, mixed $value) {
        return $this->repository->findBy([$property => $value]);
    }

    public function getBy(string $property, mixed $value) {
        return $this->repository->findOneBy([$property => $value]);
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
        throw new \Exception("Este método deve ser sobrescrito!", 1);
    }

    public function removeCollection($collection) {
        try {
            foreach ($collection as $item) {
                $item = $this->entityManager->find(get_class($item), $item->id);

                $this->entityManager->remove($item);
            }

            return $this->entityManager->flush();
        } catch (\Exception $e) {
            throw $e;
        }
    }

    public function remove(object $obj) {
        try {
            $obj = $this->entityManager->find(get_class($obj), $obj->id);

            $this->entityManager->remove($obj);
            $this->entityManager->flush();

            return true;
        } catch(Exception $error) {
            throw $error;
        }
    }
}