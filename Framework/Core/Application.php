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

        define('APP_FOLDER', ROOT . 'App' . DS);
        define('CONFIG_FOLDER', APP_FOLDER, 'Config' . DS);
        define('FRAMEWORK_FOLDER', ROOT . 'Framework' . DS);
        define('PUBLIC_FOLDER', APP_FOLDER . 'public' . DS);

        define('CONTROLLER_FOLDER', APP_FOLDER . 'controllers' . DS);
        define('MODEL_FOLDER', APP_FOLDER . 'models' . DS);
        define('VIEW_FOLDER', APP_FOLDER . 'views' . DS);

        define('CORE_FOLDER', FRAMEWORK_FOLDER . 'core' . DS);
        define('DATABASE_FOLDER', FRAMEWORK_FOLDER . 'database' . DS);
        define('LIBS_FOLDER', FRAMEWORK_FOLDER . 'libraries' . DS);
        define('HELPERS_FOLDER', FRAMEWORK_FOLDER . 'helpers' . DS);

        // Autoload classes
        $this->_autoload();

        $this->_init();
        

        // Stating session.
        session_start();
    }

    /**
     * Initialize the routes
     * 
     * @return Null
     */
    private function _init()
    {   
        $urlArray = [];

        if (isset($_SERVER['PATH_INFO'])) {
            $urlString = filter_var($_SERVER['PATH_INFO'],  FILTER_SANITIZE_URL);
            $urlArray = explode('/', $urlString);
        }
    
        $this->_currentController = isset($urlArray[1]) 
                                        ? ucfirst(strtolower($urlArray[1])) 
                                        : "Index";
        $this->_currentAction = $urlArray[2] ?? "index";
        $this->_urlParameters = isset($urlArray[3]) 
                                        ? array_splice($urlArray, 3) 
                                        : [];
    }

    /**
     * Require the  Controller
     * 
     * @return Null
     */
    public function start()
    {   
        echo $this->_currentController;
    }

    /**
     * Autoload classes
     * 
     * @return Null
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
     * Run when Application
     */
    public function __destruct()
    {
        session_destroy();
    }

}
  