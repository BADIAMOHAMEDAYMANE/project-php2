<?php
class Connection {
    private $servername = "localhost";
    private $username = "root";
    private $password = "";
    private $dbname = "website";
    public $conn;

    // Constructeur pour établir une connexion
    public function __construct() {
        $this->conn = mysqli_connect($this->servername, $this->username, $this->password);
        if (!$this->conn) {
            die("Erreur de connexion : " . mysqli_connect_error());
        }
    }

    // Créer une base de données si elle n'existe pas
    public function createDatabase() {
        $sql = "CREATE DATABASE IF NOT EXISTS " . $this->dbname;
        if (mysqli_query($this->conn, $sql)) {
            echo "Base de données créée ou déjà existante.<br>";
        } else {
            throw new Exception("Erreur lors de la création de la base de données : " . mysqli_error($this->conn));
        }
    }

    // Sélectionner la base de données
    public function selectDatabase() {
        if (mysqli_select_db($this->conn, $this->dbname)) {
            return $this->conn; // Retourne la connexion active
        } else {
            throw new Exception("Erreur lors de la sélection de la base de données : " . mysqli_error($this->conn));
        }
    }

    // Créer une table
    public function createTable($query) {
        if (mysqli_query($this->conn, $query)) {
            echo "Table créée avec succès.<br>";
        } else {
            throw new Exception("Erreur lors de la création de la table : " . mysqli_error($this->conn));
        }
    }
}
?>
