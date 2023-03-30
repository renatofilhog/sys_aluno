<?php
namespace src\controllers;

use \core\Controller;
use \core\Database;
use PDO;

class testeController extends Controller {

    public function index() {
        $db = \core\Database::getInstance();
        $id = 1;
        $stmt = $db->prepare("SELECT pes.role FROM pessoa pes WHERE pes.id = :id ");
        $stmt->bindParam(":id",$id);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

        print_r( $result[0]['role'] );


    }

    public function sobre() {
        $this->render('sobre');
    }

    public function sobreP($args) {
        print_r($args);
    }

}