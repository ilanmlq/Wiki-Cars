<?php
require_once './models/database.php';
require_once './models/car.php';
require_once './models/admin.php';
require_once './models/user.php';

$action = filter_input(INPUT_GET, 'action', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
if (isset($_SESSION['idUser'])) {
    $idUser = $_SESSION['idUser'];
    $allMyPublicCar = Car::allMyPublicCar($idUser);
    $allMyPrivateCar = Car::allMyPrivateCar($idUser);
    $allMyCars = Car::getAllMyCars($idUser);
}


switch ($action) {

    case 'home':
        $lastCar = Car::getLastCar();
        $allCar = Car::getAllCar();
        include './views/home.php';
        break;

    case 'myCar':
        if (!User::isConnected()) {
            header('Location: index.php');
            exit;
        }
        include './views/car/myCar.php';
        break;

    case 'addCar':

        $fabricationDate = filter_input(INPUT_POST, 'fabricationDate');
        $idCategory = filter_input(INPUT_POST, 'idCategory', FILTER_VALIDATE_INT);
        $modelCar = filter_input(INPUT_POST, 'modelCar', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $brand = filter_input(INPUT_POST, 'brand', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $idMotor = filter_input(INPUT_POST, 'idMotor', FILTER_VALIDATE_INT);
        $idEnergy = filter_input(INPUT_POST, 'idEnergy', FILTER_VALIDATE_INT);
        $idTransmission = filter_input(INPUT_POST, 'idTransmission', FILTER_VALIDATE_INT);
        $idGearBox = filter_input(INPUT_POST, 'idGearBox', FILTER_VALIDATE_INT);
        $weight = filter_input(INPUT_POST, 'weight', FILTER_VALIDATE_INT);
        $nbDoors = filter_input(INPUT_POST, 'nbDoors', FILTER_VALIDATE_INT);
        $nbSeats = filter_input(INPUT_POST, 'nbSeats', FILTER_VALIDATE_INT);
        $imgTmpName = $_FILES["image"]["tmp_name"];
        $comment = filter_input(INPUT_POST, 'comment', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $technicalDocumentTmpName = $_FILES["technicalDocument"]["tmp_name"];
        $idVisibility = filter_input(INPUT_POST, 'idVisibility', FILTER_VALIDATE_INT);

        $_SESSION['errorAddCar'] = NULL;
        $formValid = false;

        if ($fabricationDate == "") {
            $_SESSION["errorAddCar"] .= "<p>La date de fabrication ne peut pas être vide</p>";
        }
        if ($idCategory == "") {
            $_SESSION["errorAddCar"] .= "<p>La categorie ne peut pas être vide</p>";
        }
        if ($modelCar == "") {
            $_SESSION["errorAddCar"] .= "<p>Le modèle ne peut pas être vide</p>";
        }
        if ($brand == "") {
            $_SESSION["errorAddCar"] .= "<p>La marque ne peut pas être vide</p>";
        }
        if ($idMotor == "") {
            $_SESSION["errorAddCar"] .= "<p>Le moteur ne peut pas être vide</p>";
        }
        if ($idEnergy == "") {
            $_SESSION["errorAddCar"] .= "<p>Le type d'energie ne peut pas être vide</p>";
        }
        if ($idTransmission == "") {
            $_SESSION["errorAddCar"] .= "<p>La transmission ne peut pas être vide</p>";
        }
        if ($idGearBox == "") {
            $_SESSION["errorAddCar"] .= "<p>La boîte de vitesse ne peut pas être vide</p>";
        }
        if ($weight == "") {
            $_SESSION["errorAddCar"] .= "<p>Le poids ne peut pas être vide</p>";
        }
        if ($nbDoors == "") {
            $_SESSION["errorAddCar"] .= "<p>Le nombre de portes ne peut pas être vide</p>";
        }
        if ($nbSeats == "") {
            $_SESSION["errorAddCar"] .= "<p>Le nombre de sièges ne peut pas être vide</p>";
        }

        if ($imgTmpName != "") {
            $allowedMimeTypes = array("image/png", "image/jpeg", "image/jpg");
            $fileMimeType = mime_content_type($imgTmpName);
            if (!in_array($fileMimeType, $allowedMimeTypes)) {
                $_SESSION['errorAddCar'] .= '<li>Erreur dans le format du fichier</li>';
            } else {
                $temp = explode(".", $_FILES["image"]["name"]);
                $extension = end($temp);
                $nameCar = uniqid() . "." . $extension;
                $destinationPath = __DIR__ . '/../views/upload/car/' . $nameCar;
                move_uploaded_file($imgTmpName, $destinationPath);
                $imageCar = "/car/" . $nameCar;
            }
        } else {
            $_SESSION['errorAddCar'] .= '<p>Erreur dans l\'image</p>';
        }
        if ($technicalDocumentTmpName != "") {
            $allowedMimeTypes = array("application/pdf");
            $fileMimeType = mime_content_type($technicalDocumentTmpName);
            if (!in_array($fileMimeType, $allowedMimeTypes)) {
                $_SESSION['errorAddCar'] .= '<p>Erreur dans le format du fichier</p>';
            } else {
                $temp = explode(".", $_FILES["technicalDocument"]["name"]);
                $extension = end($temp);
                $nameTechnicalDocument = uniqid() . "." . $extension;
                $destinationPath = __DIR__ . '/../views/upload/document/' . $nameTechnicalDocument;
                move_uploaded_file($technicalDocumentTmpName, $destinationPath);
                $technicalDocument = "/document/" . $nameTechnicalDocument;
            }
        } else {
            $_SESSION['errorAddCar'] .= '<p>Erreur fichier</p>';
        }

        if ($comment == "") {
            $_SESSION["errorAddCar"] .= "<p>Le commentaire ne peut pas être vide</p>";
        }
        if ($idVisibility == "") {
            $_SESSION["errorAddCar"] .= "<p>La visibilité ne peut pas être vide</p>";
        }

        if ($_SESSION['errorAddCar'] == NULL) {
            $formValid = true;
        }

        if ($formValid) {

            Car::addCar($idUser, $fabricationDate, $idCategory, $modelCar, $brand, $idMotor, $idEnergy, $idTransmission, $idGearBox, $weight, $nbDoors, $nbSeats, $imageCar, $comment, $technicalDocument, $idVisibility);

            header("Location: index.php?url=cars&action=myCar");
            exit;
        }
        include './views/car/myCar.php';
        break;

    case 'modifyPublic':

        $private = filter_input(INPUT_POST, 'private', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $modify = filter_input(INPUT_POST, 'modify', FILTER_SANITIZE_FULL_SPECIAL_CHARS);

        if ($private != NULL) {
            car::putPrivateCar($private);
            $_SESSION['modifyPublic'] = "La fiche a été mis en privée";
            header("Location: index.php?url=cars&action=myCar");
            exit;
        }

        if ($modify != NULL) {
            header("Location: index.php?url=cars&action=modifyCar&idCar=$modify");
            exit;
        }

        include './views/car/myCar.php';
        break;

    case 'modifyCar':
        if (!User::isConnected()) {
            header('Location: index.php');
            exit;
        }
        $idCar = filter_input(INPUT_GET, 'idCar', FILTER_VALIDATE_INT);
        $selectedCar = Car::selectedCar($idCar);

        $action = filter_input(INPUT_POST, 'action', FILTER_SANITIZE_FULL_SPECIAL_CHARS);

        $brand = filter_input(INPUT_POST, 'brand', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $modelCar = filter_input(INPUT_POST, 'modelCar', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $fabricationDate = filter_input(INPUT_POST, 'fabricationDate', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $idCategory = filter_input(INPUT_POST, 'idCategory', FILTER_VALIDATE_INT);
        $idMotor = filter_input(INPUT_POST, 'idMotor', FILTER_VALIDATE_INT);
        $idEnergy = filter_input(INPUT_POST, 'idEnergy', FILTER_VALIDATE_INT);
        $idTransmission = filter_input(INPUT_POST, 'idTransmission', FILTER_VALIDATE_INT);
        $idGearBox = filter_input(INPUT_POST, 'idGearBox', FILTER_VALIDATE_INT);
        $weight = filter_input(INPUT_POST, 'weight', FILTER_VALIDATE_INT);
        $nbDoors = filter_input(INPUT_POST, 'nbDoors', FILTER_VALIDATE_INT);
        $nbSeats = filter_input(INPUT_POST, 'nbSeats', FILTER_VALIDATE_INT);
        $comment = filter_input(INPUT_POST, 'comment', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $idVisibility = filter_input(INPUT_POST, 'idVisibility', FILTER_VALIDATE_INT);

        $_SESSION['errorModifyCar'] = NULL;
        $formValid = false;

        if ($action) {
            if ($brand == "") {
                $_SESSION["errorModifyCar"] .= "<p>La marque ne peut pas être vide</p>";
            }
            if ($modelCar == "") {
                $_SESSION["errorModifyCar"] .= "<p>Le modèle ne peut pas être vide</p>";
            }
            if ($fabricationDate == "") {
                $_SESSION["errorModifyCar"] .= "<p>La de fabrication ne peut pas être vide</p>";
            }
            if ($idCategory == "") {
                $_SESSION["errorModifyCar"] .= "<p>La categorie ne peut pas être vide</p>";
            }
            if ($idMotor == "") {
                $_SESSION["errorModifyCar"] .= "<p>Le moteur ne peut pas être vide</p>";
            }
            if ($idEnergy == "") {
                $_SESSION["errorModifyCar"] .= "<p>Le type d'energie ne peut pas être vide</p>";
            }
            if ($idTransmission == "") {
                $_SESSION["errorModifyCar"] .= "<p>La transmission ne peut pas être vide</p>";
            }
            if ($idGearBox == "") {
                $_SESSION["errorModifyCar"] .= "<p>La boîte de vitesse ne peut pas être vide</p>";
            }
            if ($weight == "") {
                $_SESSION["errorModifyCar"] .= "<p>Le poids ne peut pas être vide</p>";
            }
            if ($nbDoors == "") {
                $_SESSION["errorModifyCar"] .= "<p>Le nombre de portes ne peut pas être vide</p>";
            }
            if ($nbSeats == "") {
                $_SESSION["errorModifyCar"] .= "<p>Le nombre de sièges ne peut pas être vide</p>";
            }
            if ($comment == "") {
                $_SESSION["errorModifyCar"] .= "<p>Le commentaire ne peut pas être vide</p>";
            }
            if ($idVisibility == "") {
                $_SESSION["errorModifyCar"] .= "<p>La visibilité ne peut pas être vide</p>";
            }

            if (Car::verifyOwnCar($idCar, $_SESSION['idUser']) == false) {
                $_SESSION["errorModifyCar"] .= "<p>Vous ne pouvez pas modifier cette fiche</p>";
            }

            if ($_SESSION['errorModifyCar'] == NULL) {
                $formValid = true;
            }
        }
        if ($formValid) {
            Car::modifyCar($idCar, $fabricationDate, $idCategory, $modelCar, $brand, $idMotor, $idEnergy, $idTransmission, $idGearBox, $weight, $nbDoors, $nbSeats, $comment, $idVisibility);
            $_SESSION['validateModifyCar'] = "La fiche à bien été modifier";
            header("Location: index.php?url=cars&action=myCar");
            exit;
        }
        include './views/car/modifyCar.php';
        break;

    case 'modifyPrivate':

        $public = filter_input(INPUT_POST, 'public', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $modify = filter_input(INPUT_POST, 'modify', FILTER_SANITIZE_FULL_SPECIAL_CHARS);

        if ($public != NULL) {
            Car::modifyPrivate($public);
            $_SESSION['modifyPrivate'] = "La fiche a été mis en publique";
            header("Location: index.php?url=cars&action=myCar");
            exit;
        }

        if ($modify != NULL) {
            header("Location: index.php?url=cars&action=modifyCar&idCar=$modify");
            exit;
        }
        include './views/car/myCar.php';
        break;

    case 'carDetail':
        $idCar = filter_input(INPUT_GET, 'idCar', FILTER_VALIDATE_INT);
        $carDetail = Car::carDetail($idCar);
        include './views/car/carDetail.php';
        break;

    case 'addFavoriteCar':
        $idCar = filter_input(INPUT_GET, 'idCar', FILTER_VALIDATE_INT);
        $idUser = $_SESSION['idUser'];
        $carFavorite = Car::addFavoriteCar($idCar, $idUser);
        $_SESSION['addFavoriteCar'] = "La voiture a bien été ajouté aux favoris";
        header("Location: index.php?url=home&action=home");
        break;

    case 'favoriteCar':
        $allFavoriteCar = Car::allFavoriteCar($idUser);
        $idUser = $_SESSION['idUser'];
        include './views/car/favoriteCar.php';
        break;

    case 'deleteFavoriteCar':
        $idCar = filter_input(INPUT_GET, 'idCar', FILTER_VALIDATE_INT);
        $idUser = $_SESSION['idUser'];
        $deleteFavoriteCar = Car::deleteFavoriteCar($idUser, $idCar);
        $_SESSION['deleteFavoriteCar'] = "La voiture a bien été supprimer des favoris";
        header("Location: index.php?url=home&action=favoriteCar");
        break;

    case 'duplicateCar':
        $idCar = filter_input(INPUT_GET, 'idCar', FILTER_VALIDATE_INT);
        $idUser = $_SESSION['idUser'];
        Car::duplicateCar($idUser, $idCar);
        $_SESSION['duplicateCar'] = "La voiture a bien été dupliquer";
        header("Location: index.php?url=cars&action=myCar");
        break;

    case 'searchCars':
        $brand = filter_input(INPUT_GET, 'brand', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $model = filter_input(INPUT_GET, 'model', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $idcategory = filter_input(INPUT_GET, 'category', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $idmotorisation = filter_input(INPUT_GET, 'motorisation', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $idtransmission = filter_input(INPUT_GET, 'transmission', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $minYear = filter_input(INPUT_GET, 'minYear', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $maxYear = filter_input(INPUT_GET, 'maxYear', FILTER_SANITIZE_FULL_SPECIAL_CHARS);

        $lastCar = Car::getLastCar();
        $allCar = Car::getAllCar();
        $searchCar = Car::searchCars($brand, $model, $idcategory, $idmotorisation, $idtransmission, $minYear, $maxYear);
        include './views/home.php';
        break;
}
