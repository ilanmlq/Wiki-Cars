<?php

/**
 * @author : Ilan Maleq
 * Project: Wiki-Cars
 * Page: admin.php
 * Description : Page ayant toutes les fonctions concernant l'admin
 */

class Admin
{
    /**
     * Get all inactiv user 
     *
     * @return array
     */
    public static function getInactivUsers(): array
    {
        $query = "SELECT * FROM user WHERE idStatus = 2";

        $req = MonPdo::getInstance()->prepare($query);
        $req->setFetchMode(PDO::FETCH_OBJ);
        $req->execute();
        return $req->fetchAll();
    }

    /**
     * set inactiv user
     *
     * @param integer $idUser
     * @return void
     */
    public static function setInactivUser(int $idUser)
    {
        $query = 'UPDATE user SET idStatus = 2 WHERE idUser = :idUser';

        $req = MonPdo::getInstance()->prepare($query);
        $req->bindParam(':idUser', $idUser);
        $req->execute();
    }
    
    /**
     * Set activ user
     *
     * @param integer $idUser
     * @return void
     */
    public static function setActivUser(int $idUser)
    {
        $query = 'UPDATE user SET idStatus = 1 WHERE idUser = :idUser';

        $req = MonPdo::getInstance()->prepare($query);
        $req->bindParam(':idUser', $idUser);
        $req->execute();
    }
}
