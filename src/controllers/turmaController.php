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
                'turmas'=> Turma::retornaTurmasByProfessor($_SESSION["loginInfos"]["user"]["id"])
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
        $turmas = [];
        foreach (Turma::retornaTurmasByProfessor($_SESSION["loginInfos"]["user"]["id"]) as $item) {
            $turmas[] = [
                "id_turma" => $item['id_turma'],
                "id_professor" => $item['id_professor'],
                "nome_professor" => $item['nome_professor'],
                "id_materia" => $item['id_materia'],
                "nome_materia" => $item['nome_materia'],
                "status" => $item['status'],
                "qt_alunos" => 2,
                "pontuacao_turma" => $item['pontuacao']
            ];
        }
        $this->renderIndependente(
            'visualizar/verTurmas',
            [
                'nome' => $_SESSION['loginInfos']['user']['nome'],
                'nomeTela' => "Visualizar Turmas",
                'turmas'=>$turmas
            ]
        );
    }

    public function visualizarTurmasPorAluno(){
        loginHandler::verificaPermissao('A');
        $turmas = [];
        foreach (Turma::retornaTurmasByAluno($_SESSION["loginInfos"]["user"]["id"]) as $item) {
            $turmas[] = [
                "id_turma" => $item['id_turma'],
                "id_professor" => $item['id_professor'],
                "nome_professor" => $item['nome_professor'],
                "id_materia" => $item['id_materia'],
                "nome_materia" => $item['nome_materia'],
                "status" => $item['status'],
                "tarefas_pendentes" => $item['tarefas_pendentes'],
                "pontuacao_turma" => $item['pontuacao']
            ];
        }
        $this->renderIndependente(
            'visualizar/verTurmasAluno',
            [
                'nome' => $_SESSION['loginInfos']['user']['nome'],
                'nomeTela' => "Visualizar Turmas",
                'turmas'=>$turmas
            ]
        );
    }

    public function visualizarAlunosPorTurma($id_turma)
    {
        loginHandler::verificaPermissao('P');
        $alunos = [];

        foreach (Turma::retornaAlunosPorTurma($id_turma['id']) as $item) {
            $alunos[] = [
                "nome_aluno" => $item['nome_aluno'],
                "pontuacao_aluno" => $item['pontuacao_aluno']
            ];
        }

        $this->renderIndependente(
            'visualizar/verTurmasAluno',
            [
                'nome' => $_SESSION['loginInfos']['user']['nome'],
                'nomeTela' => "Visualizar alunos",
                'alunos'=>$alunos,
                'nome_materia' => Materia::retornaNomeMateriaPorTurma($id_turma),
                'nome_professor'
            ]
        );
    }

}