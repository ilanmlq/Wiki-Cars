<?php

/**
 * @author : Ilan Maleq
 * Project: Wiki-Cars
 * Page: index.php
 * Description : Page d'index qui redirige en fonction de l'url
 **/

session_start();

require_once './models/database.php';
require_once './models/user.php';
require_once './models/car.php';

$url = filter_input(INPUT_GET, 'url', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
if ($url == "") {
    header("Location: index.php?url=home&action=home");
    exit;
}
include './views/header.php';

// redirect in tems of url
switch ($url) {
    case 'home':
        require_once('controllers/CarsControllers.php');
        break;

    case 'cars':
        require_once('controllers/CarsControllers.php');
        break;

    case 'auth':
        require_once('controllers/AuthControllers.php');
        break;

    case 'admin':
        require_once('controllers/AdminControllers.php');
        break;

    default:
        header("Location: index.php?url=home&action=home");
        exit;
}
