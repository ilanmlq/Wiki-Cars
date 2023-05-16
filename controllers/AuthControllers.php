<?php

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

        // Input from form
        $name =  filter_input(INPUT_POST, 'name', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $firstName = filter_input(INPUT_POST, 'firstName', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
        $pseudo = filter_input(INPUT_POST, 'pseudo', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $fileTmpName = $_FILES["file"]["tmp_name"];

        // Form error
        $_SESSION['errorRegister'] = NULL;
        $formValid = false;

        if ($action) {
            // Test if form is valid
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
            // Create a new account
            User::register($name, $firstName, $email, $pseudo, $password, $avatar);

            //read the user's email
            $user = User::readUserByEmail($email);

            // Create session with user informations
            //connect the user 
            $_SESSION = [
                'idUser' => $user->idUser,
                'isConnected' => true,
                'email' => $email,
                'avatar' => $user->avatar,
                'pseudo' => $user->pseudo,
                'role' => $user->idRole
            ];
            $_SESSION['validRegister'] = '<li>Inscription reussi</li>';
            header("Location: index.php");
            exit;
        } else {
            include './views/auth/register.php';
        }
        break;

    case 'validLogin':

        $action = filter_input(INPUT_POST, 'action', FILTER_SANITIZE_FULL_SPECIAL_CHARS);

        // Input from form
        $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);

        if ($action) {
            if (User::userIsInactiv($email)) {
                $_SESSION['errorLogin'] = "Votre compte est inactif";
            } else {

                // Test if login is not correct
                if (User::login($email, filter_input(INPUT_POST, 'password')) != 0) {
                    $_SESSION['errorLogin'] = "Les informations de connexion ne sont pas correctes";
                }

                // Test if login is correct
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

        // Session destroy
        User::logout();
        break;

    case 'account':
        // User not connected
        if (!User::isConnected()) {
            header('Location: index.php');
            exit;
        }

        // Input from form
        $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
        $pseudo = filter_input(INPUT_POST, 'pseudo', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $action = filter_input(INPUT_POST, 'action', FILTER_SANITIZE_FULL_SPECIAL_CHARS);

        $user = User::readUserByEmail($email);


        if ($action) {
            if (password_verify(filter_input(INPUT_POST, 'oldPassword'), $user->mdp)) {
                // Test if edit password is valid
                if (strlen(filter_input(INPUT_POST, 'password')) <= 4) {
                    $_SESSION['errorAccount'] = "Le mot de passe doit contenir plus de 4 caractères";
                    header("Location: index.php?url=auth&action=account");
                    exit;
                }

                // Tests before editing password
                if ($email == $_SESSION['email']) {

                    if (filter_input(INPUT_POST, 'password') == filter_input(INPUT_POST, 'confirmPassword')) {
                        User::editAccount($email, $pseudo, filter_input(INPUT_POST, 'password'));
                        $_SESSION['validAccount'] = "Modification réussi";
                        header("Location: index.php?url=auth&action=logout");
                        exit;
                    }
                }
            }
        }
        include './views/auth/account.php';
        break;
}
