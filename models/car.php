<?php

/**
 * @author : Ilan Maleq
 * Project: Wiki-Cars
 * Page: index.php
 * Description : Page ayant toutes les fonctions concernant les voitures
 **/

class Car
{
    /**
     * Get all car
     *
     * @return array
     */
    public static function getAllCar(): array
    {
        $query = "SELECT * FROM voiture WHERE idVisibilite = 2 ORDER BY marqueVoiture, modeleVoiture ASC";

        $req = MonPdo::getInstance()->prepare($query);
        $req->setFetchMode(PDO::FETCH_OBJ);
        $req->execute();
        return $req->fetchAll();
    }

    /**
     * Get all user car
     *
     * @param integer $idUser
     * @return array
     */
    public static function getAllMyCars(int $idUser): array
    {
        $query = "SELECT * FROM voiture WHERE idUser = :idUser";

        $req = MonPdo::getInstance()->prepare($query);
        $req->setFetchMode(PDO::FETCH_OBJ);
        $req->bindParam(':idUser', $idUser);
        $req->execute();

        return $req->fetchAll();
    }

    /**
     * Insert into voiture to add new car
     *
     * @param integer $idUser
     * @param string $fabricationDate
     * @param integer $idCategorie
     * @param string $modelCar
     * @param string $brand
     * @param integer $idMotor
     * @param integer $idEnergy
     * @param integer $idTransmission
     * @param integer $idGearBox
     * @param integer $weight
     * @param integer $nbDoors
     * @param integer $nbSeats
     * @param [type] $image
     * @param [type] $comment
     * @param [type] $technicalDocument
     * @param integer $idVisibility
     * @return void
     */
    public static function addCar(int $idUser, string $fabricationDate, int $idCategorie, string $modelCar, string $brand, int $idMotor, int $idEnergy, int $idTransmission, int $idGearBox, int $weight, int $nbDoors, int $nbSeats, $image, $comment, $technicalDocument, $idVisibility)
    {
        date_default_timezone_set('Europe/Paris');
        $creationDate = date('Y-m-d H:i:s');
        $query = "INSERT INTO voiture (
        dateCreationFiche,     
        idUser,             
        dateFabrication,
        idCategorie,          
        modeleVoiture,      
        marqueVoiture,
        idMotorisation,        
        idEnergie,          
        idTransmission,
        idBoiteVitesse,        
        poids,              
        nbrPortes,
        nbrPlaces,             
        image,              
        commentaire,
        documentTechnique,     
        idVisibilite) 
        VALUES (
        :dateCreationFiche,  
        :idUser,            
        :dateFabrication,
        :idCategorie,          
        :modeleVoiture,     
        :marqueVoiture,
        :idMotorisation,       
        :idEnergie,         
        :idTransmission,
        :idBoiteVitesse,       
        :poids,             
        :nbrPortes,
        :nbrPlaces,            
        :image,             
        :commentaire,
        :documentTechnique,    
        :idVisibilite)";

        $req = MonPdo::getInstance()->prepare($query);

        $req->bindParam(':dateCreationFiche', $creationDate);
        $req->bindParam(':idUser', $idUser);
        $req->bindParam(':dateFabrication', $fabricationDate);
        $req->bindParam(':idCategorie', $idCategorie);
        $req->bindParam(':modeleVoiture', $modelCar);
        $req->bindParam(':marqueVoiture', $brand);
        $req->bindParam(':idMotorisation', $idMotor);
        $req->bindParam(':idEnergie', $idEnergy);
        $req->bindParam(':idTransmission', $idTransmission);
        $req->bindParam(':idBoiteVitesse', $idGearBox);
        $req->bindParam(':poids', $weight);
        $req->bindParam(':nbrPortes', $nbDoors);
        $req->bindParam(':nbrPlaces', $nbSeats);
        $req->bindParam(':image', $image);
        $req->bindParam(':commentaire', $comment);
        $req->bindParam(':documentTechnique', $technicalDocument);
        $req->bindParam(':idVisibilite', $idVisibility);

        return $req->execute();
    }

    /**
     * Get last 7 car
     *
     * @return array
     */
    public static function getLastCar(): array
    {
        $query = "SELECT * FROM voiture  WHERE idVisibilite = 2 ORDER BY dateCreationFiche DESC LIMIT 7 ";

        $req = MonPdo::getInstance()->prepare($query);
        $req->setFetchMode(PDO::FETCH_OBJ);
        $req->execute();
        return $req->fetchAll();
    }


    public static function getCategory(): array
    {
        $query = "SELECT * FROM categorie";

        $req = MonPdo::getInstance()->prepare($query);
        $req->setFetchMode(PDO::FETCH_OBJ);
        $req->execute();
        return $req->fetchAll();
    }

    /**
     * Get all engine
     *
     * @return array
     **/
    public static function getMotorisation(): array
    {
        $query = "SELECT * FROM motorisation";

        $req = MonPdo::getInstance()->prepare($query);
        $req->setFetchMode(PDO::FETCH_OBJ);
        $req->execute();
        return $req->fetchAll();
    }

    /**
     * Get all energy 
     * @return array
     */
    public static function getEnergy(): array
    {
        $query = "SELECT * FROM energie";

        $req = MonPdo::getInstance()->prepare($query);
        $req->setFetchMode(PDO::FETCH_OBJ);
        $req->execute();
        return $req->fetchAll();
    }

    /**
     * Get all transmission
     * @return array
     */
    public static function getTransmission(): array
    {
        $query = "SELECT * FROM transmission";

        $req = MonPdo::getInstance()->prepare($query);
        $req->setFetchMode(PDO::FETCH_OBJ);
        $req->execute();
        return $req->fetchAll();
    }

    /**
     * get all gear box 
     * @return array
     */
    public static function getGearBox(): array
    {
        $query = "SELECT * FROM boitevitesse";

        $req = MonPdo::getInstance()->prepare($query);
        $req->setFetchMode(PDO::FETCH_OBJ);
        $req->execute();
        return $req->fetchAll();
    }

    /**
     * get all visibility
     * @return array
     */
    public static function getVisibility(): array
    {
        $query = "SELECT * FROM visibilite";

        $req = MonPdo::getInstance()->prepare($query);
        $req->setFetchMode(PDO::FETCH_OBJ);
        $req->execute();
        return $req->fetchAll();
    }

    /**
     * find all car 
     * @return array
     */
    public static function findAllCar()
    {
        $query = "SELECT * FROM voiture
        LEFT JOIN user ON voiture.idUser = user.idUser
        WHERE idVisibilite = '2'";

        $req = MonPdo::getInstance()->prepare($query);
        $req->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, 'car');
        $req->execute();
        $cars = $req->fetchAll();
        return $cars;
    }

    /**
     * find all private car
     * @return mixed
     */
    public static function findAllCarPrivate()
    {
        $query = "SELECT * FROM voiture
        LEFT JOIN user ON voiture.idUser = user.idUser
        WHERE idVisibilite = '1'";

        $req = MonPdo::getInstance()->prepare($query);
        $req->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, 'car');
        $req->execute();
        $cars = $req->fetchAll();
        return $cars;
    }

    /**
     * update car visibility to private for admin
     * @param integer $idCar
     * @return void
     */
    public static function modifyPrivateAdmin(int $idCar)
    {
        $query = "UPDATE voiture SET idVisibilite = 1 WHERE idVoiture = :idVoiture";

        $req = MonPdo::getInstance()->prepare($query);
        $req->bindParam(':idVoiture', $idCar);
        $req->execute();
    }
    /**
     * update car visibility to public for admin
     * @param integer $idCar
     * @return void
     */
    public static function modifyPublicAdmin(int $idCar)
    {
        $query = "UPDATE voiture SET idVisibilite = 2 WHERE idVoiture = :idVoiture";

        $req = MonPdo::getInstance()->prepare($query);
        $req->bindParam(':idVoiture', $idCar);
        $req->execute();
    }

    /**
     * update car visibility to private
     * @param integer $idCar
     * @return void
     */
    public static function putPrivateCar(int $idCar)
    {
        $query = "UPDATE voiture SET idVisibilite = 1 WHERE idVoiture = :idVoiture";

        $req = MonPdo::getInstance()->prepare($query);
        $req->bindParam(':idVoiture', $idCar);
        $req->execute();
    }
    /**
     * update car visibility to public
     * @param integer $idCar
     * @return void
     */
    public static function modifyPrivate(int $idCar)
    {
        $query = "UPDATE voiture SET idVisibilite = 2 WHERE idVoiture = :idVoiture";

        $req = MonPdo::getInstance()->prepare($query);
        $req->bindParam(':idVoiture', $idCar);
        $req->execute();
    }

    /**
     * get all public car of user
     * @param integer $idUser
     * @return mixed
     */
    public static function allMyPublicCar(int $idUser)
    {
        $query = "SELECT * FROM voiture WHERE idVisibilite = 2 AND idUser = :idUser";

        $req = MonPdo::getInstance()->prepare($query);
        $req->setFetchMode(PDO::FETCH_OBJ);
        $req->bindParam(':idUser', $idUser);
        $req->execute();
        return $req->fetchAll();
    }

    /**
     * get all private car 
     * @param integer $idUser
     * @return mixed
     */
    public static function allMyPrivateCar(int $idUser)
    {
        $query = "SELECT * FROM voiture WHERE idVisibilite = 1 AND idUser = :idUser";

        $req = MonPdo::getInstance()->prepare($query);
        $req->setFetchMode(PDO::FETCH_OBJ);
        $req->bindParam(':idUser', $idUser);
        $req->execute();
        return $req->fetchAll();
    }

    /**
     * Check if his own car
     * @param integer $idCar
     * @param integer $idUser
     * @return mixed
     */
    public static function verifyOwnCar(int $idCar, int $idUser)
    {
        $query = "SELECT *
        FROM voiture
        WHERE idVoiture = :idVoiture AND idUser = :idUser OR idUser IN (
        SELECT idUser FROM user WHERE idRole = 1)";

        $req = MonPdo::getInstance()->prepare($query);
        $req->setFetchMode(PDO::FETCH_OBJ);
        $req->bindParam(':idVoiture', $idCar);
        $req->bindParam(':idUser', $idUser);
        $req->execute();
        return $req->fetch();
    }

    /**
     * Check selected car for update
     * @param integer $idCar
     * @return mixed
     */
    public static function selectedCar(int $idCar)
    {
        $query = "SELECT * FROM voiture WHERE idVoiture = :idVoiture";

        $req = MonPdo::getInstance()->prepare($query);
        $req->setFetchMode(PDO::FETCH_OBJ);
        $req->bindParam(':idVoiture', $idCar);
        $req->execute();
        return  $req->fetch();
    }

    /**
     * Update car 
     * @param integer $idCar
     * @param mixed $fabricationDate
     * @param integer $idCategorie
     * @param string $modelCar
     * @param string $brand
     * @param integer $idMotor
     * @param integer $idEnergy
     * @param integer $idTransmission
     * @param integer $idGearBox
     * @param integer $weight
     * @param integer $nbDoors
     * @param integer $nbSeats
     * @param mixed $comment
     * @param integer $idVisibility
     * @return mixed
     */
    public static function modifyCar(int $idCar, $fabricationDate, int $idCategorie, string $modelCar, string $brand, int $idMotor, int $idEnergy, int $idTransmission, int $idGearBox, int $weight, int $nbDoors, int $nbSeats, $comment, int $idVisibility)
    {
        $query = "UPDATE voiture SET dateFabrication = :dateFabrication, 
            idCategorie = :idCategorie, 
            modeleVoiture = :modeleVoiture,
            marqueVoiture = :marqueVoiture, 
            idMotorisation = :idMotorisation, 
            idEnergie = :idEnergie,
            idTransmission = :idTransmission, 
            idBoiteVitesse = :idBoiteVitesse,
            poids = :poids, 
            nbrPortes = :nbrPortes,
            nbrPlaces = :nbrPlaces,
            commentaire = :commentaire,
            idVisibilite = :idVisibilite
            WHERE idVoiture = :idVoiture";

        $req = MonPdo::getInstance()->prepare($query);
        $req->setFetchMode(PDO::FETCH_OBJ);
        $req->bindParam(':dateFabrication', $fabricationDate);
        $req->bindParam(':idCategorie', $idCategorie);
        $req->bindParam(':modeleVoiture', $modelCar);
        $req->bindParam(':marqueVoiture', $brand);
        $req->bindParam(':idMotorisation', $idMotor);
        $req->bindParam(':idEnergie', $idEnergy);
        $req->bindParam(':idTransmission', $idTransmission);
        $req->bindParam(':idBoiteVitesse', $idGearBox);
        $req->bindParam(':poids', $weight);
        $req->bindParam(':nbrPortes', $nbDoors);
        $req->bindParam(':nbrPlaces', $nbSeats);
        $req->bindParam(':commentaire', $comment);
        $req->bindParam(':idVisibilite', $idVisibility);
        $req->bindParam(':idVoiture', $idCar);
        $req->execute();
        return $req->fetch();
    }

    /**
     * Get all car detail 
     * @param integer $idCar
     * @return mixed
     */
    public static function carDetail(int $idCar): mixed
    {
        $query = "SELECT * FROM voiture
        LEFT JOIN user ON voiture.idUser = user.idUser
        LEFT JOIN categorie ON voiture.idCategorie = categorie.idCategorie
        LEFT JOIN motorisation ON voiture.idMotorisation = motorisation.idMotorisation
        LEFT JOIN energie ON voiture.idEnergie = energie.idEnergie
        LEFT JOIN transmission ON voiture.idTransmission = transmission.idTransmission
        LEFT JOIN boitevitesse ON voiture.idBoiteVitesse = boitevitesse.idBoiteVitesse
        WHERE idVoiture = :idVoiture";

        $req = MonPdo::getInstance()->prepare($query);
        $req->setFetchMode(PDO::FETCH_OBJ);
        $req->bindParam(':idVoiture', $idCar);
        $req->execute();
        return $req->fetch();
    }

    /**
     * add to favorite car
     * @param integer $idCar
     * @param integer $idUser
     * @return mixed
     */
    public static function addFavoriteCar(int $idCar, int $idUser)
    {
        $query = "INSERT INTO favoris (idVoiture, idUser) VALUES (:idVoiture, :idUser)";

        $req = MonPdo::getInstance()->prepare($query);
        $req->bindParam(':idVoiture', $idCar);
        $req->bindParam(':idUser', $idUser);
        return $req->execute();
    }

    /**
     * check if the car is favorite
     * @param integer $idUser
     * @param integer $idCar
     * @return mixed
     */
    public static function isFavorite(int $idUser, int $idCar)
    {
        $query = "SELECT * FROM favoris WHERE idUser = :idUser AND idVoiture = :idVoiture";

        $req = MonPdo::getInstance()->prepare($query);
        $req->bindParam(':idUser', $idUser);
        $req->bindParam(':idVoiture', $idCar);
        $req->execute();
        return $req->fetch();
    }

    /**
     * Get all favorite car
     * @param integer $idUser
     * @return mixed
     */
    public static function allFavoriteCar(int $idUser)
    {
        $query = "SELECT * FROM favoris
        LEFT JOIN voiture ON favoris.idVoiture = voiture.idVoiture
        WHERE favoris.idUser = :idUser AND voiture.idVisibilite = 2";

        $req = MonPdo::getInstance()->prepare($query);
        $req->setFetchMode(PDO::FETCH_OBJ);
        $req->bindParam(':idUser', $idUser);
        $req->execute();
        return $req->fetchAll();
    }

    /**
     * delete favorite car
     * @param integer $idUser
     * @param integer $idCar
     * @return mixed
     */
    public static function deleteFavoriteCar(int $idUser, int $idCar)
    {
        $query = "DELETE FROM favoris WHERE idUser = :idUser AND  idVoiture = :idVoiture";

        $req = MonPdo::getInstance()->prepare($query);
        $req->setFetchMode(PDO::FETCH_OBJ);
        $req->bindParam(':idUser', $idUser);
        $req->bindParam('idVoiture', $idCar);
        return $req->execute();
    }

    /**
     * duplicate car
     * @param integer $idUser
     * @param integer $idCar
     * @return mixed
     */
    public static function duplicateCar(int $idUser, int $idCar)
    {
        $query = "INSERT INTO voiture (
        idUser, 
        marqueVoiture, 
        modeleVoiture, 
        idCategorie, 
        idMotorisation, 
        idEnergie, 
        idTransmission,
        idBoiteVitesse,
        poids,
        nbrPortes,
        nbrPlaces,
        commentaire,
        image,
        documentTechnique,
        dateFabrication,
        idVisibilite)
        SELECT 
        :idUser, 
        marqueVoiture, 
        modeleVoiture, 
        idCategorie, 
        idMotorisation, 
        idEnergie, 
        idTransmission,
        idBoiteVitesse,
        poids,
        nbrPortes,
        nbrPlaces,
        commentaire,
        image,
        documentTechnique,
        dateFabrication,
        :idVisibilite 
        FROM voiture WHERE idVoiture = :idVoiture";

        $idVisibility = 1;
        $req = MonPdo::getInstance()->prepare($query);
        $req->setFetchMode(PDO::FETCH_OBJ);
        $req->bindParam(':idUser', $idUser);
        $req->bindParam(':idVisibilite', $idVisibility);
        $req->bindParam(':idVoiture', $idCar);
        return $req->execute();
    }

    /**
     * search car by brand, model, category, motorisation, transmission, year
     *
     * @param string $brand
     * @param string $model
     * @param integer $idcategory
     * @param integer $idmotorisation
     * @param integer $idtransmission
     * @param [type] $minYear
     * @param [type] $maxYear
     * @return void
     */
    public static function searchCars(string $brand, string $model, int $idcategory, int $idmotorisation, int $idtransmission, $minYear, $maxYear)
    {
        $query = "SELECT * FROM voiture 
        WHERE (marqueVoiture LIKE :marqueVoiture OR :marqueVoiture IS NULL) 
        AND (modeleVoiture LIKE :modeleVoiture OR :modeleVoiture IS NULL) 
        AND (idCategorie = :idCategorie OR :idCategorie = '') 
        AND (idMotorisation = :idMotorisation OR :idMotorisation = '') 
        AND (idTransmission = :idTransmission OR :idTransmission = '') 
        AND (dateFabrication >= :minYear OR :minYear = '') 
        AND (dateFabrication <= :maxYear OR :maxYear = '') 
        AND idVisibilite = 2";

        $req = MonPdo::getInstance()->prepare($query);
        $req->setFetchMode(PDO::FETCH_OBJ);
        $req->bindValue(':marqueVoiture', '%' . $brand . '%');
        $req->bindValue(':modeleVoiture', '%' . $model . '%');
        $req->bindValue(':idCategorie', $idcategory);
        $req->bindValue(':idMotorisation', $idmotorisation);
        $req->bindValue(':idTransmission', $idtransmission);
        $req->bindValue(':minYear', $minYear);
        $req->bindValue(':maxYear', $maxYear);

        $req->execute();
        return $req->fetchAll(PDO::FETCH_OBJ);
    }
}
