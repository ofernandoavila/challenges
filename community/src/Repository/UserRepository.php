<?php

namespace ofernandoavila\Community\Repository;

use ofernandoavila\Community\Core\Repository;
use ofernandoavila\Community\Model\User;

class UserRepository extends Repository {
    public function __construct()
    {
        parent::__construct(User::class);
    }
}