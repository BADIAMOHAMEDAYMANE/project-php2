<?php
class Users {
    private $emailvalue;
    private $passwordvalue;
    private $hashedpassword;
    public static $emailerrormsg = "";
    public static $passworderrormsg = "";

    // Constructeur
    public function __construct($emailvalue, $passwordvalue) {
        $this->emailvalue = $emailvalue;
        $this->passwordvalue = $passwordvalue;

        // Hachage du mot de passe
        $this->hashedpassword = password_hash($passwordvalue, PASSWORD_DEFAULT);
    }

    // Méthode d'insertion d'un utilisateur
    public function insertUsers($conn) {
        if (!$conn) {
            self::$emailerrormsg = "Database connection is null";
            return false;
        }

        $sql = "INSERT INTO users (email, password) VALUES (?, ?)";
        $stmt = $conn->prepare($sql);

        if ($stmt) {
            $stmt->bind_param("ss", $this->emailvalue, $this->hashedpassword);
            if ($stmt->execute()) {
                $stmt->close();
                return true;
            } 
            self::$emailerrormsg = "Error: " . $stmt->error;
            $stmt->close();
            return false;
        }
        
        self::$emailerrormsg = "Error preparing statement: " . $conn->error;
        return false;
    }

    // Méthode pour récupérer tous les utilisateurs
    public static function selectAllUsers($conn) {
        if (!$conn) {
            self::$emailerrormsg = "Database connection is null";
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
            self::$emailerrormsg = "Error preparing statement: " . $conn->error;
        }
        return $data;
    }

    // Méthode pour sélectionner un utilisateur par ID
    public static function selectUserById($conn, $id) {
        if (!$conn) {
            self::$emailerrormsg = "Database connection is null";
            return null;
        }

        $sql = "SELECT * FROM users WHERE id = ?";
        if ($stmt = $conn->prepare($sql)) {
            $stmt->bind_param("i", $id);
            if ($stmt->execute()) {
                $result = $stmt->get_result();
                if ($result->num_rows > 0) {
                    $data = $result->fetch_assoc();
                    $stmt->close();
                    return $data;
                }
            }
            $stmt->close();
        } else {
            self::$emailerrormsg = "Error preparing statement: " . $conn->error;
        }
        return null;
    }

    // Méthode pour mettre à jour un utilisateur
    public static function updateUser($conn, $id, $email, $password) {
        if (!$conn) {
            self::$emailerrormsg = "Database connection is null";
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
            self::$emailerrormsg = "Error preparing statement: " . $conn->error;
        }
        return false;
    }

    // Méthode pour supprimer un utilisateur
    public static function deleteUser($conn, $id) {
        if (!$conn) {
            self::$emailerrormsg = "Database connection is null";
            return false;
        }

        $sql = "DELETE FROM users WHERE id = ?";
        if ($stmt = $conn->prepare($sql)) {
            $stmt->bind_param("i", $id);
            $success = $stmt->execute();
            $stmt->close();
            return $success;
        } else {
            self::$emailerrormsg = "Error preparing statement: " . $conn->error;
        }
        return false;
    }
}
?>

