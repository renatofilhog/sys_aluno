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
}