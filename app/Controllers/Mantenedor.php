<?php namespace App\Controllers;

use App\Models\CategoriaModel;
use App\Models\ProductoModel;

/**
 * CONTROLADOR - MANTENEDOR.
 * Copyright 2020 - Alejandro Alberto Sánchez Iturriaga.
 */
class Mantenedor extends BaseController {

	//FUNCIÓN PARA CARGAR TODO EL CONTENIDO INICIAL DE LA PÁGINA.
	public function index() {
		
		return view('mantenedor');
	}


	//FUNCIÓN PARA OBTENER LOS DATOS DE LA DATATABLE.
	public function obtenerTabla() {

		try {

			$productoModel = new ProductoModel();

			//LLAMA A LA FUNCIÓN QUE OBTIENE TODOS LOS PRODUCTOS ACTIVOS. (SI NO HAY PRODUCTOS, RETORNA VACÍO).
			$data = $productoModel->obtenerTodos();

			return $this->response->setJSON(['data' => $data]);  //Retorna la data para el ajax del dataTable de la vista.
		}
		catch (\Exception $e) {

			//LLAMA A LA FUNCIÓN PARA GENERAR LOGS DE ERRORES EN EL DIRECTORIO "writable/logs".
			$this->utility->generarLogError($e);

			echo 'Hubo un error interno, contáctese con el soporte.';  //Retorna mensaje de error para el ajax del dataTable de la vista.
		}
	}


	//FUNCIÓN PARA OBTENER LOS DATOS DE LA LISTA DESPLEGABLE.
	public function obtenerLista() {

		try {

			$categoriaModel = new CategoriaModel();

			//LLAMA A LA FUNCIÓN INTERNA QUE OBTIENE TODOS LOS DATOS DE LA TABLA CATEGORIA.
			$data = $categoriaModel->findAll();

			$respuesta = [
				'resultado' => EXITO,
				'data' => $data
			];
		}
		catch (\Exception $e) {

			//LLAMA A LA FUNCIÓN PARA GENERAR LOGS DE ERRORES EN EL DIRECTORIO "writable/logs".
			$this->utility->generarLogError($e);

			$respuesta = [
				'resultado' => ERROR_EXCEPCION,
				'mensaje' => 'Hubo un error interno, contáctese con el soporte.'
			];
		}

		return $this->response->setJSON($respuesta);  //Retorna la respuesta para el ajax de la vista.
	}


	//FUNCIÓN PARA PROCESAR LA CREACIÓN DE UN PRODUCTO NUEVO.
	public function crear() {

		helper(['form', 'url']);
		
		$validacion = $this->validate([
			'codigo' => [
				'rules'  => 'required|numeric|min_length[3]|max_length[3]',
				'errors' => [
					'required' => 'Campo vacío. Debe ingresar un código.',
					'numeric' => 'Código inválido. El código solo acepta carácteres numéricos',
					'min_length' => 'Longitud inválida. El código ingresado debe tener 3 dígitos.',
					'max_length' => 'Longitud inválida. El código ingresado debe tener 3 dígitos.'
				]
			],
			'producto' => [
				'rules'  => 'required|alpha_numeric_space|max_length[30]',
				'errors' => [
					'required' => 'Campo vacío. Debe ingresar un producto.',
					'alpha_numeric_space' => 'Producto inválido. El nombre del producto solo acepta carácteres alfanuméricos y espacio. ',
					'max_length' => 'Longitud inválida. El nombre del producto puede tener un máximo de 30 carácteres.'
				]
			],
			'categoria' => [
				'rules'  => 'required|is_not_unique[categoria.caId]',
				'errors' => [
					'required' => 'Campo vacío. Debe seleccionar una categoría.',
					'is_not_unique' => 'Selección inválida. La categoría no es correcta.'
				]
			]
		]);

		if (!$validacion) {

			$respuesta = [
				'resultado' => ERROR_ENTRADA,
				'mensaje' => $this->validator->getErrors()
			];
		}
		else {
			
			try {

				$codigo = $this->request->getVar('codigo');  //Se obtiene el código del producto.

				//Se obtienen los datos POST recibidos desde la vista.
				$data = [
					'prCodigo' => $this->request->getVar('codigo'),
					'prNombre' => $this->request->getVar('producto'),
					'prCategoria' => $this->request->getVar('categoria')
				];

				$productoModel = new ProductoModel();

				//LLAMA A LA FUNCIÓN QUE BUSCA SI ESTÁ REGISTRADO EL CÓDIGO DEL PRODUCTO. (RETORNA LA CANTIDAD DE REGISTROS).
				$busqueda = $productoModel->buscarCodigo($codigo);

				if ($busqueda == 0) {

					//LLAMA A LA FUNCIÓN INTERNA QUE INSERTA UN PRODUCTO NUEVO.
					if ($productoModel->insert($data) === false) {

						$respuesta = [
							'resultado' => ERROR_VALIDACION,
							'mensaje' => 'El producto no pudo ser creado.'
						];
					}
					else {

						$respuesta = [
							'resultado' => EXITO,
							'mensaje' => 'El producto fue creado exitosamente.'
						];
					}
				}
				else {

					$respuesta = [
						'resultado' => ERROR_VALIDACION,
						'mensaje' => 'El código del producto ya existe.'
					];
				}
			}
			catch (\Exception $e) {

				//LLAMA A LA FUNCIÓN PARA GENERAR LOGS DE ERRORES EN EL DIRECTORIO "writable/logs".
				$this->utility->generarLogError($e);

				$respuesta = [
					'resultado' => ERROR_EXCEPCION,
					'mensaje' => 'Hubo un error interno, contáctese con el soporte.'
				];
			}
		}

		return $this->response->setJSON($respuesta);  //Retorna la respuesta para el ajax de la vista.
	}


	//FUNCIÓN PARA PROCESAR LA ACTUALIZACIÓN DE UN PRODUCTO.
	public function actualizar() {

		helper(['form', 'url']);
		
		$validacion = $this->validate([
			'codigo' => [
				'rules'  => 'required|numeric|min_length[3]|max_length[3]',
				'errors' => [
					'required' => 'Campo vacío. Debe ingresar un código.',
					'numeric' => 'Código inválido. El código solo acepta carácteres numéricos',
					'min_length' => 'Longitud inválida. El código ingresado debe tener 3 dígitos.',
					'max_length' => 'Longitud inválida. El código ingresado debe tener 3 dígitos.'
				]
			],
			'producto' => [
				'rules'  => 'required|alpha_numeric_space|max_length[30]',
				'errors' => [
					'required' => 'Campo vacío. Debe ingresar un producto.',
					'alpha_numeric_space' => 'Producto inválido. El nombre del producto solo acepta carácteres alfanuméricos y espacio. ',
					'max_length' => 'Longitud inválida. El nombre del producto puede tener un máximo de 30 carácteres.'
				]
			],
			'categoria' => [
				'rules'  => 'required|is_not_unique[categoria.caId]',
				'errors' => [
					'required' => 'Campo vacío. Debe seleccionar una categoría.',
					'is_not_unique' => 'Selección inválida. La categoría no es correcta.'
				]
			]
		]);

		if (!$validacion) {

			$respuesta = [
				'resultado' => ERROR_ENTRADA,
				'mensaje' => $this->validator->getErrors()
			];
		}
		else {

			try {

				//Comprueba que el dato POST recibido no está vacío.
				if(!empty($this->request->getVar('id'))) {

					$id = $this->request->getVar('id');  //Se obtiene el ID del producto.
					$codigo = $this->request->getVar('codigo');  //Se obtiene el código del producto.

					//Se obtienen los datos POST recibidos desde la vista.
					$data = [
						'prCodigo' => $this->request->getVar('codigo'),
						'prNombre' => $this->request->getVar('producto'),
						'prCategoria' => $this->request->getVar('categoria')
					];

					$productoModel = new ProductoModel();

					//LLAMA A LA FUNCIÓN QUE BUSCA SI ESTÁ REGISTRADO EL CÓDIGO DEL PRODUCTO, DESCARTANDO UN IDENTIFICADOR ESPECÍFICO. (RETORNA LA CANTIDAD DE REGISTROS).
					$busqueda = $productoModel->buscarCodigoFiltrado($id, $codigo);

					if ($busqueda == 0) {

						//LLAMA A LA FUNCIÓN INTERNA QUE ACTUALIZA UN PRODUCTO DE UN IDENTIFICADOR ESPECÍFICO.
						if ($productoModel->update($id, $data) === false) {

							$respuesta = [
								'resultado' => ERROR_VALIDACION,
								'mensaje' => 'El producto no pudo ser actualizado.'
							];
						}
						else {

							$respuesta = [
								'resultado' => EXITO,
								'mensaje' => 'El producto fue actualizado exitosamente.'
							];
						}
					}
					else {

						$respuesta = [
							'resultado' => ERROR_VALIDACION,
							'mensaje' => 'El código del producto ya existe.'
						];
					}
				}
				else {

					throw new \Exception('El identificador del producto es nulo.');
				}
			}
			catch (\Exception $e) {

				//LLAMA A LA FUNCIÓN PARA GENERAR LOGS DE ERRORES EN EL DIRECTORIO "writable/logs".
				$this->utility->generarLogError($e);

				$respuesta = [
					'resultado' => ERROR_EXCEPCION,
					'mensaje' => 'Hubo un error interno, contáctese con el soporte.'
				];
			}
		}

		return $this->response->setJSON($respuesta);  //Retorna la respuesta para el ajax de la vista.
	}


	//FUNCIÓN PARA PROCESAR LA ELIMINACIÓN DE UN PRODUCTO.
	public function eliminar() {

		try {

			//Comprueba que el dato POST recibido no está vacío.
			if(!empty($this->request->getVar('id'))) {

				$id = $this->request->getVar('id');  //Se obtiene el ID del producto.

				$productoModel = new ProductoModel();

				//LLAMA A LA FUNCIÓN INTERNA QUE ELIMINA UN PRODUCTO DE UN IDENTIFICADOR ESPECÍFICO.
				if ($productoModel->delete($id)) {

					$respuesta = [
						'resultado' => EXITO,
						'mensaje' => 'El producto fue eliminado exitosamente.'
					];
				}
				else {

					$respuesta = [
						'resultado' => ERROR_VALIDACION,
						'mensaje' => 'El producto no pudo ser eliminado.'
					];
				}
			}
			else {

				throw new \Exception('El identificador del producto es nulo.');
			}
		}
		catch (\Exception $e) {

			//LLAMA A LA FUNCIÓN PARA GENERAR LOGS DE ERRORES EN EL DIRECTORIO "writable/logs".
			$this->utility->generarLogError($e);

			$respuesta = [
				'resultado' => ERROR_EXCEPCION,
				'mensaje' => 'Hubo un error interno, contáctese con el soporte.'
			];
		}

		return $this->response->setJSON($respuesta);  //Retorna la respuesta para el ajax de la vista.
	}
}
