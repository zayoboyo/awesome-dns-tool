<?php
session_start();
require_once __DIR__ . '/../bootstrap.php';

spl_autoload_register('autoloader');

function autoloader($class)
{
    include('../' . $class . '.php');
}


require_once __DIR__ . '/../router.php';
