'use string';
( function (global, factory) {

	if (!global.modulos) {
		global.modulos = {}
	}
	global.modulos.registro = factory(new global.Http());
	

})(window, function (_objHttp) {
	function Registro () {
		document
		 .querySelector('#btn-registrar')
		 .addEventListener('click', this.iniciaSesion);
	}

	Registro.registroDeUsuario = function () {
        return {
            registroUsuario: {
                nombre:     document.querySelector('#nombre').value,
                p_apellido: document.querySelector('#p_apellido').value,
                s_apellido: document.querySelector('#s_apellido').value,
                correo:     document.querySelector('#correo_electronico').value,
                telefono:   document.querySelector('#telefono').value,
                usuario:    document.querySelector('#usuario').value,
                clave:      document.querySelector('#clave').value
            }
        };
    };

	Registro.inicioValido = function () {
		var res = this.responseJson();
		if (res.error) {
			console.log(error);
			// document
			//  .querySelector('#error-warning')
			//  .classList.toggle('f-error',true);
			
			// document
			//  .querySelector('#error-warning')
			//  .innerHTML = '<strong>Error: </strong>'+usr.error;
		} else {
			// document
			//  .querySelector('#error-warning')
			//  .classList.toggle('f-error',false);
			alert(res.exito+'. Ingresa tus datos de registro para iniciar una sesión en el sistema.');
			location.href = '/acceso';
		}
	};

	Registro.prototype.iniciaSesion = function () {
		_objHttp
		 .estUri('/usuarios/registro/nuevousuario')
		 .estDatos(Registro.registroDeUsuario())
		 .estAccion(Registro.inicioValido)
		 .post();
	};

	return new Registro();
});
