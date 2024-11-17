<?php
   session_start();
   $emailerrormsg =  "";
   $passworderrormsg = "";
   if(isset($_POST["submit"])){
           $emailvalue = $_POST["email"];
           $passwordvalue = $_POST["password"];
           $confirmpasswordvalue = $_POST["confirm-password"];
           if ($emailvalue == "") {
              $emailerrormsg = "email must be filled out";
           } elseif (!preg_match("/\w+(@emsi.ma){1}$/", $emailvalue)) {
              $emailerrormsg = "Please enter a valid email with '@emsi.ma'";
           } elseif ($passwordvalue == "") {
               $passworderrormsg = "password must be filled out";
           }
           elseif($confirmpasswordvalue != $passwordvalue){
               $passworderrormsg ="the passwords are not matching";
           }

           else{
            header("location:signin.php");
           }
       }
   


   ?>