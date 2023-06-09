<?php $render('header', $viewData); ?>
<div class="main-content">
    <!-- Header -->
    <div class="header bg-gradient-primary pb-7 pt-5 pt-md-8"></div>
    <div class="container-fluid mt--7">
        <!-- Table -->
        <div class="row">
            <div class="col">
                <div class="card shadow">
                    <div class="card-header border-0">
                        <h3 class="mb-0">Turmas</h3>
                    </div>
                    <div class="table-responsive">
                        <table class="table align-items-center table-flush">
                            <thead class="thead-light">
                            <tr>
                                <th scope="col">Professor</th>
                                <th scope="col">Matéria</th>
                                <th scope="col">Status</th>
                                <th scope="col">Alunos</th>
                                <th scope="col">Pontuação</th>
                                <th scope="col"></th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php foreach ($turmas as $turma): ?>
                                <tr>
                                    <th scope="row">
                                        <div class="media align-items-center">
<!--                                            <a href="#" class="avatar rounded-circle mr-3">-->
<!--                                                <img alt="Image placeholder" src="../assets/img/theme/bootstrap.jpg">-->
<!--                                            </a>-->
                                            <div class="media-body">
                                                <span class="mb-0 text-sm"><?=$turma['nome_professor']?></span>
                                            </div>
                                        </div>
                                    </th>
                                    <td>
                                        <?=$turma['nome_materia']?>
                                    </td>
                                    <td>
                                    <span class="badge badge-dot mr-4">
                                    <?php
                                        switch ($turma['status']){
                                            case 1:
                                                echo "<i class='bg-yellow'></i> Em andamento";
                                            break;
                                            case 2:
                                                echo "<i class='bg-green'></i> Completo";
                                            break;
                                            case 3:
                                                echo "<i class='bg-red'></i> Cancelado";
                                            break;
                                            case 4:
                                                echo "<i class='bg-cyan'></i> Pausado";
                                        }
                                    ?>
                                    </span>
                                    </td>
                                    <td>
                                        <?=$turma['qt_alunos']?>
                                    </td>
                                    <td>
                                        <?=$turma['pontuacao_turma']?>
                                    </td>
                                    <td class="text-right">
                                        <div class="dropdown">
                                            <a class="btn btn-sm btn-icon-only text-light" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <i class="fas fa-ellipsis-v"></i>
                                            </a>
                                            <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                                <a class="dropdown-item" href="<?=$base;?>/turma/visualizar/alunos/<?=$turma['id_turma']?>">Ver Alunos</a>
                                                <a class="dropdown-item" href="#">Registrar Atividade</a>
                                            </div>
                                        </div>
                                    </td>
                                </tr>

                            <?php endforeach; ?>

                            </tbody>
                        </table>
                    </div>
                    <!--
                    <div class="card-footer py-4 ">
                        <nav aria-label="...">
                            <ul class="pagination justify-content-end mb-0">
                                <li class="page-item disabled">
                                    <a class="page-link" href="#" tabindex="-1">
                                        <i class="fas fa-angle-left"></i>
                                        <span class="sr-only">Previous</span>
                                    </a>
                                </li>
                                <li class="page-item active">
                                    <a class="page-link" href="#">1</a>
                                </li>
                                <li class="page-item">
                                    <a class="page-link" href="#">2 <span class="sr-only">(current)</span></a>
                                </li>
                                <li class="page-item"><a class="page-link" href="#">3</a></li>
                                <li class="page-item">
                                    <a class="page-link" href="#">
                                        <i class="fas fa-angle-right"></i>
                                        <span class="sr-only">Next</span>
                                    </a>
                                </li>
                            </ul>
                        </nav>
                    </div>
                    -->
                </div>
            </div>
        </div>

        <?php $render('footer'); ?>