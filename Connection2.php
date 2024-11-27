<?php
class Connection {
    private $servername = "localhost";
    private $username = "root";
    private $password = "";
    private $dbname = "website"; // Nom de la base de données par défaut
    public $conn;

    // Constructeur pour établir une connexion
    public function __construct() {
        $this->conn = mysqli_connect($this->servername, $this->username, $this->password);
        if (!$this->conn) {
            die("Erreur de connexion : " . mysqli_connect_error());
        }
    }

    // Fonction pour créer une base de données
    public function createDatabase() {
        $sql = "CREATE DATABASE IF NOT EXISTS " . $this->dbname;
        if (mysqli_query($this->conn, $sql)) {
            echo "Base de données créée ou déjà existante avec succès.<br>";
        } else {
            throw new Exception("Erreur lors de la création de la base de données : " . mysqli_error($this->conn));
        }
    }

    // Fonction pour sélectionner la base de données
    public function selectDatabase() {
        if (mysqli_select_db($this->conn, $this->dbname)) {
            echo "Base de données sélectionnée avec succès.<br>";
        } else {
            throw new Exception("Erreur lors de la sélection de la base de données : " . mysqli_error($this->conn));
        }
    }

    // Fonction pour créer une table
    public function createTable($query) {
        if (mysqli_query($this->conn, $query)) {
            echo "Table créée avec succès.<br>";
        } else {
            throw new Exception("Erreur lors de la création de la table : " . mysqli_error($this->conn));
        }
    }

    // Fonction pour fermer la connexion
    public function closeConnection() {
        if ($this->conn) {
            mysqli_close($this->conn);
            echo "Connexion fermée avec succès.<br>";
        }
    }
}
?>
