<?php
class Users {
    private $email;
    private $password;
    private $hashedPassword;
    public static $errorMessage = "";

    // Constructeur
    public function __construct($email, $password) {
        $this->email = $email;
        $this->password = $password;

        // Hachage du mot de passe
        $this->hashedPassword = password_hash($password, PASSWORD_DEFAULT);
    }

    // Getters
    public function getEmail() {
        return $this->email;
    }

    public function getPassword() {
        return $this->password;
    }

    public function getHashedPassword() {
        return $this->hashedPassword;
    }

    // Setters (si besoin de mise à jour)
    public function setEmail($email) {
        $this->email = $email;
    }

    public function setPassword($password) {
        $this->password = $password;
        $this->hashedPassword = password_hash($password, PASSWORD_DEFAULT);
    }

    // Méthode pour insérer un utilisateur
    public function insertUser($conn) {
        if (!$conn) {
            self::$errorMessage = "La connexion à la base de données est invalide.";
            return false;
        }

        $sql = "INSERT INTO users (email, password) VALUES (?, ?)";
        $stmt = $conn->prepare($sql);

        if ($stmt) {
            $stmt->bind_param("ss", $this->email, $this->hashedPassword);
            if ($stmt->execute()) {
                $stmt->close();
                return true;
            } else {
                self::$errorMessage = "Erreur lors de l'insertion : " . $stmt->error;
            }
            $stmt->close();
        } else {
            self::$errorMessage = "Erreur lors de la préparation de la requête : " . $conn->error;
        }

        return false;
    }

    // Méthode pour récupérer tous les utilisateurs
    public static function selectAllUsers($conn) {
        if (!$conn) {
            self::$errorMessage = "La connexion à la base de données est invalide.";
            return [];
        }

        $data = [];
        $sql = "SELECT * FROM users";

        if ($stmt = $conn->prepare($sql)) {
            $stmt->execute();
            $result = $stmt->get_result();
            while ($row = $result->fetch_assoc()) {
                $data[] = $row;
            }
            $stmt->close();
        } else {
            self::$errorMessage = "Erreur lors de la préparation de la requête : " . $conn->error;
        }

        return $data;
    }

    // Méthode pour récupérer un utilisateur par ID
    public static function selectUserById($conn, $id) {
        if (!$conn) {
            self::$errorMessage = "La connexion à la base de données est invalide.";
            return null;
        }

        $sql = "SELECT * FROM users WHERE id = ?";
        if ($stmt = $conn->prepare($sql)) {
            $stmt->bind_param("i", $id);
            $stmt->execute();
            $result = $stmt->get_result();
            if ($result->num_rows > 0) {
                $data = $result->fetch_assoc();
                $stmt->close();
                return $data;
            }
            $stmt->close();
        } else {
            self::$errorMessage = "Erreur lors de la préparation de la requête : " . $conn->error;
        }

        return null;
    }

    // Méthode pour mettre à jour un utilisateur
    public static function updateUser($conn, $id, $email, $password) {
        if (!$conn) {
            self::$errorMessage = "La connexion à la base de données est invalide.";
            return false;
        }

        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        $sql = "UPDATE users SET email = ?, password = ? WHERE id = ?";
        if ($stmt = $conn->prepare($sql)) {
            $stmt->bind_param("ssi", $email, $hashedPassword, $id);
            $success = $stmt->execute();
            $stmt->close();
            return $success;
        } else {
            self::$errorMessage = "Erreur lors de la préparation de la requête : " . $conn->error;
        }

        return false;
    }

    // Méthode pour supprimer un utilisateur
    public static function deleteUser($conn, $id) {
        if (!$conn) {
            self::$errorMessage = "La connexion à la base de données est invalide.";
            return false;
        }

        $sql = "DELETE FROM users WHERE id = ?";
        if ($stmt = $conn->prepare($sql)) {
            $stmt->bind_param("i", $id);
            $success = $stmt->execute();
            $stmt->close();
            return $success;
        } else {
            self::$errorMessage = "Erreur lors de la préparation de la requête : " . $conn->error;
        }

        return false;
    }
}
?>
