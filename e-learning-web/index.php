<?php
	include_once('Servidor/Nucleo/Ejecucion/AdmRutas.php');
	include_once('Servidor/Nucleo/Ejecucion/Despachador.php');
	include_once('Servidor/Nucleo/Ejecucion/Sistema.php');
	include_once('Servidor/Nucleo/Definicion/Controlador.php');
	include_once('Servidor/Nucleo/Definicion/BaseDeDatos.php');
	
	$admRutas = new AdmRutas( $_SERVER['REQUEST_URI'] );
	$vecRuta  = $admRutas->obtenerRuta();
	
	Sistema::init();

	$despachador = new Despachador($vecRuta);
	$despachador->ejecuta();
?>