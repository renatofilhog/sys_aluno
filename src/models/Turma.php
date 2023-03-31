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
}