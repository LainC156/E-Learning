<?php
class BaseDeDatos
{
	private $_servidor      = '';
	private $_usuario       = '';
	private $_contrasena    = '';
	private $_nombreEsquema = '';
	private $_conDb;

	public function __construct()
	{
		$this->_servidor      = 'localhost:3306';
		$this->_usuario       = 'root';
		$this->_contrasena    = '';
		$this->_nombreEsquema = 'proyecto_e_learning';
	}

	private function _iniciaConexion()
	{
		$this->_conDb = new mysqli(
			$this->_servidor,
			$this->_usuario,
			$this->_contrasena,
			$this->_nombreEsquema
		);
	}

	private function _cierraConexion()
	{
		$this->_conDb->close();
	}
	
	protected function _delete($sql)
	{
		$this->_iniciaConexion();

		$q_r=$this->_conDb->query($sql);
		$this->_conDb->query($sql);

		$this->_cierraConexion();
		return $q_r;
	}
	
	protected function _update($sql)
	{
		$this->_iniciaConexion();

		$q_r=$this->_conDb->query($sql);

		$this->_cierraConexion();
		return $q_r;
	}
	

	protected function _insert(array $registro)
	{
		$campos = implode(',', array_keys($registro));
		$datos = implode("','",array_values($registro));

		$sql = "INSERT INTO {$this->_table}({$campos})"
		     . " values('{$datos}')";
		
		$this->_iniciaConexion();

		$q_r=$this->_conDb->query($sql);
		$insert_id=$this->_conDb->insert_id;

		$this->_cierraConexion();
		return $insert_id;
	}


	protected function _select($sql)
	{
		$this->_iniciaConexion();

		$vecResultado = [];
		$resConsulta = $this->_conDb->query($sql);

		if ($resConsulta!==false) {
			if ($fila = $resConsulta->fetch_array()) {
				$tmpFila = [];
				foreach($fila as $clave => $valor){
					if (!is_int($clave) && !empty($valor)) {
						$tmpFila[$clave] = $valor;
					}
				}
				$vecResultado = $tmpFila;
			}
		}

		$this->_cierraConexion();

		return $vecResultado;
	}

	protected function _selectAll($sql)
	{
		$this->_iniciaConexion();

		$vecResultado = [];
		$resConsulta = $this->_conDb->query($sql);

		if ($resConsulta!==false) {
			while ($fila = $resConsulta->fetch_array()) {
				$tmpFila = [];
				foreach($fila as $clave => $valor){
					if (!is_int($clave) && !empty($valor)) {
						$tmpFila[$clave] = $data;
					}
				}
				$vecResultado[] = $tmpFila;
			}
		}

		$this->_cierraConexion();

		return $vecResultado;
	}
}