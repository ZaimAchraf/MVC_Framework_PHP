<?php

    if(!defined('APP_PATH')){
        define('APP_PATH', realpath(__dir__));
    }

    if(!defined('PUBLIC_PATH')){
        define('PUBLIC_PATH', 'C:\xampp\htdocs\mon_projet\public');
    }

    if (!defined('DS')) {
        define('DS', DIRECTORY_SEPARATOR);
    }

    if (!defined('VIEWS_PATH')) {
        define('VIEWS_PATH', APP_PATH . DS . 'views');
    }

    define('DATA_TYPE_BOOL', PDO::PARAM_BOOL);
    define('DATA_TYPE_INT', PDO::PARAM_INT);
    define('DATA_TYPE_STR', PDO::PARAM_STR);
    define('DATA_TYPE_FLOAT', 'float');

    define('FIRSTKEY', 'lhLcgO4pmTuRlHLFSTDxS/kKf2HHzu/yqizXDCpo78c=');
    define('SECONDKEY', 'txY3BS313UNvYooA0DJdROrc2VzCOzSzmdWAY9XF8LWyYEumX97wxK9+z82FUPq65hbtwOpLOLeB3ORI4F08lg==');


?>