<?php 
/**
 * Index File
 * php version 7.4.2
 *
 * @category Controller_Class
 * @package  SimplePHP
 * @author   Chamodya Wimansha <chamodyawimansha@gmail.com>
 * @license  http://www.gnu.org/copyleft/gpl.html GNU Gene
 * @link     https://github.com/chamodyawimansha/SimplePHP
 */

namespace App\Controllers;

use \Framework\Core\Controller as Controller;

/**
 * Controller Class - Index controller class
 * php version 7.4.2
 *
 * @category Controller_Class
 * @package  SimplePHP
 * @author   Chamodya Wimansha <chamodyawimansha@gmail.com>
 * @license  http://www.gnu.org/copyleft/gpl.html GNU Gene
 * @link     https://github.com/chamodyawimansha/SimplePHP
 */
class Index extends Controller
{
    /**
     * Index function
     * 
     * @return void
     */
    public function index()
    {
        echo "Hello! world";
    }
}