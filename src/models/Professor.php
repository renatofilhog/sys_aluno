<?php

namespace src\models;

use core\Database;
use src\models;

class Professor
{
    public static function verificaDuplicidade(int $id){
        $pdo = Database::getInstance();
        $stmt = $pdo->prepare("SELECT id FROM professor WHERE id_pessoa = :id");
        $stmt->bindValue(':id',$id);
        $stmt->execute();
        if (count($stmt->fetchAll())>0){
            return true;
        }
        return false;
    }
    public static function incluirProfessor(int $id){
        $pdo = Database::getInstance();
        if(Professor::verificaDuplicidade($id)){
            return "Cadastro em duplicidade";
        }
        $stmt = $pdo->prepare("INSERT INTO professor (id_pessoa) VALUES (:id)");
        $stmt->bindValue(':id',$id);
        $stmt->execute();
        return 1;
    }

    public static function retornaProfessores(string $ativo = 'T'){
        $pdo = Database::getInstance();
        $stmt = $pdo->prepare("SELECT a.id AS id_professor, b.id AS id_pessoa, b.nome, b.email FROM professor a, pessoa b WHERE a.id_pessoa = b.id AND a.ativo = :ativo;");
        $stmt->bindValue(':ativo',$ativo);
        $stmt->execute();
        $result = $stmt->fetchAll();
        if (count($result)<1){
            $result = ['id'=>0, 'nome'=>'Sem professores cadastrados'];
        }
        return $result;
    }

    public static function retornaNomeProfessorPorTurma($id_turma)
    {

    }
}