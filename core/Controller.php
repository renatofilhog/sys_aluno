<?php
namespace core;

use \src\Config;
use \src\Database;
use PDO;

class Controller {


    public function getPrivilegio(){
        $db = Database::getInstance();


    }
    protected function redirect($url) {
        header("Location: ".$this->getBaseUrl().$url);
        exit;
    }

    private function getBaseUrl() {
        $base = (isset($_SERVER['HTTPS']) && strtolower($_SERVER['HTTPS']) == 'on') ? 'https://' : 'http://';
        $base .= $_SERVER['SERVER_NAME'];
        if($_SERVER['SERVER_PORT'] != '80') {
            $base .= ':'.$_SERVER['SERVER_PORT'];
        }
        $base .= Config::BASE_DIR;
        
        return $base;
    }

    private function _render($folder, $viewName, $viewData = []) {
        if(file_exists('../src/views/'.$folder.'/'.$viewName.'.php')) {
            extract($viewData);
            $render = fn($vN, $vD = []) => $this->renderPartial($vN, $vD);
            $base = $this->getBaseUrl();
            require '../src/views/'.$folder.'/'.$viewName.'.php';
        }
    }

    private function renderPartial($viewName, $viewData = []) {
        $this->_render('partials', $viewName, $viewData);
    }

    public function render($viewName, $viewData = []) {
        if (isset($_SESSION['loginInfos']['user'])){
            $this->_render($_SESSION['loginInfos']['user']['role'], $viewName, $viewData);
        } else {
            $this->_render('pages', $viewName, $viewData);
        }
    }

    public function renderIndependente($viewName, $viewData = []) {
        $this->_render('pages', $viewName, $viewData);
    }

}