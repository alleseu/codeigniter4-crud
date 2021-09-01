<?php namespace App\Models;

use CodeIgniter\Model;

/**
 * MODELO - CATEGORÍA.
 * Copyright 2020 - Alejandro Alberto Sánchez Iturriaga.
 */
class CategoriaModel extends Model {
	
	protected $table = 'categoria';
	protected $primaryKey = 'caId';

	protected $allowedFields = ['caDescripcion'];

	protected $returnType = 'array';

	//protected $useTimestamps = false;
	//protected $useSoftDeletes = false;

	//protected $createdField = 'created_at';
	//protected $updatedField = 'updated_at';
	//protected $deletedField = 'deleted_at';

	//protected $validationRules = [];
	//protected $validationMessages = [];
	//protected $skipValidation = false;
}