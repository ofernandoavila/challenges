<?php

namespace ofernandoavila\Community\Controller\DisplayView;

use ofernandoavila\Community\Controller\ProjectController;
use ofernandoavila\Community\Controller\UserController;
use ofernandoavila\Community\Core\Controller;
use ofernandoavila\Community\Interfaces\IDisplayView;
use ofernandoavila\Community\Repository\UserRepository;

class ProfileDisplayViewController extends Controller implements IDisplayView {
    public function __construct()
    {
        parent::__construct(new UserRepository());
    }

    public function BasicContext($data = []) {
        $userController = new UserController();
        $project = new ProjectController();

        $data['profile_user'] = $userController->GetUserByUsername($data['username']);

        $data['profile_menu'] = [
            'projects' => [
                'label' => 'Projects',
                'url' => $data['config']['base_url'] . '/profile?username=' . $data['profile_user']->username,
                'selected' => false
            ],

            'followers' => [
                'label' => 'Followers',
                'url' => $data['config']['base_url'] . '/profile/followers?username=' . $data['profile_user']->username,
                'selected' => false
            ],

            'followings' => [
                'label' => 'Followings',
                'url' => $data['config']['base_url'] . '/profile/followings?username=' . $data['profile_user']->username,
                'selected' => false
            ]
        ];

        if(isset($data['user'])) {
            $currentUser = $userController->GetUserByID($data['user']->id);

            foreach($data['profile_user']->GetFollowers() as $follower) {
                $follower->currentUserFollow = $userController->IsFollowing($currentUser, $follower);
            }

            foreach($data['profile_user']->GetFollowings() as $follower) {
                $follower->currentUserFollow = $userController->IsFollowing($currentUser, $follower);
            }
            
            $data['isFollowing'] = $userController->IsFollowing($currentUser, $data['profile_user']);
        } else {
            $data['isFollowing'] = false;
        }

        if($data['profile_user'] != null) $data['projects'] = $project->GetProjectsByUser($data['profile_user']);

        return $data;
    }

    public function ProfilePage($data = []) {
        $data = $this->BasicContext($data);

        $data['profile_menu']['projects']['selected'] = true;
               
        return $this->render('profile/ProfilePage', $data);
    }

    public function ProfileFollowersPage($data = []) {
        $data = $this->BasicContext($data);

        $data['profile_menu']['followers']['selected'] = true;

        return $this->render('profile/ProfileFollowersPage', $data);
    }

    public function ProfileFollowingsPage($data = []) {
        $data = $this->BasicContext($data);

        $data['profile_menu']['followings']['selected'] = true;

        return $this->render('profile/ProfileFollowingsPage', $data);
    }
}