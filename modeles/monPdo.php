<?php

class MonPdo
{
    private static string $server = 'mysql:host=localhost';
    private static string $database = 'dbname=wikiCars';
    private static string $user = 'wikiCarsAdmin';
    private static string $password = '3x8xK3t6RqsZyk';
    private static $selfPDO;
    private static PDO $pdo;
    /**
     * Undocumented function
     */
    private function __construct()
    {
        MonPdo::$pdo = new PDO(MonPdo::$server . ';' . MonPdo::$database . ';' . MonPdo::$user, MonPdo::$password);
        MonPdo::$pdo->query("SET CHARACTER Set utf8");
        MonPdo::$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }
    public function __destruct()
    {
        MonPdo::$pdo = null;
    }
    /**
     * Fonction statique qui cree l'unique instance de la classe 
     * Appel : $instanceMonPdo = MonPdo::getMonPdo();
     * @return l'unique objet de la classe MonPdo
     */
    public static function getInstance()
    {
        if (self::$pdo == null) {
            self::$pdo = new MonPdo();
        }
        return self::$pdo;
    }
}
