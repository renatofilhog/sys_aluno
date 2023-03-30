

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
                <!-- Importando formulário de Pessoa - Commum -->
                  <?php $render('pessoa',$viewData); ?>
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

<?php $render('footer'); ?>
