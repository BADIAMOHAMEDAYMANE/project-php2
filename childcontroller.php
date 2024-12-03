<?php
include "child.php";
include "Connection2.php";

class ChildController {
    private $db;

    public function __construct() {
        $this->db = new Connection();
        $this->db->selectDatabase();
    }

    // Add a child
    public function addChild($name, $dateOfBirth, $userId) {
        $conn = $this->db->conn;
        $sql = "INSERT INTO child (name, date_of_birth, user_id) VALUES (?, ?, ?)";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, "ssi", $name, $dateOfBirth, $userId);
        if (!mysqli_stmt_execute($stmt)) {
            throw new Exception("Error adding child: " . mysqli_error($conn));
        }
    }

    // Get all children for a specific user
    public function getChildrenByUser($userId) {
        $conn = $this->db->conn;
        $sql = "SELECT * FROM child WHERE user_id = ?";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, "i", $userId);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        $children = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $children[] = new Child($row['id'], $row['name'], $row['date_of_birth'], $row['user_id']);
        }
        return $children;
    }
}
?>
