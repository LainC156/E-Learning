<?php
include_once('Servidor/Modulos/Usuarios/_Servicios/BdUsuarios.php');

class ControladorRegistro extends Controlador
{
	public function htmlPrincipal()
	{
		$this->_maquetaPrincipal('Servidor/Modulos/Sistema/Interfaz/Publica/Principal.phtml');
		$this->_apilaJs('Cliente/Nucleo/Http.js');
		$this->_apilaJs('Cliente/Modulos/Usuarios/Registro/modulo.js');
	}

	public function jsonNuevoUsuario(array $args)
	{
		return (new BdUsuarios())->insertaUsuario($args['registroUsuario']);
	}
}