<?php
class Despachador
{
	private $_vecSolicitud  = [];
	private $_objComponente;


	public function __construct(array $vecRuta)
	{
		$this->_vecSolicitud = $vecRuta;
	}
	
	
	public function ejecuta()
	{
		$modulo     = $this->_vecSolicitud['mod'];
		$componente = $this->_vecSolicitud['ctrl'];
		$accion		= $this->_vecSolicitud['accion'];

		 /**
		  * Datos de inicialización del componente. 
		  */
		 $dirComponente = "Servidor/Modulos/{$modulo}"
                        . "/{$componente}/Controlador.php";

		 $nomComponente = 'Controlador' . $componente;

		 include_once($dirComponente);


         /**
          * Ejecuta la accion necesitada. 
          */
         $this->_objComponente = new $nomComponente();
         
         switch (Sistema::aplicacion()) {
         	case Sistema::JSON:
                $this->_objComponente->ejecutaAccionJson($accion);
         	break;

         	case Sistema::HTML:
                $this->_objComponente->ejecutaAccionHtml(
                    $modulo, $componente, $accion,
                	$this->_vecSolicitud
                );
         	break;

         	default:
         	    throw new Exception('Petición incorrecta', 404);
         	break;
         }
	}
}