<?php
include_once('Servidor/Modulos/Usuarios/_Servicios/BdUsuarios.php');

class ControladorAcceso extends Controlador
{
	protected function htmlPrincipal()
	{
		$this->_maquetaPrincipal('Servidor/Modulos/Sistema/Interfaz/Publica/Principal.phtml');
		$this->_apilaJs('Cliente/Nucleo/Http.js');
		$this->_apilaJs('Cliente/Modulos/Usuarios/Acceso/modulo.js');
	}


	protected function jsonIniciaSesion(array $args)
	{
		return (new BdUsuarios())->validaCredenciales($args['credenciales']);
	}
}