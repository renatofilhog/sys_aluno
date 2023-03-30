<?php
namespace src\controllers;

use \core\Controller;
use \src\handlers\loginHandler;
use src\Config;


class HomeController extends Controller {

    public function index() {
        $user = new loginHandler();
        if (isset($_SESSION['loginInfos'])){
            $user->setUsuario($_SESSION['loginInfos']['user']);
            $user->setLogado();
        }
        if($user->getLogado() == 0){
            header("Location: ".Config::BASE_DIR."\login");
            exit();
        }
        $this->render('home', ['nome' => $_SESSION['loginInfos']['user']['nome'], 'nomeTela'=>"Tela Inicial"]);
    }

    public function sobre() {
        $this->render('sobre');
    }

    public function sobreP($args) {
        print_r($args);
    }

}