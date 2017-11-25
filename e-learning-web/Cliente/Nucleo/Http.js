'use string';
( function (global, factory) {

	global.Http = factory;

} )( window, function () {

	var _uri    = '';
	var _datos  = {};
	var _accion = function () {};

	this.estUri = function (cadUri) {
		_uri = cadUri;
		return this;
	};

	this.estDatos = function (datos) {
		_datos = datos;
		return this;
	};

	this.estAccion = function (accion) {
		_accion = accion;
		return this;
	}

	this.post = function (action, error) {
		var xhr = new XMLHttpRequest();
		
		xhr.responseJson = function () {
			console.log(this.responseText);
			return JSON.parse(this.responseText);
		};
		
		xhr.open('POST', _uri);
		xhr.setRequestHeader('Content-Type', 'application/json');
		xhr.setRequestHeader('Accept', 'text/json');
		xhr.addEventListener('load', _accion);
		console.log(_datos);
		xhr.send(JSON.stringify(_datos));
	};
});
