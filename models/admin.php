<?php

class Admin
{
    public static function getInactivUsers(): array
    {
        $query = "SELECT * FROM user WHERE idStatus = 2";

        $req = MonPdo::getInstance()->prepare($query);
        $req->setFetchMode(PDO::FETCH_OBJ);
        $req->execute();
        return $req->fetchAll();
    }


    public static function setInactivUser(int $idUser)
    {
        $query = 'UPDATE user SET idStatus = 2 WHERE idUser = :idUser';

        $req = MonPdo::getInstance()->prepare($query);
        $req->bindParam(':idUser', $idUser);
        $req->execute();
    }

    public static function setActivUser(int $idUser)
    {
        $query = 'UPDATE user SET idStatus = 1 WHERE idUser = :idUser';

        $req = MonPdo::getInstance()->prepare($query);
        $req->bindParam(':idUser', $idUser);
        $req->execute();
    }
}
