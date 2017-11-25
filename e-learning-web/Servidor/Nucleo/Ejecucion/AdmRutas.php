<?php
class AdmRutas
{
	private 
	  $_vecRutas  = [],
	  $_vecUri    = [];

	public function __construct($cadUriSolicitud)
	{
		$this->_vecRutas = include_once('servidor/configuracion/RutasPreconfiguradas.php');
		$this->_vecUri   = $this->_procesaUri($cadUriSolicitud);
	}
	
	
	private function _procesaUri($cadUri)/*: array*/
	{
		$vecSolicitud = explode('/', $cadUri);
		array_shift($vecSolicitud);
		return $vecSolicitud;
	}

	private function _validaRuta($indiceRuta)/*: boolean*/
	{
		return 
		      !empty($this->_vecRutas[$indiceRuta])
		 && is_array($this->_vecRutas[$indiceRuta])
		 && count($this->_vecRutas[$indiceRuta])===3;
	}


	public function obtenerRuta()/*: array*/
	{
		$indiceRuta = array_shift($this->_vecUri);
		$vecRuta = array();

         /** Establece la dirección del objeto a ejecutar. */
		 if (  $this->_validaRuta($indiceRuta) ) {
             $vecRuta['mod']    = $this->_vecRutas[$indiceRuta][0];
             $vecRuta['ctrl']   = $this->_vecRutas[$indiceRuta][1];
             $vecRuta['accion'] = $this->_vecRutas[$indiceRuta][2];
         } else {
             $vecRuta['mod']    = $indiceRuta;
             $vecRuta['ctrl']   = array_shift($this->_vecUri);
             $vecRuta['accion'] = array_shift($this->_vecUri);
         }

         /** Establece  los  parametros  de  solicitud  que se enviaron a través
             de la URI. */
		 for ( $i=0; $i<count($this->_vecUri); $i = $i+2 ) {
			$vecRuta[$this->_vecUri[$i]] = $this->_vecUri[$i+1];
		 }
		
		return $vecRuta;
	}
}