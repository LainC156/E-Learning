<?php
class Controlador
{
	private $_vecSolicitud     = [];
	private $_dirHtmlPrincipal = '';
	private $_pilaCss          = [];
	private $_pilaJs           = [];
	private $_pilaHtml         = '';

	
	public function __construct(){}


	protected function _apilaCss($uriCss)
	{
		$this->_pilaCss[] = $uriCss;
	}


	protected function _apilaJs($uriJs)
	{
		$this->_pilaJs[] = $uriJs;
	}

	protected function _maquetaPrincipal($dirHtmlPrincipal)
	{
		$this->_dirHtmlPrincipal = $dirHtmlPrincipal;
	}


	public function injectaCss()
	{
		$cadCss  = '';

		foreach($this->_pilaCss as $css){
			$cadCss .= "<link rel='stylesheet' type='text/css' href='$css'>";
		}

		return $cadCss;
	}


	public function injectaJs()
	{
		$cadJs  = '';

		foreach($this->_pilaJs as $js){
			$cadJs .= "<script type='text/javascript' src='$js'></script>";
		}

		return $cadJs;
	}

	public function injectaHtml()
	{
		return $this->_pilaHtml;
	}


	public function ejecutaAccionHtml($modulo, $controlador, $accion, $vecSolicitud)
	{
		$this->_vecSolicitud = $vecSolicitud;

		$this->{'html' . $accion}();

		include_once(
			"Servidor/Modulos/$modulo"
			. "/$controlador/Interfaces/$accion.phtml"
		);

		$this->_pilaHtml = ob_get_clean();

		include_once($this->_dirHtmlPrincipal);
	}


	public function ejecutaAccionJson($accion)
	{
        $this->_vecSolicitud = json_decode(file_get_contents('php://input'),true);
        $vecRes = $this->{'json' . $accion}($this->_vecSolicitud);
        echo json_encode($vecRes);
	}
}