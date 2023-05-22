<?php

namespace ofernandoavila\Community\Repository;

use ofernandoavila\Community\Core\Repository;
use ofernandoavila\Community\Model\Session;
use ofernandoavila\Community\Model\User;

class SessionRepository extends Repository
{
    public function __construct()
    {
        parent::__construct(Session::class);
    }
}
