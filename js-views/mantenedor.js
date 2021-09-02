/*!
 * LÓGICA DE LA VISTA - MANTENEDOR.
 * Copyright 2020 - Alejandro Alberto Sánchez Iturriaga.
 */


var producto;  //Variable global para el ID del producto seleccionado en la tabla.


//FUNCIÓN PARA MOSTRAR EL MODAL 1: CREACIÓN DE PRODUCTOS.
function mostrarModal1() {

	$.ajax({
		url: URL_BASE+'mantenedor/obtenerLista',
		type: 'POST',
		dataType: 'json'

	}).done(function(response) {
		console.log(response);

		//COMPRUEBA EL RESULTADO DE LA SOLICITUD.
		if(response.resultado === EXITO) {

			$('#c_categoria').html('<option value="" selected disabled>Seleccione la categoría del producto</option>');

			//Agrega las categorías a la lista.
			$.each(response.data, function (index, value) {
				$('#c_categoria').append('<option value="'+ value['caId'] +'">'+ value['caDescripcion'] +'</option>');
			});

			//Limpia los campos de texto del formulario.
			$('#c_codigo').val(null);
			$('#c_producto').val(null);
			$('#c_categoria').val(null);

			$('#modal1').modal('show');  //Abre el modal 1.
		}
		else {

			//LLAMA A LA FUNCIÓN QUE MUESTRA EL MENSAJE DEL RESULTADO DE ERROR.
			mostrarMensajeResultado('fa-times-circle', 'Error', 'red', response.mensaje, null);
		}
	}).fail(function(jqXHR, textStatus, errorThrown) {
		console.log(textStatus, errorThrown);

		//LLAMA A LA FUNCIÓN QUE MUESTRA EL MENSAJE DEL RESULTADO DE ERROR.
		mostrarMensajeResultado('fa-times-circle', 'Error', 'red', 'Hubo un error interno, contáctese con el soporte.', null);
	});
}


//FUNCIÓN PARA MOSTRAR EL MODAL 2: ACTUALIZACIÓN DE PRODUCTOS.
function mostrarModal2(data) {

	$.ajax({
		url: URL_BASE+'mantenedor/obtenerLista',
		type: 'POST',
		dataType: 'json'

	}).done(function(response) {
		console.log(response);

		//COMPRUEBA EL RESULTADO DE LA SOLICITUD.
		if(response.resultado === EXITO) {

			$('#a_categoria').html('<option value="" selected disabled>Seleccione la categoría del producto</option>');

			//Agrega las categorías a la lista.
			$.each(response.data, function (index, value) {
				$('#a_categoria').append('<option value="'+ value['caId'] +'">'+ value['caDescripcion'] +'</option>');
			});

			producto = data.id;  //Se guarda el ID del producto seleccionado.

			//Agrega los datos del producto seleccionado en la tabla en los campos de texto del formulario.
			$('#a_codigo').val(data.codigo);
			$('#a_producto').val(data.producto);
			$('#a_categoria').val(data.idCategoria);

			$('#modal2').modal('show');  //Abre el modal 2.
		}
		else {

			//LLAMA A LA FUNCIÓN QUE MUESTRA EL MENSAJE DEL RESULTADO DE ERROR.
			mostrarMensajeResultado('fa-times-circle', 'Error', 'red', response.mensaje, null);
		}
	}).fail(function(jqXHR, textStatus, errorThrown) {
		console.log(textStatus, errorThrown);

		//LLAMA A LA FUNCIÓN QUE MUESTRA EL MENSAJE DEL RESULTADO DE ERROR.
		mostrarMensajeResultado('fa-times-circle', 'Error', 'red', 'Hubo un error interno, contáctese con el soporte.', null);
	});
}


//FUNCIÓN PARA MOSTRAR EL MODAL 3: ELIMINACIÓN DE PRODUCTOS.
function mostrarModal3(data) {

	producto = data.id;  //Se guarda el ID del producto seleccionado.

	//Agrega los datos del producto seleccionado en la tabla en los campos del modal.
	$('#e_codigo').html(data.codigo);
	$('#e_producto').html(data.producto);
	$('#e_categoria').html(data.nombreCategoria);

	$('#modal3').modal('show');  //Abre el modal 3.
}


//DOCUMENT.READY - EJECUTA LAS FUNCIONES UNA VEZ CARGADO EL CONTENIDO HTML DE LA PÁGINA WEB (DOM).
$(function() {

	//Se define y configura la datatable.
	const tabla = $('#tabla').DataTable({
		lengthChange: false,
		ajax: {
			url: URL_BASE+'mantenedor/obtenerTabla',
			type: 'POST',
			error: function(jqXHR, exception) {
				console.log(jqXHR, exception);

				//LLAMA A LA FUNCIÓN QUE MUESTRA EL MENSAJE DEL RESULTADO DE ERROR.
				mostrarMensajeResultado('fa-times-circle', 'Error', 'red', jqXHR['responseText'], null);
			}
		},
		columns: [
			{data:"codigo"},
			{data:"producto"},
			{data:"nombreCategoria"},
			{data:"fechaCreacion"},
			{data:"fechaActualizacion"}
		],
		language: {
			"decimal": "",
			"emptyTable": "No hay datos disponibles en la tabla",
			"info": "Registro del _START_ al _END_ / Total: _TOTAL_",
			"infoEmpty": "No hay registros",
			"infoFiltered": "(filtrado de _MAX_ registros totales)",
			"infoPostFix": "",
			"thousands": ".",
			"lengthMenu": "Mostrar _MENU_ registros",
			"loadingRecords": "Cargando...",
			"processing": "Procesando...",
			"search": "Buscar:",
			"zeroRecords": "No se ha encontrado un registro coincidente",
			"paginate": {
				"first": "Primero",
				"last": "Último",
				"next": "Siguiente",
				"previous": "Anterior"
			},
			"aria": {
				"sortAscending": ": Activar para ordenar la columna de manera ascendente",
				"sortDescending": ": Activar para ordenar la columna de manera descendente"
			},
			"select": {
				"rows": {
					"1": "1 fila seleccionada",
					"_": "%d filas seleccionadas"
				}
			}
		},
		select: true
	});


	//Se define y configura los botones de la datatable.
	new $.fn.dataTable.Buttons(tabla, [
		{
			text: 'CREAR',
			action: function ( e, dt, button, config ) {
				
				//LLAMA A LA FUNCIÓN PARA MOSTRAR EL MODAL 1: CREACIÓN DE PRODUCTOS.
				mostrarModal1();
			}
		},
		{
			extend: 'selectedSingle',
			text: 'EDITAR',
			action: function ( e, dt, button, config ) {
				console.log( dt.row( { selected: true } ).data() );

				//LLAMA A LA FUNCIÓN PARA MOSTRAR EL MODAL 2: ACTUALIZACIÓN DE PRODUCTOS.
				mostrarModal2( dt.row( { selected: true } ).data() );
			}
		},
		{
			extend: 'selectedSingle',
			text: 'ELIMINAR',
			action: function ( e, dt, button, config ) {
				console.log( dt.row( { selected: true } ).data() );

				//LLAMA A LA FUNCIÓN PARA MOSTRAR EL MODAL 3: ELIMINACIÓN DE PRODUCTOS.
				mostrarModal3( dt.row( { selected: true } ).data() );
			}
		}
	]);

	tabla.buttons().container().appendTo( $('.col-md-6:eq(0)', tabla.table().container()) );


	//FUNCIÓN PARA CREAR UN NUEVO PRODUCTO.
	$('#form_modal1').submit(function(event) {
		event.preventDefault();

		$('#boton_modal1').html('<span class="spinner-border spinner-border-sm mr-2"></span>GUANDANDO...');

		$.ajax({
			url: URL_BASE+'mantenedor/crear',
			type: 'POST',
			data: $('#form_modal1').serialize(),
			dataType: 'json'

		}).done(function(response) {
			console.log(response);

			$('#boton_modal1').html('GUARDAR<i class="fas fa-save ml-2"></i>');

			//COMPRUEBA EL RESULTADO DE LA SOLICITUD.
			switch (response.resultado) {
				case EXITO:
					//LLAMA A LA FUNCIÓN QUE MUESTRA EL MENSAJE DEL RESULTADO DE ÉXITO.
					mostrarMensajeResultado('fa-check-circle', 'Felicidades', 'green', response.mensaje, function() {	

						window.location.reload();  //Recarga la página web.
					});
					break;

				case ERROR_ENTRADA:

					//LLAMA A LA FUNCIÓN QUE MUESTRA EL MENSAJE DEL RESULTADO DE ERROR.
					mostrarMensajeResultado('fa-exclamation-circle', 'Error', 'orange', formatearMensaje(response.mensaje), null);
					break;

				case ERROR_VALIDACION:

					//LLAMA A LA FUNCIÓN QUE MUESTRA EL MENSAJE DEL RESULTADO DE ERROR.
					mostrarMensajeResultado('fa-exclamation-circle', 'Error', 'orange', response.mensaje, null);
					break;

				default:
					//LLAMA A LA FUNCIÓN QUE MUESTRA EL MENSAJE DEL RESULTADO DE ERROR.
					mostrarMensajeResultado('fa-times-circle', 'Error', 'red', response.mensaje, function() {	
						
						$('#modal1').modal('hide');  //Cierra el modal 1.
					});
			}
		}).fail(function(jqXHR, textStatus, errorThrown) {
			console.log(textStatus, errorThrown);

			//LLAMA A LA FUNCIÓN QUE MUESTRA EL MENSAJE DEL RESULTADO DE ERROR.
			mostrarMensajeResultado('fa-times-circle', 'Error', 'red', 'Hubo un error interno, contáctese con el soporte.', function() {
				
				$('#modal1').modal('hide');  //Cierra el modal 1.
			});
		});
	});


	//FUNCIÓN PARA ACTUALIZAR UN PRODUCTO.
	$('#form_modal2').submit(function(event) {
		event.preventDefault();

		$('#boton_modal2').html('<span class="spinner-border spinner-border-sm mr-2"></span>GUANDANDO...');

		$.ajax({
			url: URL_BASE+'mantenedor/actualizar',
			type: 'POST',
			data: 'id='+producto+'&'+$('#form_modal2').serialize(),
			dataType: 'json'

		}).done(function(response) {
			console.log(response);

			$('#boton_modal2').html('GUARDAR CAMBIOS<i class="fas fa-save ml-2"></i>');

			//COMPRUEBA EL RESULTADO DE LA SOLICITUD.
			switch (response.resultado) {
				case EXITO:
					//LLAMA A LA FUNCIÓN QUE MUESTRA EL MENSAJE DEL RESULTADO DE ÉXITO.
					mostrarMensajeResultado('fa-check-circle', 'Felicidades', 'green', response.mensaje, function() {	

						window.location.reload();  //Recarga la página web.
					});
					break;

				case ERROR_ENTRADA:
					//LLAMA A LA FUNCIÓN QUE MUESTRA EL MENSAJE DEL RESULTADO DE ERROR.
					mostrarMensajeResultado('fa-exclamation-circle', 'Error', 'orange', formatearMensaje(response.mensaje), null);
					break;

				case ERROR_VALIDACION:
					//LLAMA A LA FUNCIÓN QUE MUESTRA EL MENSAJE DEL RESULTADO DE ERROR.
					mostrarMensajeResultado('fa-exclamation-circle', 'Error', 'orange', response.mensaje, null);
					break;

				default:
					//LLAMA A LA FUNCIÓN QUE MUESTRA EL MENSAJE DEL RESULTADO DE ERROR.
					mostrarMensajeResultado('fa-times-circle', 'Error', 'red', response.mensaje, function() {	
						
						$('#modal2').modal('hide');  //Cierra el modal 2.
					});
			}
		}).fail(function(jqXHR, textStatus, errorThrown) {
			console.log(textStatus, errorThrown);

			//LLAMA A LA FUNCIÓN QUE MUESTRA EL MENSAJE DEL RESULTADO DE ERROR.
			mostrarMensajeResultado('fa-times-circle', 'Error', 'red', 'Hubo un error interno, contáctese con el soporte.', function() {
				
				$('#modal2').modal('hide');  //Cierra el modal 2.
			});
		});
	});


	//FUNCIÓN PARA ELIMINAR UN PRODUCTO.
	$('#boton_modal3').click(function() {

		$('#boton_modal3').html('<span class="spinner-border spinner-border-sm mr-2"></span>ELIMINANDO...');

		$.ajax({
			url: URL_BASE+'mantenedor/eliminar',
			type: 'POST',
			data: {'id': producto},
			dataType: 'json'

		}).done(function(response) {
			console.log(response);

			$('#boton_modal3').html('CONFIRMAR<i class="fas fa-check-circle ml-2"></i>');

			//COMPRUEBA EL RESULTADO DE LA SOLICITUD.
			switch (response.resultado) {
				case EXITO:
					//LLAMA A LA FUNCIÓN QUE MUESTRA EL MENSAJE DEL RESULTADO DE ÉXITO.
					mostrarMensajeResultado('fa-check-circle', 'Felicidades', 'green', response.mensaje, function() {	

						window.location.reload();  //Recarga la página web.
					});
					break;

				case ERROR_VALIDACION:
					//LLAMA A LA FUNCIÓN QUE MUESTRA EL MENSAJE DEL RESULTADO DE ERROR.
					mostrarMensajeResultado('fa-exclamation-circle', 'Error', 'orange', response.mensaje, null);
					break;

				default:
					//LLAMA A LA FUNCIÓN QUE MUESTRA EL MENSAJE DEL RESULTADO DE ERROR.
					mostrarMensajeResultado('fa-times-circle', 'Error', 'red', response.mensaje, function() {	
						
						$('#modal3').modal('hide');  //Cierra el modal 3.
					});
			}
		}).fail(function(jqXHR, textStatus, errorThrown) {
			console.log(textStatus, errorThrown);

			//LLAMA A LA FUNCIÓN QUE MUESTRA EL MENSAJE DEL RESULTADO DE ERROR.
			mostrarMensajeResultado('fa-times-circle', 'Error', 'red', 'Hubo un error interno, contáctese con el soporte.', function() {
				
				$('#modal3').modal('hide');  //Cierra el modal 3.
			});
		});
	});
});




