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
}