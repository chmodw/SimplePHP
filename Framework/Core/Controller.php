<?php
/**
 * Parent controller file
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
 * Controller Class - Parent class of the Controller classes
 * php version 7.4.2
 *
 * @category Core_Class
 * @package  SimplePHP
 * @author   Chamodya Wimansha <chamodyawimansha@gmail.com>
 * @license  http://www.gnu.org/copyleft/gpl.html GNU Gene
 * @link     https://github.com/chamodyawimansha/SimplePHP
 */
class Controller
{
    /**
     * Returns a Model class
     * 
     * @param String $model - name of the Model class
     * 
     * @return Model
     */
    public function model(String $model) 
    {
        if (\file_exists(MODEL_FOLDER . $model. ".php")) {
            
            $model = "\App\Models\\" . $model;
            return new $model;
        }

        // Log the error
        \error_log($model . " - model Not Found");
        // send error to the user
        \header(
            $_SERVER['SERVER_PROTOCOL'] . ' 500 Internal Server Error', true, 500
        );
        die("");
    }

    // load a view
    // load a library
    // load a helper

}