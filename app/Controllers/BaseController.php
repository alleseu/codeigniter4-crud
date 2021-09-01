<?php
namespace App\Controllers;

/**
 * Class BaseController
 *
 * BaseController proporciona un lugar conveniente para cargar componentes y realizar funciones que necesitan todos sus
 * controladores.
 * Extienda esta clase en cualquier controlador nuevo:
 *     class Home extends BaseController
 *
 * Por seguridad, asegúrese de declarar cualquier método nuevo como protegido o privado.
 *
 * @package CodeIgniter
 */

use CodeIgniter\Controller;
use App\Libraries\Utility;

class BaseController extends Controller {

	/**
	 * Un conjunto de ayudantes que se cargarán automáticamente al crear una instancia de clase. Estos ayudantes
	 * estarán disponibles para todos los demás controladores que extiendan el Controlador base.
	 *
	 * @var array
	 */
	protected $helpers = [];

	/**
	 * Constructor.
	 */
	public function initController(\CodeIgniter\HTTP\RequestInterface $request, \CodeIgniter\HTTP\ResponseInterface $response, \Psr\Log\LoggerInterface $logger) {
		// No edite esta línea.
		parent::initController($request, $response, $logger);

		//-----------------------------------------------------------------------------------------------------------------------------
		// Preload any models, libraries, etc, here.
		//-----------------------------------------------------------------------------------------------------------------------------

		$this->utility = new Utility();  //Inicializa la librería de utilidades.
	}
}
