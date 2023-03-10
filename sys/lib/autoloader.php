<?php

spl_autoload_register(function ($path) {

    $path = ltrim($path, '\\');

    $class = '';
    $file = '';
    $namespace = '';

    $separator = strrpos($path, '\\');

    if ($separator > -1) {

        $namespace = substr($path, 0, $separator);
        $class = substr($path, $separator + 1);
        
        $file = str_replace('\\', DIRECTORY_SEPARATOR, $namespace) . DIRECTORY_SEPARATOR;
    }
    $file .= str_replace('\\', DIRECTORY_SEPARATOR, lcfirst($class)) . '.php';
    
    if (file_exists($file)) {

        require_once $file;
    } else {

        echo 'Error: class not found<br>';
    }
});