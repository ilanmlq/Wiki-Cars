<?php

/**
 * @author : Ilan Maleq
 * Project: Wiki-Cars
 * Page: index.php
 * Description : Page ayant toutes les fonctions concernant les utilisateurs et l'authentication
 **/

require_once './models/database.php';

class User
{
    /**
     * Get all user from user
     *
     * @return array
     */
    public static function findAll(): array
    {
        $query = "SELECT * FROM user WHERE idStatus = 1";

        $req = MonPdo::getInstance()->prepare($query);
        $req->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, 'User');
        $req->execute();
        $users = $req->fetchAll();
        return $users;
    }

    /**
     * Get all user by email
     *
     * @param string $email
     * @return mixed
     */
    public static function readUserByEmail(string $email): mixed
    {
        $query = 'SELECT * FROM user WHERE email = :email';

        $req = MonPdo::getInstance()->prepare($query);
        $req->setFetchMode(PDO::FETCH_OBJ);
        $req->bindParam(':email', $email);
        $req->execute();
        return $req->fetch();
    }

    /**
     * Get all user by pseudo
     *
     * @param string $pseudo
     * @return mixed
     */
    public static function readUserByPseudo(string $pseudo): mixed
    {
        $query = 'SELECT * FROM user WHERE pseudo = :pseudo';

        $req = MonPdo::getInstance()->prepare($query);
        $req->setFetchMode(PDO::FETCH_OBJ);
        $req->bindParam(':pseudo', $pseudo);
        $req->execute();
        return $req->fetch();
    }

    /**
     * Connect a user with session
     *
     * @param string $email
     * @param string $password
     * @return void
     */
    public static function login(string $email, string $password)
    {
        $user = User::readUserByEmail($email);

        if ($user && property_exists($user, 'email')) {
            if ($email == $user->email) {
                if (password_verify($password, $user->mdp)) {
                    $_SESSION = [
                        'idUser' => $user->idUser,
                        'isConnected' => true,
                        'email' => $email,
                        'avatar' => $user->avatar,
                        'pseudo' => $user->pseudo,
                        'role' => $user->idRole
                    ];
                    return 0;
                }
            }
        }

        return 1;
    }


    /**
     * Check if the user is connected
     *
     * @return boolean
     */
    public static function isConnected(): bool
    {
        if (isset($_SESSION['isConnected'])) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Logout destroy session
     *
     * @return void
     */
    public static function logout()
    {
        if (isset($_SESSION)) {
            session_destroy();
            header("Location: index.php?url=home&action=home");
            exit();
        }
    }

    /**
     * Update the password with the new entered password
     *
     * @param string $email
     * @param string $newPassword
     * @return boolean
     */
    public static function editAccount(string $email, string $pseudo, string $newPassword): bool
    {
        $userByEmail = User::readUserByEmail($email);
        $userByPseudo = User::readUserByPseudo($pseudo);
        if ($userByPseudo && $userByPseudo->email != $email) {
            return false;
        }
        $query = "UPDATE user SET pseudo = :pseudo, mdp = :mdp WHERE idUser = :idUser";

        $req = MonPdo::getInstance()->prepare($query);
        $req->bindParam(':pseudo', $pseudo);
        $req->bindParam(':mdp', password_hash($newPassword, PASSWORD_DEFAULT));
        $req->bindParam(':idUser', $userByEmail->idUser);
        return $req->execute();
    }

    /**
     * Check if the email already exist
     *
     * @param string $email
     * @return boolean
     */
    public static function emailAlreadyExist(string $email)
    {
        $query = "SELECT COUNT(*) FROM user WHERE email = :email";

        $req = MonPdo::getInstance()->prepare($query);
        $req->bindParam(':email', $email);
        $req->execute();
        $exist = $req->fetchColumn();
        return $exist;
    }

    /**
     * Check if the pseudo already exist
     *
     * @param string $pseudo
     * @return boolean
     */
    public static function pseudoAlreadyExist(string $pseudo)
    {
        $query = "SELECT COUNT(*) FROM user WHERE pseudo = :pseudo";

        $req = MonPdo::getInstance()->prepare($query);
        $req->bindParam(':pseudo', $pseudo);
        $req->execute();
        $exist = $req->fetchColumn();
        return $exist;
    }

    /**
     * Register a new user
     *
     * @param string $name
     * @param string $firstName
     * @param string $email
     * @param string $pseudo
     * @param string $password
     * @param string $avatar
     * @return boolean
     */
    public static function register(string $name, string $firstName, string $email, string $pseudo, string $password, $avatar): bool
    {
        $query = "INSERT INTO user (nom, prenom, email, pseudo, mdp, avatar) VALUES (:nom, :prenom, :email, :pseudo, :mdp, :avatar)";

        $req = MonPdo::getInstance()->prepare($query);
        $req->bindParam(':nom', $name);
        $req->bindParam(':prenom', $firstName);
        $req->bindParam(':email', $email);
        $req->bindParam(':pseudo', $pseudo);
        $req->bindParam(':mdp', password_hash($password, PASSWORD_DEFAULT));
        $req->bindParam(':avatar', $avatar);
        return $req->execute();
    }

    /**
     * Check if the user is inactiv
     *
     * @param string $email
     * @return void
     */
    public static function userIsInactiv(string $email)
    {
        $query = 'SELECT * FROM user WHERE email = :email AND idStatus = 2';

        $req = MonPdo::getInstance()->prepare($query);
        $req->bindParam(':email', $email);
        $req->setFetchMode(PDO::FETCH_OBJ);
        $req->execute();

        if ($req->rowCount() != 0) {
            return true;
        }
        return false;
    }
}
