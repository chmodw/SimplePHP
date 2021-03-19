<?php
/**
 * CSRF class File
 * php version 7.4.2
 *
 * @category Controller_Class
 * @package  SimplePHP
 * @author   Chamodya Wimansha <chamodyawimansha@gmail.com>
 * @license  http://www.gnu.org/copyleft/gpl.html GNU Gene
 * @link     https://github.com/chamodyawimansha/SimplePHP
 */

namespace Framework\Libraries;

/**
 * CSRF Class - Generates and manages one-time token
 * php version 7.4.2
 *
 * @category Library_Class
 * @package  SimplePHP
 * @author   Chamodya Wimansha <chamodyawimansha@gmail.com>
 * @license  http://www.gnu.org/copyleft/gpl.html GNU Gene
 * @link     https://github.com/chamodyawimansha/SimplePHP
 */
class CSRF
{

    /**
     * Creates a new Token
     * 
     * @param $ti - Token Identifier - A key to identify the token
     * 
     * @return string
     */
    public static function new($ti)
    {  
         // generating the hash
        $hash = \md5(mt_rand(1, 100));
        // store the hash in the session
        $_SESSION["csrf_tokens"][$ti] = $hash;
        // returning the hash
        return $hash;
    }

    /**
     * Returns a Token
     * 
     * @param $ti - Token Identifier - A key to identify the token
     * 
     * @return string
     */
    public static function get($ti)
    {

    }

    /**
     * Check the Authenticity of a token
     * 
     * @param $ti - Token Identifier - A key to identify the token
     * 
     * @return bool
     */
    public static function check($ti)
    {

    }

    /**
     * Unset the Token array from session 
     * 
     * @return void
     */
    public static function unset()
    {

    }
}
