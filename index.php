<?php

    session_start();

    require_once 'init.php';

    require_once 'boot.php';

    // available from boot.php
    $contrl = new $controllerName($action);

    $contrl->$action();
