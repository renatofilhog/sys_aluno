<?php
use core\Router;

$router = new Router();
$router->get('/', 'HomeController@index');
$router->get('/sobre/{nome}', 'HomeController@sobreP');
$router->get('/sobre', 'HomeController@sobre');
$router->get('/teste','testeController@index');


// Login
$router->get('/login','loginController@login'); #Tela Login
$router->post('/login','loginController@validaLogin'); #Valida Login
$router->get('/logout','loginController@logout'); #Logout usuário

/*
* Cadastro (Side-Admin)
*/
// -- Matéria
$router->get('/cadastro/materia', 'cadastroController@materiaView'); #View
$router->post('/cadastro/materia', 'cadastroController@materiaAction'); #Action
// -- Professor
$router->get('/cadastro/professor', 'cadastroController@professorView'); #View
$router->post('/cadastro/professor', 'cadastroController@professorAction'); #Action
// -- Turma
$router->get('/cadastro/turma', 'cadastroController@turmaView'); #View
$router->post('/cadastro/turma', 'cadastroController@turmaAction'); #Action

