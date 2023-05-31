<?php

namespace ofernandoavila\Community\Repository;

use ofernandoavila\Community\Core\Repository;
use ofernandoavila\Community\Helper\EntityManagerCreator;
use ofernandoavila\Community\Model\User;

class UserRepository extends Repository {
    public function __construct()
    {
        parent::__construct(User::class);
    }

    public function follow(int $user, int $target):bool {
        try {
            $em = EntityManagerCreator::createEntityManager();

            $user = $em->getRepository(User::class)->find($user);
            $target = $em->getRepository(User::class)->find($target);

            $isFollowingNow = false;

            if(!$user->IsFollowing($target)) {
                $user->AddFollowing($target);
                $target->AddFollower($user);
                $isFollowingNow = true;
            } else {
                $user->RemoveFollowing($target);
                $target->RemoveFollower($user);
            }

            $em->persist($user);
            $em->persist($target);
            $em->flush();

            return $isFollowingNow;
        } catch (\Exception $e) {
            throw $e;
        }
    }

    public function isFollowing(int $user, int $target):bool {
        $em = EntityManagerCreator::createEntityManager();
        $user = $em->getRepository(User::class)->find($user);
        $target = $em->getRepository(User::class)->find($target);
        
        return $user->IsFollowing($target);
    }
}