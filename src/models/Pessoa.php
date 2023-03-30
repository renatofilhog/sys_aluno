<?php

namespace src\models;
use core\Database;
use PDO;
class Pessoa
{

    public function getRole(int $id){
        $db = \core\Database::getInstance();
        $stmt = $db->prepare("SELECT pes.role FROM pessoa pes WHERE pes.id = :id ");
        $stmt->bindParam(":id",$id);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        if (count($result)<1){
            return 'A';
        }
        return $result[0]['role'];
    }

    public function verificaLogin(string $email, string $senha){
        $senha = md5($senha);
        $db = \core\Database::getInstance();
        $stmt = $db->prepare("SELECT * FROM pessoa pes WHERE pes.email = :email AND pes.senha = :senha");
        $stmt->bindParam(":email",$email);
        $stmt->bindParam(":senha",$senha);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        if (count($result) > 0){
            return $result[0];
        }
        return null;
    }

    public static function verificaDuplicidade(string $email){
        $pdo = Database::getInstance();
        $stmt = $pdo->prepare("SELECT id FROM pessoa WHERE email = :email");
        $stmt->bindParam(':email',$email);
        $stmt->execute();
        $result = $stmt->fetchAll();
        if (count($result)>0){
            return true;
        }
        return false;
    }

    public static function inserePessoa(array $arr){
        $pdo = Database::getInstance();
        if(Pessoa::verificaDuplicidade($arr['email'])){
            return false;
        }
        $stmt = $pdo->prepare("INSERT INTO pessoa (nome,email,senha,role) VALUES (:nome,:email,:senha,:role)");
        $stmt->bindValue(':nome',$arr['nome']);
        $stmt->bindValue(':email',$arr['email']);
        $stmt->bindValue(':senha',$arr['senha']);
        $stmt->bindValue(':role',$arr['role']);
        $stmt->execute();
        return $pdo->lastInsertId();
    }
}