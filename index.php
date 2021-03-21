<?php
/**
 * Entry file to the application
 * php version 7.4.2
 *
 * @category File
 * @package  SimplePHP
 * @author   Chamodya Wimansha <chamodyawimansha@gmail.com>
 * @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link     https://github.com/chamodyawimansha/SimplePHP
 */

require __DIR__ . '/vendor/autoload.php';

$app = new Framework\Core\Application();

 $app->init();
 