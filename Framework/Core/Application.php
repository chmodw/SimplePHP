<?php
/**
 * Application File
 * php version 7.4.2
 *
 * @category Core_Class
 * @package  SimplePHP
 * @author   Chamodya Wimansha <chamodyawimansha@gmail.com>
 * @license  http://www.gnu.org/copyleft/gpl.html GNU Gene
 * @link     https://github.com/chamodyawimansha/SimplePHP
 */

namespace Framework\Core;

/**
 * Application Class - Initiates the application
 * php version 7.4.2
 *
 * @category Core_Class
 * @package  SimplePHP
 * @author   Chamodya Wimansha <chamodyawimansha@gmail.com>
 * @license  http://www.gnu.org/copyleft/gpl.html GNU Gene
 * @link     https://github.com/chamodyawimansha/SimplePHP
 */
class Application
{

    private String $_currentController;
    private String $_currentAction;
    private Array $_urlParameters;

    /**
     * Implements the constructors
     * and autoload files.
     */
    public function __construct() 
    {
        // Defining folder paths
        define('DS', DIRECTORY_SEPARATOR);
        define('ROOT', getcwd(). DS); // '/var/www/website_folder/'
        define('LOGS', ROOT . "logs" .  DS);

        define('APP_FOLDER', ROOT . 'App' . DS);
        define('CONFIG_FOLDER', APP_FOLDER, 'Config' . DS);
        define('FRAMEWORK_FOLDER', ROOT . 'Framework' . DS);
        define('PUBLIC_FOLDER', APP_FOLDER . 'public' . DS);

        define('CONTROLLER_FOLDER', APP_FOLDER . 'Controllers' . DS);
        define('MODEL_FOLDER', APP_FOLDER . 'Models' . DS);
        define('VIEW_FOLDER', APP_FOLDER . 'Views' . DS);
        define('TEMPLATE_FOLDER', APP_FOLDER . 'Templates' . DS);
        
        define('CORE_FOLDER', FRAMEWORK_FOLDER . 'Core' . DS);
        define('DATABASE_FOLDER', FRAMEWORK_FOLDER . 'Database' . DS);
        define('LIBS_FOLDER', FRAMEWORK_FOLDER . 'Libraries' . DS);
        define('HELPERS_FOLDER', FRAMEWORK_FOLDER . 'Helpers' . DS);

        // Autoload classes
        $this->_autoload();

        $this->_router();
        

        // Stating session.
        session_start();
    }

    /**
     * Initialize the routes
     * 
     * @return void
     */
    private function _router()
    {   
        $urlArray = [];

        if (isset($_SERVER['PATH_INFO'])) {
            $urlString = filter_var($_SERVER['PATH_INFO'],  FILTER_SANITIZE_URL);
            $urlArray = explode('/', $urlString);
        }
    
        $this->_currentController = isset($urlArray[1]) 
                                        ? ucfirst(strtolower($urlArray[1])) 
                                        : "Index"
                                    ;
        $this->_currentAction = $urlArray[2] ?? "index";
        $this->_urlParameters = isset($urlArray[3]) 
                                        ? array_splice($urlArray, 3) 
                                        : [];
    }

    /**
     * Require the  Controller
     * 
     * @return void
     */
    public function init()
    {   
        $controller = "\App\Controllers\\" . $this->_currentController;

        if (\file_exists(CONTROLLER_FOLDER . $this->_currentController . ".php")) {
            
            if (class_exists($controller)) {
                $controllerObj = new $controller;
                $action = $this->_currentAction;

                // check if the action is callable
                if (\is_callable(array($controllerObj, $action))) {
                    return $controllerObj->$action($this->_urlParameters);
                }
            }
        }

        \Framework\Core\Logger::httpStatus(404, "404 Not Found");
        die();
    }

    /**
     * Autoload classes
     * 
     * @return void
     */
    private function _autoload()
    {
        spl_autoload_register(
            function ($className) {
                include str_replace('\\', '/', $className) . '.php';
            }
        );
    }

    /**
     * Loading the config file
     * 
     * @return void
     */
    private function _loadConfigs()
    {

    }

    /**
     * Run when Application is closing
     * 
     * @return void
     */
    public function __destruct()
    {
        session_destroy();
    }

}
  