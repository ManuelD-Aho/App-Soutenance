<?php
namespace App\Config;

use PDO;
use PDOException;

class Database
{
    /**
     * Instance unique (Singleton)
     * @var database|null
     */
    private static ?database $instance = null;

    /**
     * L'objet PDO
     * @var PDO
     */
    private PDO $pdo;

    /**
     * Constructeur privé pour empêcher l'instanciation multiple.
     */
    private function __construct()
    {
        // Récupération des paramètres depuis l'environnement ou valeurs par défaut
        $host     = getenv('DB_HOST')     ?: '127.0.0.1';
        $port     = getenv('DB_PORT')     ?: '3306';
        $db       = getenv('DB_DATABASE') ?: 'universite';
        $user     = getenv('DB_USERNAME') ?: 'root';
        $pass     = getenv('DB_PASSWORD') ?: 'root_password';
        $charset  = 'utf8mb4';

        $dsn = sprintf(
            'mysql:host=%s;port=%s;dbname=%s;charset=%s',
            $host,
            $port,
            $db,
            $charset
        );
        
        $options = [
            PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES   => false,
        ];
        
        try {
            $this->pdo = new PDO($dsn, $user, $pass, $options);
        } catch (PDOException $e) {
            throw new PDOException($e->getMessage(), (int)$e->getCode());
        }
    }
    
    /**
     * Récupère l'instance unique de la classe (Singleton).
     *
     * @return Database
     */
    public static function getInstance(): Database
    {
        if (self::$instance === null) {
            self::$instance = new self();
        }
        return self::$instance;
    }
    
    /**
     * Récupère l'objet PDO pour les requêtes directes.
     *
     * @return PDO
     */
    public function getPdo(): PDO
    {
        return $this->pdo;
    }
}
