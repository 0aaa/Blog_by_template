<?php

session_start();

require_once 'sys/lib/autoloader.php';

(new \sys\lib\Router)->run();