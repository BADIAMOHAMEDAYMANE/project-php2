<?php
class Admin{
    private $id;
    private $name;
    private $passwordadmin;

    public function __construct($id,$name,$passwordadmin){
     $this->id = $id;
     $this->name = $name;
     $this->passwordadmin = $passwordadmin;
    }
    public function getid(){
       return $this->id;
    }
    public function getname(){
        return $this->name;
     }
     public function getpasswordadmin(){
        return $this->passwordadmin;
     }
     public function setid($id){
        $this->id = $id;
     }
     public function setname($name){
        $this->name = $name;
     }
     public function setpasswordadmin($passwordadmin){
        $this->passwordadmin = $passwordadmin;
     }
}
?>