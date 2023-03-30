<?php

namespace src\handlers;

use core\Database;
use src\models\Pessoa;

class pessoaHandler {

    public static function inserePessoa(string $role){
        $arrInfos = [
            'nome'=>filter_input(INPUT_POST,'nome',FILTER_SANITIZE_ADD_SLASHES),
            'email'=>filter_input(INPUT_POST,'email',FILTER_VALIDATE_EMAIL),
            'senha'=>md5(filter_input(INPUT_POST,'senha',FILTER_SANITIZE_ADD_SLASHES)),
            'role'=>$role
        ];
        $lastId = Pessoa::inserePessoa($arrInfos);
        if(!$lastId){
            $_SESSION['errorMsg'] = "Cadastro duplicado";
            return false;
        }
        return $lastId;
    }
}