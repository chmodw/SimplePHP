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
            
            if (\class_exists($model)) {          
                return new $model;
            }
        }
        // Log the error
        \error_log($model . " - model Not Found");
        // send error to the user
        \header(
            $_SERVER['SERVER_PROTOCOL'] . ' 500 Internal Server Error', true, 500
        );
        die("");
    }

    /**
     * View a Model class
     * 
     * @param String $view - name of the View Class
     * 
     * @return View
     */
    public function view(String $view) 
    {
        if (\file_exists(VIEW_FOLDER . $view. ".php")) {

            $view = "\App\Views\\" . $view;
            
            if (\class_exists($view)) {          
                return new $view;
            }
        }
        // Log the error
        \error_log($view . " - view Not Found");
        // send error to the user
        \header(
            $_SERVER['SERVER_PROTOCOL'] . ' 500 Internal Server Error', true, 500
        );
        die("");
    }

    /**
     * Loads library classes
     * 
     * @param Array $classes - Accepts array of library class names to implement.
     * 
     * @return Array assoc array of library objects [$class_name => new Object]
     */
    public function libraries(Array $classes) 
    {
        $libs = [];

        foreach ($classes as $class) {

            $className = ucfirst(strtolower($class));

            if (\file_exists(LIBS_FOLDER . $className. ".php")) {

                $classWithNamespace = '\Framework\Libs\\' . $className;
            
                if (\class_exists($classWithNamespace)) {
                    $libs[$class] = new $classWithNamespace;
                } else {
                    // if file not found in the library folder log the error
                    \error_log($class . "- Library file missing");
                }
            }
        }

        return $libs;

    }

    /**
     * Loads helper functions
     * 
     * @param Array $helpers - Accepts array of helper file names.
     * 
     * @return Array assoc array of helper functions
     */
    public function helpers(Array $helpers) 
    {
        $funcs = [];

        foreach ($helpers as $func) {

            $file = strtolower($func);

            if (\file_exists(HELPERS_FOLDER . $file. '.php')) {
                
                $funcs[$func] = include HELPER_FOLDER . $file . ".php"; 
            } else {
                // if function not found in the functions folder log the error
                \error_log($class . ' Library file missing');
            }
        }

        return $funcs;
    }

    
}