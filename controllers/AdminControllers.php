<?php
if ($_SESSION['role'] != 1) {
    header("Location: index.php?url=home&action=home");
    exit;
}

require_once './models/database.php';
require_once './models/car.php';
require_once './models/admin.php';
require_once './models/user.php';

$action = filter_input(INPUT_GET, 'action', FILTER_SANITIZE_FULL_SPECIAL_CHARS);


$allUsers = User::findAll();
$inactivUsers = Admin::getInactivUsers();
$allCars = Car::findAllCar();
$allCarsPrivate = Car::findAllCarPrivate();

switch ($action) {
    case 'admin':

        include './views/administration.php';
        break;

    case 'adminUserInactiv':

        $inactiv = filter_input(INPUT_POST, 'inactiv', FILTER_SANITIZE_FULL_SPECIAL_CHARS);

        //button pressed -> ban the user
        if ($inactiv != NULL) {
            Admin::setInactivUser($inactiv);
            $_SESSION['adminUserInactiv'] = "<strong>Utilisateur Inactif</strong> L'utilisateur sélectionné a été correctement desactiver";
            header("Location: index.php?url=admin&action=admin");
            exit;
        }

        include './views/administration.php';
        break;

    case 'adminUserActiv':

        $activ = filter_input(INPUT_POST, 'activ', FILTER_SANITIZE_FULL_SPECIAL_CHARS);

        //button pressed -> deban the user
        if ($activ != NULL) {
            $_SESSION['adminUserActiv'] = "<strong>Utilisateur Activer</strong> L'utilisateur sélectionné a été correctement activer";
            Admin::setActivUser($activ);
            header("Location: index.php?url=admin&action=admin");
            exit;
        }
    case 'modifyPrivateAdmin':

        $private = filter_input(INPUT_POST, 'private', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $modify = filter_input(INPUT_POST, 'modify', FILTER_SANITIZE_FULL_SPECIAL_CHARS);

        if ($private != NULL) {           
            car::modifyPrivateAdmin($private);
            $_SESSION['modifyPrivateAdmin'] = "La fiche a été mis en privé";
            header("Location: index.php?url=admin&action=admin");
            exit;
        }
        if($modify != NULL){
            header("Location: index.php?url=cars&action=modifyCar&idCar=$modify");
            exit;
        }
        include './views/administration.php';
        break;

    case 'modifyPublicAdmin':

        $public = filter_input(INPUT_POST, 'public', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $modify = filter_input(INPUT_POST, 'modify', FILTER_SANITIZE_FULL_SPECIAL_CHARS);

        if ($public != NULL) {
            Car::modifyPublicAdmin($public);
            $_SESSION['modifyPublicAdmin'] = "La fiche a été mis en publique";
            header("Location: index.php?url=admin&action=admin");
            exit;
        }

        if ($modify != NULL) {
            header("Location: index.php?url=cars&action=modifyCar&idCar=$modify");
            exit;
        }
        include './views/administration.php';
        break;
}
