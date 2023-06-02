<?php

namespace ofernandoavila\Community\Controller;

#region imports
use Exception;
use ofernandoavila\Community\Core\Controller;
use ofernandoavila\Community\Core\FileManager;
use ofernandoavila\Community\Model\File;
use ofernandoavila\Community\Model\User;
use ofernandoavila\Community\Repository\ProjectRepository;
use ofernandoavila\Community\Repository\SessionRepository;
use ofernandoavila\Community\Repository\UserRepository;
#endregion

class UserController extends Controller {
    public function __construct() {
        parent::__construct(new UserRepository());
    }

    #region Save User
    public function SaveUser(string $name, string $username, string $email, string $password, string $profileImage = '') {
        try {
            $repo = new UserRepository();

            $user = new User($username, password_hash($password, PASSWORD_ARGON2I));
            $user->name = $name;
            $user->email = $email;

            if($profileImage != '') {
                $user->profileImage = $profileImage;
            }
            
            if($repo->save($user)) {
                $_SESSION['msg']['type'] = "success";
                $_SESSION['msg']['text'] = "Success creating account";
                return true;
            } else {
                return false;
            }
        } catch (\Exception $e) {
            throw $e;
        }
    }
    #endregion

    #region Delete User
    public function DeleteUser(User $user)
    {
        $repo = new UserRepository();

        /**
         * @var User $user
         */
        $user = $repo->get($user->id);

        if($user->GetProjects()->count() > 0) {
            foreach($user->GetProjects() as $project) {
                $projectRepo = new ProjectRepository();
                $projectRepo->remove($project);
            }
        }

        $sessionController = new SessionController();
        $sessionController->DeleteSessionsByUser($user);
        SessionController::ClearSession();

        if ($repo->remove($user)) {
            $_SESSION['msg']['type'] = "success";
            $_SESSION['msg']['text'] = "Your account was deleted! We're gonna miss you...";
            return true;
        } else {
            return false;
        }
    }
    #endregion

    #region Follow
    public function Follow(User $user, User $target):bool {
        return $this->repository->follow($user->id, $target->id);
    }
    #endregion

    #region IsFollowing
    public function IsFollowing(User $user, User $target):bool {
        return $this->repository->isFollowing($user->id, $target->id);
    }
    #endregion

    #region Get User functions
    public function GetUserByID(int $id)
    {
        $repo = new UserRepository();
        $user = $repo->get($id);

        return $user;
    }

    public function GetUserBySessionHash(string $hash)
    {
        $sessionRepo = new SessionRepository();

        $session = $sessionRepo->repository->findBy(['hash' => $hash]);
        if ($session) {
            return $this->GetUserByID($session[0]->user_id);
        } else {
            return null;
        }
    }

    public function GetUserByUsername(string $username)
    {
        $userRepo = new UserRepository();

        $user = $userRepo->repository->findBy(['username' => $username]);
        if ($user) {
            return $this->GetUserByID($user[0]->id);
        } else {
            return null;
        }
    }

    public function GetUserByHash(string $hash)
    {
        $userRepo = new UserRepository();

        $user = $userRepo->repository->findBy(['userHash' => $hash]);
        if ($user) {
            return $this->GetUserByID($user[0]->id);
        } else {
            return null;
        }
    }

    #endregion

    #region Check if user exists
    /**
     * Check if the given user exists.
     * @var User $user user to be checked
     * @return bool true if the user exists, false otherwise
     */
    public function CheckIfUserExist(User $user):bool {
        $repo = new UserRepository();

        $user = $repo->repository->findBy(['username' => $user->username]);
        return $user != null ? true : false;
    }
    #endregion

    #region Create User Directory Structure
    /**
     * Create the directory structure for user
     * @param string $userHash current user hash
     * @return boolean true if successful, false otherwise
     */
    public function CreateDirectoryStructure(string $userHash):bool {
        try {
            FileManager::CreateDirectory('users/' . $userHash);
            FileManager::CreateDirectory('users/' . $userHash . '/media');
            FileManager::CreateDirectory('users/' . $userHash . '/saves');

            return true;
        } catch (Exception $e) {
            throw $e;
        }    
    }
    #endregion

    #region Check if user has profile picture
    /**
     * Check if user has profile picture
     * @param string $userHash User hash
     * @return boolean
     */
    public function CheckProfilePicture(string $userHash):bool {
        return FileManager::CheckIfFileExists('/users/' . $userHash . '/media/profile_image.png');
    }

    #endregion

    public function UpdateProfileImage(User $user, File $profileImage) {
        global $configs;

        $to = $configs['storage_dir'] . '/users/' . $user->userHash . '/media/profile_image.' . $profileImage->GetFileType();

        if(FileManager::UpdateFile($profileImage, $to)) {
            return true;
        } else {
            return false;
        }
    }

    public function GetUsersStorageUrl() {
        global $configs;
        return $configs['storage_url'] . '/users';
    }
}