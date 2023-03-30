<?php

namespace src\controllers;

use \core\Controller;
use \src\handlers\loginHandler;
use src\Config;
use src\handlers\pessoaHandler;
use src\models\Materia;
use src\models\Professor;

class cadastroController extends Controller
{
    public function materiaView(){
        loginHandler::verificaPermissao('M'); #If false vai para HOME
        $this->renderIndependente('cadastro/materia', ['nome' => $_SESSION['loginInfos']['user']['nome'], 'nomeTela'=>'Cadastro de Matéria']);
    }

    public function materiaAction(){
        loginHandler::verificaPermissao('M'); #If false vai para HOME
        $materia = new Materia();
        $retorno = $materia->incluirMateria(filter_input(INPUT_POST, 'desc'));
        if($retorno == 1){
            echo "Cadastro realizado com sucesso";
            echo "<a href='".Config::BASE_DIR."/cadastro/materia'>Voltar</a>";
        } else {
            echo "Error: $retorno";
        }
    }

    public function professorView(){
        loginHandler::verificaPermissao('M'); #If false vai para HOME
        $this->renderIndependente('cadastro/professor', ['nome' => $_SESSION['loginInfos']['user']['nome'], 'nomeTela'=>'Cadastro de Professor']);
    }

    public function professorAction(){
        loginHandler::verificaPermissao('M'); #If false vai para HOME
        $lastId = pessoaHandler::inserePessoa('P');
        if(!$lastId){
            echo "Error: ".$_SESSION['errorMsg'];
            unset($_SESSION['errorMsg']);
            echo "<a href='".Config::BASE_DIR."/cadastro/professor'>Voltar</a>";
            exit();
        }
        $retorno = Professor::incluirProfessor($lastId);
        if($retorno == 1){
            echo "Cadastro realizado com sucesso";
            echo "<a href='".Config::BASE_DIR."/cadastro/professor'>Voltar</a>";
        } else {
            echo "Error: $retorno";
        }
    }
}