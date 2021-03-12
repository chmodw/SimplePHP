<?php 
/**
 * Logger file
 * php version 7.4.2
 *
 * @category Framework_Class
 * @package  SimplePHP
 * @author   Chamodya Wimansha <chamodyawimansha@gmail.com>
 * @license  http://www.gnu.org/copyleft/gpl.html GNU Gene
 * @link     https://github.com/chamodyawimansha/SimplePHP
 */

namespace Framework\Core;

/**
 * Logger Class - Handles errors, logging and redirection.
 * php version 7.4.2
 *
 * @category Framework_Class
 * @package  SimplePHP
 * @author   Chamodya Wimansha <chamodyawimansha@gmail.com>
 * @license  http://www.gnu.org/copyleft/gpl.html GNU Gene
 * @link     https://github.com/chamodyawimansha/SimplePHP
 */

Class Logger
{   
    
    private static $_logFilePath = LOGS . "log_file.log"; 
    private static $_messageTypes =  array('[Info]', '[Warning]', '[Success]');

    /**
     *  Writes the message to a log file
     * 
     * @param String $message - message to log
     * @param Int    $type    - type of the message [info, warning, success,]
     * 
     * @return Null
     */
    public static function log($message = "", $type = 0)
    {
        error_log(
            '['.date("F j, Y, g:i:s a e O").']' .
                (self::$_messageTypes[$type] ?? "[Invalid Type]") . " " . $message . 
                "\n", 
            3, 
            self::$_logFilePath
        );
    }

    /**
     *  Show http error to user
     * 
     * @param Int $code    - HTTP error code to show and redirect.
     * @param Int $message - redirect message.
     * 
     * @return Null
     */
    public static function httpStatus( $code, $message = "")
    {
        // Log the redirect
        self::log("Http Status response - " . $message);

        $statusCode = array(100,101,200,201,202,203,204,205,206,
                            300,301,302,303,304,305,306,307,400,
                            401,402,403,404,405,406,407,408,409,
                            410,411,412,413,414,415,416,417,500,
                            501,502,503,504,505
                        );

        if (in_array($code, $statusCode)) {
            header(
                $_SERVER['SERVER_PROTOCOL'] . " " . $message, true, (int) $code
            );
        }
    }

}
