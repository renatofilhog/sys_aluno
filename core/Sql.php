<?php

namespace core;

use core\Database;
class Sql
{
    protected $conn;

    public function __construct(){
        $this->conn = Database::getInstance();
        return $this->conn;
    }

    public function select(){

    }

    public function update(){

    }

    public function insert(){

    }

    public function delete(){

    }

}