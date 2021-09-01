<?php namespace App\Models;

use CodeIgniter\Model;

/**
 * MODELO - PRODUCTO.
 * Copyright 2020 - Alejandro Alberto Sánchez Iturriaga.
 */
class ProductoModel extends Model {
	
	protected $table = 'producto';
	protected $primaryKey = 'prId';

	protected $allowedFields = ['prCodigo', 'prNombre', 'prCategoria'];

	protected $returnType = 'array';

	protected $useTimestamps = true;  ////Si es verdadero, activara los campos 'created_at' y 'updated_at' al momento de insertar y actualizar un registro.
	protected $useSoftDeletes = true;  //Si es verdadero, no eliminara el registro, solo actualiza el campo 'deleted_at'.

	protected $createdField = 'prCreated';
	protected $updatedField = 'prUpdated';
	protected $deletedField = 'prDeleted';

	//protected $validationRules = [];
	//protected $validationMessages = [];
	//protected $skipValidation = false;


	//FUNCIÓN QUE OBTIENE TODOS LOS PRODUCTOS ACTIVOS. (SI NO HAY PRODUCTOS, RETORNA VACÍO).
	public function obtenerTodos() {

		$data = array();
		
		$sql = "SELECT prId AS id,
					   prCodigo AS codigo,
					   prNombre AS producto,
					   prCategoria AS idCategoria,
					   caDescripcion AS nombreCategoria
				FROM producto,
					 categoria
				WHERE prCategoria = caId
				  AND prDeleted IS NULL";

		$query = $this->db->query($sql);

		if ($query) {

			foreach ($query->getResultArray() as $row) {
				$data[] = $row;
			}

			$query->freeResult();  //Libera la memoria asociada con el resultado y elimina el ID de recurso del resultado.
		}
		
		return $data;  //Retorna una data con el id, código, nombre, categoría de los productos. (Si no hay productos, retorna vacío).
	}


	//FUNCIÓN QUE BUSCA SI ESTÁ REGISTRADO EL CÓDIGO DEL PRODUCTO. (RETORNA LA CANTIDAD DE REGISTROS).
	public function buscarCodigo($codigo) {

		$busqueda = 0;  //Inicialmente el resultado de la búsqueda es (0).
		
		$sql = "SELECT COUNT(prId) AS busqueda
				FROM producto
				WHERE prCodigo = ?";

		$query =$this->db->query($sql, [$codigo]);

		if ($query) {

			$row = $query->getRow();  //Devuelve una única fila de resultados en forma de objeto.

			if (isset($row)) {

				$busqueda = $row->busqueda;  //Obtiene el resultado de la búsqueda. 
			}

			$query->freeResult();  //Libera la memoria asociada con el resultado y elimina el ID de recurso del resultado.
		}
		
		return $busqueda;  //Retorna la cantidad de registros con el código especificado. 
	}


	//FUNCIÓN QUE BUSCA SI ESTÁ REGISTRADO EL CÓDIGO DEL PRODUCTO, DESCARTANDO UN IDENTIFICADOR ESPECÍFICO. (RETORNA LA CANTIDAD DE REGISTROS).
	public function buscarCodigoIdentificador($id, $codigo) {

		$busqueda = 0;  //Inicialmente el resultado de la búsqueda es (0).
		
		$sql = "SELECT COUNT(prId) AS busqueda
				FROM producto
				WHERE prCodigo = ?
				  AND prId != ?";

		$query = $this->db->query($sql, [$codigo, $id]);

		if ($query) {

			$row = $query->getRow();  //Devuelve una única fila de resultados en forma de objeto.

			if (isset($row)) {

				$busqueda = $row->busqueda;  //Obtiene el resultado de la búsqueda. 
			}

			$query->freeResult();  //Libera la memoria asociada con el resultado y elimina el ID de recurso del resultado.
		}
		
		return $busqueda;  //Retorna la cantidad de registros con el código especificado. 
	}
}