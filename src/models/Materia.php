<?php

namespace src\models;

use core\Database;

class Materia
{
    public function incluirMateria(string $materia){
        if($this->verificaDuplicidade($materia)){
           return "Não permitido matéria em duplicidade.";
        }
        $pdo = Database::getInstance();
        $stmt = $pdo->prepare("INSERT INTO materia (descricao) VALUES (:nomeMateria)");
        $stmt->bindValue(':nomeMateria',$materia);
        $stmt->execute();
        return 1;
    }

    public function verificaDuplicidade(string $materia){
        $pdo = Database::getInstance();
        $stmt = $pdo->prepare("SELECT descricao FROM materia WHERE descricao = :nomeMateria");
        $stmt->bindParam(':nomeMateria',$materia);
        $stmt->execute();
        $result = $stmt->fetchAll();
        if (count($result)>0){
            return true;
        }
        return false;
    }

    public static function retornaMaterias(string $disponivel = "T"){
        $pdo = Database::getInstance();
        $stmt = $pdo->prepare("SELECT * FROM materia WHERE disponivel = :disponivel");
        $stmt->bindValue(':disponivel',$disponivel);
        $stmt->execute();
        $result = $stmt->fetchAll();
        if (count($result)<1){
            $result = [['id'=>"1", 'descricao'=>'Sem matérias cadastradas']];
        }
        return $result;
    }

    public static function retornaNomeMateriaPorTurma($id_turma)
    {
        $pdo = Database::getInstance();
        $stmt = $pdo->prepare("SELECT 
            materia.descricao as nome_materia
            FROM materia
            JOIN turma ON id_turma = :id_turma
            WHERE turma.ativo = 'T' AND materia.disponivel = 'T'
        ");
        $stmt->bindValue(":id_turma", $id_turma);
        $stmt->execute();
        $result = $stmt->fetch();
        if(!$result){
            $result = [['Sem Materia com turma']];
        }
    }
}