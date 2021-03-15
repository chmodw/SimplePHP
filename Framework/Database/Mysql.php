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
    
    private $_conn = null;
    private $_stmt = "";
    private $_lastId; // Delete this later if this not working

    /**
     * Initialize the mysqli connection when object is created
     * 
     * @param String $host     = name of the database host .eg 'localhost'.
     * @param String $username = name of the database user.
     * @param String $password = database user's password.
     * @param String $db_name  = name of the database.
     * 
     * @return void
     */
    public function __construct(
        String $host, String $username, String $password, String $db_name
    ) {
        // connect
        $this->_conn = new mysqli($host, $username, $password, $db_name);

        // check connection for errors
        if ($this->_conn->connect_errno) {
  
            \Framework\Core\Logger::log(
                'Failed to connect to MySQL: ' . $this->_conn->connect_error, 
                1
            );
            \Framework\Core\Logger::httpStatus(500, " 500 Internal Server Error");
        }
    }

    /**
     * Prepare the query and certain queries bind data
     * 
     * @param String $query - Query string
     * @param String $types - characters which specify the types of the bind 
     *                      variables
     *                      [i = integer, d = double, s = string, b = blob]
     * @param Array  $data  - data to bind
     * 
     * @return void
     */
    public function query(String $query, String $types = "", Array $data = [])
    {
        $this->_stmt = $this->_conn->prepare($query);

        if (strpos($query, "?") && !empty($data) && $types != "") {
            $this->_stmt->bind_params($types, ...$data);
        }
    }

    /**
     * Executes the query 
     * 
     * @return bool
     */
    public function execute()
    {
        $res = $this->_stmt->execute();
        // stores insert id only on create or update queries
        $this->_lastId = $this->_stmt->insert_id;

        return $res;
    }

    /**
     * Returns a single result
     * 
     * @return Array
     */
    public function getOne()
    {
        if ($this->execute()) {

            return $this->_stmt->fetch_row();

        } else {
            return null;
        }
    }

    /**
     * Returns more than one result set a assoc array
     * 
     * @return Assoc_array
     */
    public function getMany()
    {
        if ($this->execute()) {

            return $this->_stmt->fetch_all(MYSQLI_ASSOC);

        } else {
            return null;
        }
    }

    /**
     * Returns the row Count
     * 
     * @return int
     */
    public function getRowCount()
    {
        if ($this->execute()) {

            return $this->_stmt->num_rows;

        } else {
            return null;
        }
    }

    /**
     * Returns the id from the last query 
     * 
     * @return int
     */
    public function getLastId()
    {
        return $this->_lastId;
    }

    /**
     * Returns the mysqli object for more functionalities
     * 
     * @return mysqli
     */
    public function getConnection()
    {
        return $this->_conn;
    }

    /**
     * Run when Application is closing
     */
    public function __destruct()
    {
        $this->_stmt->free_result();
        $this->_conn->close();
    }
}