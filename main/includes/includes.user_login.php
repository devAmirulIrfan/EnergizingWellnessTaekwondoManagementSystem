<?php

include '../../dbh.class.php';
include '../classes/user_login.model.class.php';
include '../classes/user_login.contr.class.php';

if(isset($_POST["role"])){

    // (FC_CUST/FC_VENDOR/FC_OPERATOR)
    $role = $_POST["role"];
   
    if($role == "admin"){

        // (FC_VENDOR/FC_OPERATOR) ONLY
        $username = $_POST["username"];
        $password = $_POST["password"]; 
        $operator = new ADMIN_CONTR($username,$password);
        $operator->c_admin_acc();
    }
}
    
   

    
    
    

  
  
?>