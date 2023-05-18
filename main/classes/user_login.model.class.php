<?php
class ADMIN_MODEL extends Dbh{

    public function m_admin_acc($username,$password){
        $sql = "SELECT * FROM admin_0_acc WHERE admin_username = ? AND admin_password = ?" ;
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$username,$password]);
        $user = $stmt->fetchAll();
        if($stmt->rowCount()==1)
        {    
            session_start();
            $_SESSION["admin"] = $user[0]["admin_username"];;
            echo "1";
        }  
    }
}
?>