<?php
class ADMIN_CONTR extends ADMIN_MODEL{

    private $username;
    private $password;

    public function __construct($username,$password){
        $this->username = $username;
        $this->password = $password;     
    }
    
    public function c_admin_acc(){
       $this->m_admin_acc($this->username,$this->password);
    }
}
?>