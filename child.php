<?php
class Child {
    private $id;
    private $name;
    private $dateOfBirth;
    private $userId;

    public function __construct($id, $name, $dateOfBirth, $userId) {
        $this->id = $id;
        $this->name = $name;
        $this->dateOfBirth = $dateOfBirth;
        $this->userId = $userId;
    }

    // Getters and Setters
    public function getId() {
        return $this->id;
    }

    public function getName() {
        return $this->name;
    }

    public function getDateOfBirth() {
        return $this->dateOfBirth;
    }

    public function getUserId() {
        return $this->userId;
    }

    public function setName($name) {
        $this->name = $name;
    }

    public function setDateOfBirth($dateOfBirth) {
        $this->dateOfBirth = $dateOfBirth;
    }

    public function setUserId($userId) {
        $this->userId = $userId;
    }
}
?>
