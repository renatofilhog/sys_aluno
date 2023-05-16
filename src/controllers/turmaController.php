<?php

namespace src\controllers;

use \core\Controller;
use \src\handlers\loginHandler;
use src\Config;
use src\handlers\pessoaHandler;
use src\models\Aluno;
use src\models\Materia;
use src\models\Professor;
use src\models\Turma;

class turmaController extends Controller
{
    public function incluirAlunoTurmaView(){
        loginHandler::verificaPermissao('P'); #If false vai para HOME
        $this->renderIndependente('cadastro/aluno_turma',
            [
                'nome' => $_SESSION['loginInfos']['user']['nome'],
                'nomeTela'=>'Cadastro de Turma',
                'turmas'=> Turma::retornaTurmas()
            ]
        );
    }

    public function getAlunosTurma($id_turma){
        loginHandler::verificaPermissao('P'); #If false vai para HOME
        $arr = Aluno::retornaAlunosTurma(intval($id_turma['id']));
        print_r(json_encode($arr));
    }


    public function incluirAlunoTurmaAction(){
        loginHandler::verificaPermissao('P'); #If false vai para HOME

        if(Turma::incluirAlunoTurma() == 1){
            echo "Cadastro realizado com sucesso";
            echo "<a href='".Config::BASE_DIR."/turma/aluno'>Voltar</a>";
        } else {
            echo "Erro ao cadastrar";
            echo "<a href='".Config::BASE_DIR."/turma/aluno'>Voltar</a>";
        }
    }

    public function alunoView(){
        loginHandler::verificaPermissao('P'); #If false vai para HOME
        $this->renderIndependente('cadastro/aluno',
            [
                'nome' => $_SESSION['loginInfos']['user']['nome'],
                'nomeTela'=>'Cadastro de Aluno'
            ]
        );
    }

    public function alunoAction(){
        loginHandler::verificaPermissao('P'); #If false vai para HOME
        $lastId = pessoaHandler::inserePessoa('A');
        if(!$lastId){
            echo "Error: ".$_SESSION['errorMsg'];
            unset($_SESSION['errorMsg']);
            echo "<a href='".Config::BASE_DIR."/cadastro/aluno'>Voltar</a>";
            exit();
        }
        $retorno = Aluno::incluirAluno($lastId);
        if($retorno == 1){
            echo "Cadastro realizado com sucesso";
            echo "<a href='".Config::BASE_DIR."/cadastro/aluno'>Voltar</a>";
        } else {
            echo "Error: $retorno";
        }
    }


    public function visualizarTurmas(){
        loginHandler::verificaPermissao('P'); #IF false vai para HOME
        $id_professor = 1;
        $turmas = [];
        $this->renderIndependente(
            'visualizar/verTurmas',
            [
                'nome' => $_SESSION['loginInfos']['user']['nome'],
                'nomeTela' => "Visualizar Turmas",
                'turmas'=>$turmas

            ]
        );
    }

}