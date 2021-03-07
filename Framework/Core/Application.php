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

namespace SimplePHP\Framework\Core;

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
    /**
     * Implements the constructors
     * and autoloads files.
     */
    public function __construct() 
    {

        

        // Stating session.
        session_start();
    }

    /**
     * Require the  Controller
     * 
     * @return Null
     */
    public function init()
    {
        echo (APP_PATH);
    }

    /**
     * Autoload classes
     * 
     * @return Null
     */
    private function _autoload()
    {

    }

    /**
     * Run when Applicati
     */
    public function __destruct()
    {
        session_destroy();
    }

}
  