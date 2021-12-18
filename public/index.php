<?php
/**
 * @author Peter Zajicek
 * Awesome DNS tool for editing DNS records via WebSupport REST API.
 * Developed a small framework around it, so the code is more-less organized.
 */

/**
 * Returns root directory of the application.
 *
 * @param $path
 * @return string
 */
function app_path($path = null)
{
    return sprintf('%s%s%s', dirname(__DIR__), '/', $path);
}

session_start();

// Bootstrap the actual 'framework'
require_once app_path() . "/bootstrap.php";

spl_autoload_register('autoloader');


function autoloader($class)
{
    include(app_path() . '/'. str_replace('\\', '/', $class) . '.php');
}

require_once app_path() . '/router.php';