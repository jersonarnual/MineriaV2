<?php

require_once "controladores/usuarios.controlador.php";
require_once "modelos/usuarios.modelo.php";

$reporte = new ControladorUsuarios();
$reporte -> ctrDescargarReporte();
