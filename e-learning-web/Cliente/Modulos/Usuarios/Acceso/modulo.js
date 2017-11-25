'use string';
( function (global, factory) {

	if (!global.modulos) {
		global.modulos = {}
	}
	global.modulos.acceso = factory(new global.Http());
	

})(window, function (_objHttp) {
	
	function Acceso () {
		document
		 .querySelector('#btn-entrar')
		 .addEventListener('click', this.iniciaSesion);

		document
		 .querySelector('#form-registro')
		 .addEventListener('click', this.registroUsuarios);
	}

	Acceso.credenciales = function () {
        return {
            credenciales: {
                usuario: document.querySelector('#usuario').value,
                clave:   document.querySelector('#clave').value
            }
        };
    };

	Acceso.inicioValido = function () {
		var usr = this.responseJson();
		if (usr.error) {
			document
			 .querySelector('#error-warning')
			 .classList.toggle('f-error',true);
			
			document
			 .querySelector('#error-warning')
			 .innerHTML = '<strong>Error: </strong>'+usr.error;
		} else {
			document
			 .querySelector('#error-warning')
			 .classList.toggle('f-error',false);
			alert(`Bienvenido ${usr.nombre} ${usr.p_apellido} ${usr.s_apellido}`);
		}
	};

	Acceso.prototype.iniciaSesion = function () {
		_objHttp
		 .estUri('/usuarios/acceso/iniciasesion')
		 .estDatos(Acceso.credenciales())
		 .estAccion(Acceso.inicioValido)
		 .post();
	};

	Acceso.prototype.registroUsuarios = function () {
		location.href = '/registro'
	}

	return new Acceso();
});
