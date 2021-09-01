<?php namespace App\Libraries;

/**
 * LIBRERIA - UTILITY.
 * Copyright 2020 - Alejandro Alberto Sánchez Iturriaga.
 *
 * @package App\Libraries
 */
class Utility {

	//FUNCIÓN PARA GENERAR LOGS DE ERRORES EN EL DIRECTORIO "writable/logs".
	public function generarLogError($e) {

		$error = [
			'codigo' => $e->getCode(),
			'mensaje' =>$e->getMessage(),
			'traza' => $e->getTraceAsString()
		];

		log_message('critical', '[ERROR] {codigo} {mensaje}'.PHP_EOL.'{traza}', $error);
	}
}