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

/*
* Cadastro (Side-Professor)
*/
// -- Aluno
$router->get('/cadastro/aluno', 'cadastroController@alunoView'); #View
$router->post('/cadastro/aluno', 'cadastroController@alunoAction'); #Action

// -- Incluir aluno em Turma:
$router->get('/turma/aluno', 'turmaController@incluirAlunoTurmaView'); #View
// -- Pega os alunos disponíveis para a turma
$router->get('/turma/getAluno/{id}', 'turmaController@getAlunosTurma');
// -- Incluir aluno em Turma:
$router->post('/turma/aluno', 'turmaController@incluirAlunoTurmaAction'); #Action

// -- Visualizar Turmas
$router->get('/turma/visualizar','turmaController@visualizarTurmas');

// -- Visualizar Turmas Aluno
$router->get('/turma/visualizarA','turmaController@visualizarTurmasPorAluno');