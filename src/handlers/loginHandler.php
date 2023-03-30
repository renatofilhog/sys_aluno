<?php

namespace src\handlers;

use core\Database;
use src\models\Pessoa;

class loginHandler {
    private $usuario;
    private $token;
    private $logado = 0;

    public function processaLogin(string $email, string $senha){
        $p = new Pessoa();
        $this->usuario = $p->verificaLogin($email, $senha);
        if($this->usuario != null) {
            $this->setLogado($this->usuario);
            return ["user"=>$this->usuario,"logado"=>$this->logado];
        } else {
            return null;
        }
    }

    public function setLogado(){
        if($this->logado == 0){
            $this->logado = 1;
        } else {
            $this->logado = 0;
        }
    }

    public function getLogado(){
        return $this->logado;
    }

    public function getUsuario(){
        return $this->usuario;
    }

    public function setUsuario($user) {
        $this->usuario = $user;
    }

    public static function verificaPermissao(String $role){
        if ($_SESSION['loginInfos']['user']['role'] != $role){
            header("Location: /");
            exit();
        }
    }

    //Implementar
    public static function verificaLogin(){
        if (isset($_SESSION['loginInfos'])){
            self::setUsuario($_SESSION['loginInfos']['user']);
            self::setLogado();
        }
        if(self::getLogado() == 0){
            header("Location: ".Config::BASE_DIR."\login");
            exit();
        }
    }

}