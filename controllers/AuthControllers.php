<?php

/**
 * @author : Ilan Maleq
 * Project: Wiki-Cars
 * Page: AuthControllers.php
 * Description : Page qui reçoit des actions et récupère des données de l'authentification et en fonctions redirige elle aussi sur les pages convenue et transmet les données.
 */

require_once './models/database.php';
require_once './models/car.php';
require_once './models/admin.php';
require_once './models/user.php';

$action = filter_input(INPUT_GET, 'action', FILTER_SANITIZE_FULL_SPECIAL_CHARS);

switch ($action) {

    case 'login':
        include './views/auth/login.php';
        break;

    case 'register':
        include './views/auth/register.php';
        break;

    case 'validRegister':

        $action = filter_input(INPUT_POST, 'action', FILTER_SANITIZE_FULL_SPECIAL_CHARS);

        $name =  filter_input(INPUT_POST, 'name', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $firstName = filter_input(INPUT_POST, 'firstName', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
        $pseudo = filter_input(INPUT_POST, 'pseudo', FILTER_SANITIZE_FULL_SPECIAL_CHARS);

        $fileTmpName = $_FILES["file"]["tmp_name"];


        $_SESSION['errorRegister'] = NULL;
        $formValid = false;

        if ($action) {
            if (User::emailAlreadyExist($email)) {
                $_SESSION['errorRegister'] .= '<p>Email existe déjà</p>';
            }
            if (User::pseudoAlreadyExist($pseudo)) {
                $_SESSION['errorRegister'] .= '<p>Pseudo existe déjà</p>';
            }
            if ($email == '') {
                $_SESSION['errorRegister'] .= '<p>Email requis</p>';
            }
            if (strlen($name) < 3) {
                $_SESSION['errorRegister']  .= '<p>Nom trop court</p>';
            }
            if (strlen($firstName) < 3) {
                $_SESSION['errorRegister'] .= '<p>Pénom trop court</p>';
            }

            if (strlen(filter_input(INPUT_POST, 'password')) <= 4) {
                $_SESSION['errorRegister'] .= '<p>Mot de passe trop court</p>';
            }
            if (filter_input(INPUT_POST, 'password') != filter_input(INPUT_POST, 'confirmPassword')) {
                $_SESSION['errorRegister'] .= '<p>Erreur confirmation du mot de passe</p>';
            }

            if ($fileTmpName != "") {
                $allowedMimeTypes = array("image/png", "image/jpeg", "image/jpg");
                $fileMimeType = mime_content_type($fileTmpName);
                if (!in_array($fileMimeType, $allowedMimeTypes)) {
                    $_SESSION['errorRegister'] .= '<p>Erreur dans le format du fichier</p>';
                } else {
                    $temp = explode(".", $_FILES["file"]["name"]);
                    $extension = end($temp);
                    $nameAvatar = uniqid() . "." . $extension;
                    $destinationPath = __DIR__ . '/../views/upload/avatar/' . $nameAvatar;
                    move_uploaded_file($fileTmpName, $destinationPath);
                    $avatar = "/avatar/" . $nameAvatar;
                }
            } else {
                $_SESSION['errorRegister'] .= '<p>Erreur fichier</p>';
            }
        }
        if ($_SESSION['errorRegister'] == NULL) {
            $formValid = true;
        }

        if ($formValid) {
            User::register($name, $firstName, $email, $pseudo, filter_input(INPUT_POST, 'password'), $avatar);

            $user = User::readUserByEmail($email);

            $_SESSION = [
                'idUser' => $user->idUser,
                'isConnected' => true,
                'email' => $email,
                'avatar' => $user->avatar,
                'pseudo' => $user->pseudo,
                'role' => $user->idRole
            ];
            $_SESSION['validRegister'] = '<p>Inscription reussi</p>';
            header("Location: index.php");
            exit;
        } else {
            include './views/auth/register.php';
        }
        break;

    case 'validLogin':

        $action = filter_input(INPUT_POST, 'action', FILTER_SANITIZE_FULL_SPECIAL_CHARS);

        $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);

        if ($action) {
            if (User::userIsInactiv($email)) {
                $_SESSION['errorLogin'] = "Votre compte est inactif";
            } else {

                if (User::login($email, filter_input(INPUT_POST, 'password')) != 0) {
                    $_SESSION['errorLogin'] = "Les informations de connexion ne sont pas correctes";
                }

                if (User::login($email, filter_input(INPUT_POST, 'password')) == 0) {
                    $_SESSION['errorLogin'] = NULL;
                    $_SESSION['validLogin'] = "<strong>Connexion réussi</strong> Vous êtes maintenant connecté";
                    header('Location: index.php');
                    exit;
                }
            }
        }
        include './views/auth/login.php';
        break;

    case 'logout':

        User::logout();
        break;

    case 'account':
        if (!User::isConnected()) {
            header('Location: index.php');
            exit;
        }

        $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
        $pseudo = filter_input(INPUT_POST, 'pseudo', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $action = filter_input(INPUT_POST, 'action', FILTER_SANITIZE_FULL_SPECIAL_CHARS);

        if ($action) {
            $user = User::readUserByEmail($email);
            if (password_verify(filter_input(INPUT_POST, 'oldPassword'), $user->mdp)) {

                if (strlen(filter_input(INPUT_POST, 'password')) <= 4) {
                    $_SESSION['errorAccount'] = "<p>Le mot de passe doit contenir plus de 4 caractères</p>";
                    header("Location: index.php?url=auth&action=account");
                    exit;
                }

                if ($email == $_SESSION['email']) {

                    if (filter_input(INPUT_POST, 'password') == filter_input(INPUT_POST, 'confirmPassword')) {
                        User::editAccount($email, $pseudo, filter_input(INPUT_POST, 'password'));
                        header("Location: index.php?url=auth&action=logout");
                        exit;
                    }
                    else {
                        $_SESSION['errorAccount'] = "<p>Erreur confirmation du mot de passe</p>";
                    }
                }
            } else{
                $_SESSION['errorAccount'] = "<p>Ancien mot de passe incorrect</p>";
            }
        }
        include './views/auth/account.php';
        break;
}
