<?php

use ofernandoavila\Community\Helper\EntityManagerCreator;
use ofernandoavila\Community\Model\Project;
use ofernandoavila\Community\Model\User;

global $router;

$router->post('/likeProject', function ($data) {

    header('Content-Type: application/json');

    if(!isset($data['userId']) && !isset($data['projectHash'])) {
        throw new Exception('The following data is required');
    }

    $em = EntityManagerCreator::createEntityManager();

    /**
     * @var User $user
     */
    $user = $em->getRepository(User::class)->find($data['userId']);
    $project = $em->getRepository(Project::class)->findOneBy(['projectHash' => $data['projectHash']]);

    $out = [];

    if(!$user->likes->contains($project)) {
        $user->AddLike($project);
        $out['like'] = true;
    } else {
        $user->RemoveLike($project);
        $out['like'] = false;
    }

    $em->flush();

    header('Content-Type: application/json');
    echo json_encode($out);
});