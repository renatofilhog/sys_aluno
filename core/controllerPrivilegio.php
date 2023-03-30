<?php

namespace core;

use \core\Controller;
use \core\Database;
use \src\models\Pessoa;

class controllerPrivilegio{
    private $role;

    public function __construct(int $id){
        $role = Pessoa::getRole($id);
    }

    public function pegarRole(){
        return $this->role;
    }
}

