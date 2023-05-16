
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
        $('#input-aluno').click(function() {
            $('#input-aluno option[data-neg="true"]').remove();
        });

        $('#input-turma').click(function() {
            $('#input-turma option[data-neg="true"]').remove();
        });
    });
</script>

<style>

</style>
<!-- Conteúdo Dinâmico -->
<?php $render('header',$viewData); ?>
<!-- Header -->
    <div class="header pb-8 pt-5 pt-lg-8 d-flex align-items-center" style="min-height: 100px; background">
      <!-- Mask -->
        <span class="mask bg-gradient-default"></span>

    </div>
    <!-- Page content -->
    <div class="container-fluid mt--7">
          <div class="row">
        <div class="col-xl-12 order-xl-1">
          <div class="card bg-secondary shadow">
            <div class="card-header bg-white border-0">
              <div class="row align-items-center">
                <div class="col-8">
                  <h3 class="mb-0">Preencha corretamente abaixo:</h3>
                </div>
                <div class="col-4 text-right">
                  <a href="<?=$base?>/" class="btn btn-sm btn-primary bg-red">Voltar</a>
                </div>
              </div>
            </div>
            <div class="card-body">
              <form method="post">
                <h6 class="heading-small text-muted mb-4"><?=$nomeTela?></h6>
                <div class="pl-lg-4">
                  <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="form-control-label" for="input-turma">Selecione a turma</label>
                            <select name="id_turma" id="input-turma" class="form-control form-control-alternative" required>
                                <option data-neg="false" value="">Selecione a turma</option>
                                <!-- Inicio foreach options-->
                                <?php foreach ($turmas as $turma):?>
                                    <option value="<?=$turma['id_turma']?>"><?=$turma['nome_materia'] . " - " .$turma['nome_professor']?></option>
                                <?php endforeach;?>
                                <!-- Fim foreach options-->
                            </select>
                        </div>
                        <div class="form-group">
                            <label class="form-control-label" for="input-desc">Selecione o Aluno</label>
                            <select name="id_aluno" id="input-aluno" class="form-control form-control-alternative" required>
                                <option data-neg="true" value="">Selecione a turma primeiro</option>
                            </select>
                        </div>
                    </div>
                  </div>

                </div>
                <hr class="my-4" />
                 <div class="pl-lg-4">
                  <div class="form-group">
                      <input type="submit" value="Cadastrar" class="btn btn-primary bg-success">
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>

        <script>
            let caminhoBase = "<?php echo $base?>/turma/getAluno";
            let turma = document.getElementById("input-turma");
            window.addEventListener('load', ()=>{
                carregarAlunos(turma.value);
            });
            turma.addEventListener('change',()=>{
                let id_turma = turma.value;
                carregarAlunos(id_turma);
            });
            let selectAlunos = document.getElementById("input-aluno");
            const carregarAlunos = (id_turma)=>{
                fetch(`${caminhoBase}/${id_turma}`)
                    .then(response => response.json())
                    .then(data => {
                        console.log(data);

                        // Limpa as opções existentes
                        selectAlunos.innerHTML = '';

                        //Cria novas opções a partir dos dados da resposta
                        data.forEach(aluno => {
                            const option = document.createElement('option');
                            option.value = aluno.id_aluno;
                            option.textContent = aluno.nome + " - " + aluno.email;
                            selectAlunos.appendChild(option);
                        });

                    })
                    .catch(error => {
                        // Faça algo com o erro
                    });
            }
        </script>
<?php $render('footer'); ?>
