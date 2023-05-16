<?php

/**
 *  @author : Ilan Maleq
 * Project: Wiki-Cars
 * Descriptif   : Classe d'acces aux donnees Utilise les services de la classe PDO
 * -> Les attributs sont tous statiques, les 4 premiers pour la connexion
 * -> $monPdo qui contiendra l'unique instance de la classe
 */

 require_once 'config.php';

class MonPdo
{
    private static $server_name = SERVER_NAME;
    private static $database_name = DATABASE_NAME;
    private static $user_name = USER_NAME;
    private static $password = PASSWORD;
    
    private static $monPdo;
    private static $unPdo = null;
    /**
     * Constructeur privé, crée l'instance de PDO qui sera sollicitée
     * pour toutes les méthodes de la classe
     */
    private function __construct()
    {
        MonPdo::$unPdo = new PDO(MonPdo::$server_name . ';' . MonPdo::$database_name, MonPdo::$user_name, MonPdo::$password);
        MonPdo::$unPdo->query("SET CHARACTER Set utf8");
        MonPdo::$unPdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }
    public function __destruct()
    {
        MonPdo::$unPdo = null;
    }
    /**
     * Fonction statique qui cree l'unique instance de la classe 
     * Appel : $instanceMonPdo = MonPdo::getMonPdo();
     * @return l'unique objet de la classe MonPdo
     */
    public static function getInstance()
    {
        if (self::$unPdo == null) {
            self::$monPdo = new MonPdo();
        }
        return self::$unPdo;
    }
}
