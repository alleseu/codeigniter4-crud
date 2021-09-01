<?php namespace Config;

use CodeIgniter\Config\BaseConfig;

class App extends BaseConfig {

	/*
	|--------------------------------------------------------------------------
	| Base Site URL
	|--------------------------------------------------------------------------
	|
	| URL a su raíz CodeIgniter. Por lo general, esta será su URL base, con una barra inclinada final:
	|
	|	http://example.com/
	|
	| Si esto no está configurado, CodeIgniter intentará adivinar el protocolo, el dominio y
	| la ruta a su instalación. Sin embargo, siempre debe configurar esto explícitamente y
	| nunca confiar en las conjeturas automáticas, especialmente en entornos de producción.
	|
	*/
	// public $baseURL = 'http://localhost:8080/';
	public $baseURL = 'http://localhost/codeigniter4-crud/';

	/*
	|--------------------------------------------------------------------------
	| Index File
	|--------------------------------------------------------------------------
	|
	| Por lo general, este será su archivo index.php, a menos que lo haya renombrado a otra cosa.
	| Si está utilizando mod_rewrite para eliminar la página, configure esta variable para que
	| quede en blanco.
	|
	*/
	//public $indexPage = 'index.php';
	public $indexPage = '';

	/*
	|--------------------------------------------------------------------------
	| URI PROTOCOL
	|--------------------------------------------------------------------------
	|
	| This item determines which getServer global should be used to retrieve the
	| URI string.  The default setting of 'REQUEST_URI' works for most servers.
	| If your links do not seem to work, try one of the other delicious flavors:
	|
	| 'REQUEST_URI'    Uses $_SERVER['REQUEST_URI']
	| 'QUERY_STRING'   Uses $_SERVER['QUERY_STRING']
	| 'PATH_INFO'      Uses $_SERVER['PATH_INFO']
	|
	| WARNING: If you set this to 'PATH_INFO', URIs will always be URL-decoded!
	*/
	public $uriProtocol = 'REQUEST_URI';

	/*
	|--------------------------------------------------------------------------
	| Default Locale
	|--------------------------------------------------------------------------
	|
	| La configuración regional representa aproximadamente el idioma y la
	| ubicación desde donde su visitante está viendo el sitio. Afecta las cadenas
	| de idioma y otras cadenas (como marcadores de moneda, números, etc.) con
	| las que su programa debe ejecutarse para esta solicitud.
	|
	*/
	//public $defaultLocale = 'en';
	public $defaultLocale = 'es';

	/*
	|--------------------------------------------------------------------------
	| Negotiate Locale
	|--------------------------------------------------------------------------
	|
	| If true, the current Request object will automatically determine the
	| language to use based on the value of the Accept-Language header.
	|
	| If false, no automatic detection will be performed.
	|
	*/
	public $negotiateLocale = false;

	/*
	|--------------------------------------------------------------------------
	| Supported Locales
	|--------------------------------------------------------------------------
	|
	| If $negotiateLocale is true, this array lists the locales supported
	| by the application in descending order of priority. If no match is
	| found, the first locale will be used.
	|
	*/
	public $supportedLocales = ['en'];

	/*
	|--------------------------------------------------------------------------
	| Application Timezone
	|--------------------------------------------------------------------------
	|
	| La zona horaria predeterminada que se usará en su aplicación para mostrar
	| fechas con el asistente de fecha, y se puede recuperar a través de
	| app_timezone()
	|
	*/
	//public $appTimezone = 'America/Chicago';
	public $appTimezone = 'America/Santiago';

	/*
	|--------------------------------------------------------------------------
	| Default Character Set
	|--------------------------------------------------------------------------
	|
	| This determines which character set is used by default in various methods
	| that require a character set to be provided.
	|
	| See http://php.net/htmlspecialchars for a list of supported charsets.
	|
	*/
	public $charset = 'UTF-8';

	/*
	|--------------------------------------------------------------------------
	| URI PROTOCOL
	|--------------------------------------------------------------------------
	|
	| If true, this will force every request made to this application to be
	| made via a secure connection (HTTPS). If the incoming request is not
	| secure, the user will be redirected to a secure version of the page
	| and the HTTP Strict Transport Security header will be set.
	*/
	public $forceGlobalSecureRequests = false;

	/*
	|--------------------------------------------------------------------------
	| Session Variables
	|--------------------------------------------------------------------------
	|
	| 'sessionDriver'
	|
	|	The storage driver to use: files, database, redis, memcached
	|       - CodeIgniter\Session\Handlers\FileHandler
	|       - CodeIgniter\Session\Handlers\DatabaseHandler
	|       - CodeIgniter\Session\Handlers\MemcachedHandler
	|       - CodeIgniter\Session\Handlers\RedisHandler
	|
	| 'sessionCookieName'
	|
	|	The session cookie name, must contain only [0-9a-z_-] characters
	|
	| 'sessionExpiration'
	|
	|	The number of SECONDS you want the session to last.
	|	Setting to 0 (zero) means expire when the browser is closed.
	|
	| 'sessionSavePath'
	|
	|	The location to save sessions to, driver dependent.
	|
	|	For the 'files' driver, it's a path to a writable directory.
	|	WARNING: Only absolute paths are supported!
	|
	|	For the 'database' driver, it's a table name.
	|	Please read up the manual for the format with other session drivers.
	|
	|	IMPORTANT: You are REQUIRED to set a valid save path!
	|
	| 'sessionMatchIP'
	|
	|	Whether to match the user's IP address when reading the session data.
	|
	|	WARNING: If you're using the database driver, don't forget to update
	|	         your session table's PRIMARY KEY when changing this setting.
	|
	| 'sessionTimeToUpdate'
	|
	|	How many seconds between CI regenerating the session ID.
	|
	| 'sessionRegenerateDestroy'
	|
	|	Whether to destroy session data associated with the old session ID
	|	when auto-regenerating the session ID. When set to FALSE, the data
	|	will be later deleted by the garbage collector.
	|
	| Other session cookie settings are shared with the rest of the application,
	| except for 'cookie_prefix' and 'cookie_httponly', which are ignored here.
	|
	*/
	public $sessionDriver            = 'CodeIgniter\Session\Handlers\FileHandler';
	public $sessionCookieName        = 'ci_session';
	public $sessionExpiration        = 7200;
	public $sessionSavePath          = WRITEPATH . 'session';
	public $sessionMatchIP           = false;
	public $sessionTimeToUpdate      = 300;
	public $sessionRegenerateDestroy = false;

	/*
	|--------------------------------------------------------------------------
	| Cookie Related Variables
	|--------------------------------------------------------------------------
	|
	| 'cookiePrefix'   = Set a cookie name prefix if you need to avoid collisions
	| 'cookieDomain'   = Set to .your-domain.com for site-wide cookies
	| 'cookiePath'     = Typically will be a forward slash
	| 'cookieSecure'   = Cookie will only be set if a secure HTTPS connection exists.
	| 'cookieHTTPOnly' = Cookie will only be accessible via HTTP(S) (no javascript)
	|
	| Note: These settings (with the exception of 'cookie_prefix' and
	|       'cookie_httponly') will also affect sessions.
	|
	*/
	public $cookiePrefix   = '';
	public $cookieDomain   = '';
	public $cookiePath     = '/';
	public $cookieSecure   = false;
	public $cookieHTTPOnly = false;

	/*
	|--------------------------------------------------------------------------
	| Reverse Proxy IPs
	|--------------------------------------------------------------------------
	|
	| If your server is behind a reverse proxy, you must whitelist the proxy
	| IP addresses from which CodeIgniter should trust headers such as
	| HTTP_X_FORWARDED_FOR and HTTP_CLIENT_IP in order to properly identify
	| the visitor's IP address.
	|
	| You can use both an array or a comma-separated list of proxy addresses,
	| as well as specifying whole subnets. Here are a few examples:
	|
	| Comma-separated:	'10.0.1.200,192.168.5.0/24'
	| Array:		array('10.0.1.200', '192.168.5.0/24')
	*/
	public $proxyIPs = '';

	/*
	|--------------------------------------------------------------------------
	| Cross Site Request Forgery
	|--------------------------------------------------------------------------
	| Enables a CSRF cookie token to be set. When set to TRUE, token will be
	| checked on a submitted form. If you are accepting user data, it is strongly
	| recommended CSRF protection be enabled.
	|
	| CSRFTokenName   = The token name
	| CSRFHeaderName  = The header name
	| CSRFCookieName  = The cookie name
	| CSRFExpire      = The number in seconds the token should expire.
	| CSRFRegenerate  = Regenerate token on every submission
	| CSRFRedirect    = Redirect to previous page with error on failure
	*/
	public $CSRFTokenName  = 'csrf_test_name';
	public $CSRFHeaderName = 'X-CSRF-TOKEN';
	public $CSRFCookieName = 'csrf_cookie_name';
	public $CSRFExpire     = 7200;
	public $CSRFRegenerate = true;
	public $CSRFRedirect   = true;

	/*
	|--------------------------------------------------------------------------
	| Content Security Policy
	|--------------------------------------------------------------------------
	| Enables the Response's Content Secure Policy to restrict the sources that
	| can be used for images, scripts, CSS files, audio, video, etc. If enabled,
	| the Response object will populate default values for the policy from the
	| ContentSecurityPolicy.php file. Controllers can always add to those
	| restrictions at run time.
	|
	| For a better understanding of CSP, see these documents:
	|   - http://www.html5rocks.com/en/tutorials/security/content-security-policy/
	|   - http://www.w3.org/TR/CSP/
	*/
	public $CSPEnabled = false;
}
