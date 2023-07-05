<?php

$pagos = ControladorPagos::ctrMostrarPagosAll("id_usuario",$usuario["id_usuario"]);
$total_a_pagar=0;
$total_pagos=0;

$solicitudesRetiro=ControladorPagos::ctrMostrarSolicitudesRetiro("usuario", $usuario["id_usuario"], null,null);


$egresos=0;
$ingresos=0;
foreach ($solicitudesRetiro as $key => $value) {

	if($value["tipo"]==1){
		$ingresos=$ingresos+$value["valor"];
	}else{
		$egresos=$egresos+$value["valor"];
	}
      
}


// var_dump($pagos);

foreach ($pagos as $key => $value) {
	$total=0;

	$comprobante = ControladorComprobantes::ctrMostrarComprobantes("id", $value["id_comprobante"]);

	if($comprobante){
	
	$campana = ControladorCampanas::ctrMostrarCampanas("id",$comprobante[0]["campana"]);

	$ganancia = ($comprobante[0]['valor']*$campana['retorno'])/100;

	$total=$comprobante[0]['valor']+$ganancia;

	if($value["estado"]==0){
		$total_a_pagar+=$total;
	}else{
		$total_pagos+=$total;
	}
}

}

?>


<div class="row">

	<div class="col-12 col-sm-6 col-lg-3">
	
		<div class="small-box bg-info">

			<div class="inner">

				<h3>$ <span></span><?php echo number_format($ingresos-$egresos) ?></h3>

				<p class="text-uppercase">Retirar</p>

			</div>

			<div class="icon">

				<i class="fas fa-dollar-sign"></i>

			</div>

			<a href="#" data-toggle="modal" data-target="#modalRetirar" class="small-box-footer">Más información <i class="fa fa-arrow-circle-right"></i></a>

		</div>

	</div>

	<div class="col-12 col-sm-6 col-lg-3">

		<div class="small-box bg-purple">

			<div class="inner">

				<h3>$ <span><?php echo number_format($ingresos) ?></span></h3>

				<p class="text-uppercase">Ingresos</p>

			</div>

			<div class="icon">

				<i class="fas fa-wallet"></i>

			</div>

			<a href="ingresos-uninivel" class="small-box-footer">Más información <i class="fa fa-arrow-circle-right"></i></a>
			
		</div>

	</div>

    <div class="col-12 col-sm-6 col-lg-3">

<div class="small-box bg-purple">

    <div class="inner">

        <h3>$ <span><?php echo number_format($egresos) ?></span></h3>

        <p class="text-uppercase">Egresos</p>

    </div>

    <div class="icon">

        <i class="fas fa-wallet"></i>

    </div>

    <a href="ingresos-uninivel" class="small-box-footer">Más información <i class="fa fa-arrow-circle-right"></i></a>
    
</div>
</div>

<div class="col-12 col-sm-6 col-lg-3">

<div class="small-box bg-purple">

    <div class="inner">

        <h3>$ <span>-</span></h3>

        <p class="text-uppercase">Reinvertir</p>

    </div>

    <div class="icon">

        <i class="fas fa-wallet"></i>

    </div>

    <a href="campanas" class="small-box-footer">Más información <i class="fa fa-arrow-circle-right"></i></a>
    
</div>
</div>

</div>



</div>





<!--=====================================
RETIRAR
======================================-->

<!-- The Modal -->
<div class="modal" id="modalRetirar">
  <div class="modal-dialog">
    <div class="modal-content">

    	<form method="post">

	      <!-- Modal Header -->
	      <div class="modal-header">
	        <h4 class="modal-title">Solicitud de retiro</h4>
	        <button type="button" class="close" data-dismiss="modal">&times;</button>
	      </div>

	      <!-- Modal body -->
	      <div class="modal-body">

              <div class="form-group">

                  <label for="inputMovil" class="control-label">Teléfono</label>

               <div>

					<input type="text" class="form-control" id="inputMovil" name="telefono" data-inputmask="'mask':'(999) 999-9999'" data-mask>

                </div>

              </div>


			  <div class="form-group">

				<label for="registrarValor" class="control-label">Disponible</label>

				<div>

				<input type="number" class="form-control" id="disponible" placeholder="$ <?php echo number_format($ingresos-$egresos) ?>" readonly>

				</div>

			</div>

              <div class="form-group">

                <label for="valor" class="control-label">Valor</label>

                <div>

                <input type="number" class="form-control" id="valor" name="valor" placeholder="Valor" required>

                </div>

              </div>


	      </div>

	      <!-- Modal footer -->
	      <div class="modal-footer d-flex justify-content-between">

	      	<div>

	        	<button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>

	        </div>

        	<div>

	        	<button type="submit" class="btn btn-primary">Generar OTP</button>

	        </div>

	      </div>

		<?php

			$solicitudRetiro = new ControladorPagos();
			$solicitudRetiro->ctrSolicitudRetiro($usuario["id_usuario"], 2);

		?>

      </form>

    </div>
  </div>
</div>