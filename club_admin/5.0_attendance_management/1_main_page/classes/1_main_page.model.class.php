<?php
class ATTENDENCE_MANAGEMENT_MODEL extends Dbh{

    //CLASS (ATTENDENCE_MANAGEMENT_MODEL) FUNC SEARCH (student)
    public function m_search_student($search){
        $search = "%$search%";
        $sql = "SELECT student_0_db.*,general_0_center.* FROM student_0_db INNER JOIN general_0_center ON student_0_db.student_center_id = general_0_center.center_id WHERE student_0_db.student_name LIKE ? OR general_0_center.center_name LIKE ? LIMIT 4" ;
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$search,$search]);
        while($row = $stmt->fetch()){
           $json_array[] = $row;
        }
        echo json_encode($json_array);
    }

    
   //CLASS (ATTENDENCE_MANAGEMENT_MODEL) FUNC INSERT (ATTENDENCE)
   public function m_insert_attendence($date,$class_id,$student_id){

    $check_validity = "SELECT * FROM student_1_attendence WHERE attendence_date =? AND	attendence_class_id = ? AND attendence_student_id = ?" ;
    $stmt = $this->connect()->prepare($check_validity);
    $user = $stmt->fetchAll();
    $stmt->execute([$date,$class_id,$student_id]);
    $user = $stmt->fetchAll();
    if(($stmt->rowCount()) == 0){ 
        $sql = "INSERT INTO student_1_attendence(attendence_date,attendence_class_id,attendence_student_id) VALUES(?,?,?)" ;
        $stmt = $this->connect()->prepare($sql);
        if($stmt->execute([$date,$class_id,$student_id])){
            echo("ok");
        }   
    }  
}


//CLASS (ATTENDENCE_MANAGEMENT_MODEL) FUNC SEARCH (student)
    public function m_display_attendence($date,$class_id){
        $check_validity = "SELECT student_1_attendence.* ,student_0_db.* FROM student_1_attendence INNER JOIN student_0_db ON student_1_attendence.attendence_student_id = student_0_db.student_id WHERE student_1_attendence.attendence_date =? AND student_1_attendence.attendence_class_id = ? " ;
        $stmt = $this->connect()->prepare($check_validity);
        $user = $stmt->fetchAll();
        $stmt->execute([$date,$class_id]);
        while($row = $stmt->fetch()){
            $json_array[] = $row;
         }
         echo json_encode($json_array);
    }  

    

    //CLASS (ATTENDENCE_MANAGEMENT_MODEL) FUNC DISPLAY CLASS TITLE (CLASS)
    public function m_display_class_title_func($class_id){

        $sql = "SELECT general_3_class.*,general_0_center.*,general_1_session.* FROM general_3_class JOIN general_0_center ON general_3_class.class_center_id = general_0_center.center_id JOIN general_1_session ON general_3_class.class_session_id = general_1_session.session_id WHERE general_3_class.class_id = ?" ;
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$class_id]);
        while($row = $stmt->fetch()){
           $json_array[] = $row;
        }
        echo json_encode($json_array);
    }
   

     //CLASS (ATTENDENCE_MANAGEMENT_MODEL) FUNC DELETE (ATTENDENCE)
     public function  m_delete_attendence_func($date,$class_id,$student_id){
        $sql = "DELETE FROM student_1_attendence WHERE attendence_date = ? AND attendence_class_id = ? AND attendence_student_id = ?" ;
            $stmt = $this->connect()->prepare($sql);
            if($stmt->execute([$date,$class_id,$student_id])){
                echo("ok");
            }    
     }

    
}
    ?>