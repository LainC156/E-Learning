
<?php
class BdUsuarios extends BaseDeDatos
{
	protected $_table = 'usuarios';


	public function validaCredenciales($credenciales)
	{
		$sqlValida = "SELECT * FROM usuarios WHERE "
		           . "usuario = '{$credenciales['usuario']}' AND "
		           . "clave   = '{$credenciales['clave']}'";

		$vecUsuario = $this->_select($sqlValida);

		if (empty($vecUsuario)) {
			$vecUsuario['error'] = "No hay registros de este usuario";
		}

		return $vecUsuario;
	}


	public function insertaUsuario($vecRegUsuario)
	{
		$id = $this->_insert($vecRegUsuario);
		if (!$id) {
			return ['error' => 'Ocurrio un error al registrar el usuario. Inténtelo mas tarde.'];
		}
		
		return ['exito' => 'Usuario registrado correctamente'];
	}
}