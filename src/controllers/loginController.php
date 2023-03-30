<?php

namespace src\controllers;

use \core\Controller;
use \src\handlers\loginHandler;
use src\Config;

class loginController extends Controller
{
    public function login(){
        $user = new loginHandler();
        if (isset($_SESSION['loginInfos'])){
            $user->setUsuario($_SESSION['loginInfos']['user']);
            $user->setLogado();
        }
        if($user->getLogado() == 1){
            header("Location: ".Config::BASE_DIR."/");
            exit();
        }
        $this->renderIndependente('login');
    }

    public function validaLogin(){
        $emailRecebido = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
        $senhaRecebida = filter_input(INPUT_POST,'senha', FILTER_SANITIZE_ADD_SLASHES);
        $novoLogin = new loginHandler();
        $result = $novoLogin->processaLogin($emailRecebido, $senhaRecebida);

        if ($result['logado'] == 1){
            $_SESSION['loginInfos'] = $result;
            header("Location: ".Config::BASE_DIR."/");
            exit();
        }
    }

    public function logout(){
        $user = new loginHandler();
        if (isset($_SESSION['loginInfos'])){
            $user->setUsuario($_SESSION['loginInfos']['user']);
            $user->setLogado();
        }
        if($user->getLogado() == 1){
            unset($_SESSION['loginInfos']);
        }
            header("Location: ".Config::BASE_DIR."\login");
            exit();
        $this->render('home', ['nome' => $_SESSION['loginInfos']['user']['nome']]);


    }


}