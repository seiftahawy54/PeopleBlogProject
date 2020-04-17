<?php
    // Load Config File.
    require_once 'config/config.php';

    // Load Helpers.
    require_once 'helpers/url_helper.php';
    require_once 'helpers/session_helper.php';

    // Auto Loader Core Libraries.
    spl_autoload_register(function($className){
        require 'libraries/' . $className . '.php';
    });