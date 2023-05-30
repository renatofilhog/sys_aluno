<?php

namespace src\models;

use core\Database;

class Aluno
{

    public static function incluirAluno(int $id){
        $pdo = Database::getInstance();
        if(Aluno::verificaDuplicidade($id)){
            return "Cadastro em duplicidade";
        }
        $stmt = $pdo->prepare("INSERT INTO aluno (id_pessoa) VALUES (:id)");
        $stmt->bindValue(':id',$id);
        $stmt->execute();
        return 1;
    }

    public static function verificaDuplicidade(int $id){
        $pdo = Database::getInstance();
        $stmt = $pdo->prepare("SELECT id FROM aluno WHERE id_pessoa = :id");
        $stmt->bindValue(':id',$id);
        $stmt->execute();
        if (count($stmt->fetchAll())>0){
            return true;
        }
        return false;
    }

    public static function retornaAlunos(string $ativo = 'T'){
        $pdo = Database::getInstance();
        $stmt = $pdo->prepare("SELECT a.id AS id_aluno, b.id AS id_pessoa, b.nome, b.email FROM aluno a, pessoa b WHERE a.id_pessoa = b.id AND a.ativo = :ativo;");
        $stmt->bindValue(':ativo',$ativo);
        $stmt->execute();
        $result = $stmt->fetchAll();
        if (count($result)<1){
            $result = ['id'=>0, 'nome'=>'Sem alunos cadastrados'];
        }
        return $result;
    }

    public static function retornaAlunosTurma(int $id_turma, string $ativo = 'T'){

        $pdo = Database::getInstance();
        $stmt = $pdo->prepare("
                SELECT a.id AS id_aluno, b.id AS id_pessoa, b.nome, b.email 
                FROM aluno a LEFT JOIN pessoa b ON a.id_pessoa = b.id 
                WHERE a.ativo = :ativo 
                  AND NOT EXISTS (SELECT 1 FROM alunos_turma AS at WHERE at.id_aluno = a.id AND at.id_turma = :id_turma)
                ");
        $stmt->bindValue(':id_turma',$id_turma);
        $stmt->bindValue(':ativo',$ativo);
        $stmt->execute();
        $result = $stmt->fetchAll();
        if (count($result)<1){
            $result = ['id'=>0, 'nome'=>'Sem alunos cadastrados'];
        }
        return $result;
    }
}