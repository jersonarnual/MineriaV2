<div class="content-wrapper" style="min-height: 1058.31px;">
  
  <!-- Content Header (Page header) -->
  <section class="content-header">
    
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Comisiones pagadas</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="inicio">Inicio</a></li>
            <li class="breadcrumb-item active"> Comisiones pagadas</li>
          </ol>
        </div>
      </div>
    </div><!-- /.container-fluid -->

  </section>

  <section class="content">
    
    <div class="container-fluid">

      <?php  

      include "modulos/pagos-comisiones/analitica-pagos.php"; 

      include "modulos/pagos-comisiones/tabla-pagos-comisiones-pagadas.php"; 

      ?>

    </div>

  </section>

</div>