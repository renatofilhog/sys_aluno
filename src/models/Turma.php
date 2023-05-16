<?php
namespace src\models;

use core\Database;
use src\handlers\loginHandler;
use src\models;

class Turma {

    public static function incluirTurma(){
        loginHandler::verificaPermissao('M');
        $pdo = Database::getInstance();
        $stmt = $pdo->prepare("INSERT INTO turma (id_materia, id_professor) VALUES (:id_materia, :id_professor)");
        $stmt->bindValue(':id_materia',filter_input(INPUT_POST,'id_materia',FILTER_VALIDATE_INT));
        $stmt->bindValue(':id_professor',filter_input(INPUT_POST,'id_professor',FILTER_VALIDATE_INT));
        if(!$stmt->execute()){
            return false;
        }
        return 1;
    }

    public static function retornaTurmas(string $ativo = 'T'){
        $pdo = Database::getInstance();
        $stmt = $pdo->prepare("SELECT turma.id AS id_turma, turma.id_materia, materia.descricao as nome_materia, pessoa.nome AS nome_professor, pessoa.email AS email_professor FROM turma, professor, materia, pessoa WHERE turma.id_professor = professor.id AND pessoa.id = professor.id_pessoa AND materia.id = turma.id_materia AND turma.ativo = :ativo");
        $stmt->bindValue(':ativo',$ativo);
        $stmt->execute();
        $result = $stmt->fetchAll();
        if (count($result)<1){
            $result = ['id'=>0, 'nome'=>'Sem alunos cadastrados'];
        }
        return $result;
    }

    public static function retornaTurmasProf(int $id_professor){
        $pdo = Database::getInstance();
        $stmt = $pdo->prepare("SELECT t.id AS id_turma, t.id_materia, m.descricao AS nome_materia, p.nome AS nome_professor, p.email AS email_professor, t.ativo, SUM(at.score_turma) AS pontuacao FROM turma t JOIN professor pr ON t.id_professor = :id_professor JOIN pessoa p ON pr.id_pessoa = p.id JOIN materia m ON t.id_materia = m.id LEFT JOIN alunos_turma at ON t.id = at.id_turma GROUP BY t.id, t.id_materia, m.descricao, p.nome, p.email, t.ativo");
        $stmt->bindValue(':id_professor',$id_professor);
        $stmt->execute();
        $result = $stmt->fetchAll();
        if (count($result)<1){
            $result = ['id'=>0, 'nome'=>'Sem professores cadastrados'];
        }
        return $result;
    }


    public static function incluirAlunoTurma(){
        $id_aluno = filter_input(INPUT_POST,'id_aluno',FILTER_SANITIZE_ADD_SLASHES);
        $id_turma = filter_input(INPUT_POST,'id_turma',FILTER_SANITIZE_ADD_SLASHES);
        $pdo = Database::getInstance();
        $stmt = $pdo->prepare("INSERT INTO alunos_turma (id_aluno, id_turma) VALUES (:id_aluno, :id_turma)");
        $stmt->bindValue(':id_aluno',$id_aluno);
        $stmt->bindValue(':id_turma',$id_turma);
        $stmt->execute();
        return 1;
    }
}