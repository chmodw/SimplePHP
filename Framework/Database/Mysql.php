<?php 
/**
 * Mysql database connector
 * php version 7.4.2
 *
 * @category Database_Class
 * @package  SimplePHP
 * @author   Chamodya Wimansha <chamodyawimansha@gmail.com>
 * @license  http://www.gnu.org/copyleft/gpl.html GNU Gene
 * @link     https://github.com/chamodyawimansha/SimplePHP
 */

namespace Framework\Database;

/**
 * Mysql Class - Database connector class for mysql databases
 * php version 7.4.2
 *
 * @category Database_Class
 * @package  SimplePHP
 * @author   Chamodya Wimansha <chamodyawimansha@gmail.com>
 * @license  http://www.gnu.org/copyleft/gpl.html GNU Gene
 * @link     https://github.com/chamodyawimansha/SimplePHP
 */
class Mysql
{
    
    private val $_conn;

    /**
     * Initialize the mysqli connection when object is created
     * 
     * @param String $host     = name of the database host .eg 'localhost'.
     * @param String $username = name of the database user.
     * @param String $password = database user's password.
     * @param String $db_name  = name of the database.
     * 
     * @return Null
     */
    public function __construct(
        String $host, String $username, String $password, String $db_name
    ) {
        // connect
        $this->_conn = new mysqli($host, $username, $password, $db_name);

        // check connection for errors
        if ($this->_conn->connect_errno) {
            // Log the error
            \error_log('Failed to connect to MySQL: ' . $this->_conn->connect_error);
            // send error to the user
            \header(
                $_SERVER['SERVER_PROTOCOL'] . 
                ' 500 Internal Server Error', 
                true, 
                500
            );
            die("");
        }
    }
}