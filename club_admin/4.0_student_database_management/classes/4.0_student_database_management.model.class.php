<?php
session_start();
class STUDENT_DATABASE_MANAGEMENT_MODEL extends Dbh{

    //CLASS (STUDENT_DATABASE_MANAGEMENT_MODEL) FUNC DISPLAY (STUDENT)
    public function m_display_student(){
        $sql = "SELECT 
        student_0_db.*
        , general_0_center.*
         FROM student_0_db INNER JOIN general_0_center ON student_0_db.student_center_id = general_0_center.center_id ";
        $stmt = $this->connect()->query($sql);
        while($row = $stmt->fetch()){
            $json_array[] = $row;
        }
        echo json_encode($json_array); 
    }

     //CLASS (STUDENT_DATABASE_MANAGEMENT_MODEL) FUNC SEARCH (STUDENT)
     public function m_search_student($search){
        $search = "%$search%";
        $sql = "SELECT 
        student_0_db.*
        ,general_0_center.center_id , general_0_center.center_name
        
         FROM 

         student_0_db 

         INNER JOIN 

         general_0_center 

         ON 
         student_0_db.student_center_id = general_0_center.center_id
         
        WHERE
          
        student_0_db.student_name LIKE ? " ;

        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$search]);
        
        while($row = $stmt->fetch()){
           $json_array[] = $row;
        }
        echo json_encode($json_array);
    }

    //CLASS (STUDENT_DATABASE_MANAGEMENT_MODEL) FUNC INSERT (STUDENT)
    public function m_insert_student($student_name,$student_ic,$student_grade,
    $student_center_id,$student_address,$student_tel_no,$student_email){
        $sql = "INSERT INTO 
        student_0_db
        (student_name,student_ic,student_grade,student_center_id,student_address,student_tel_no,student_email)
         VALUES(?,?,?,?,?,?,?)" ;
        $stmt = $this->connect()->prepare($sql);
        if($stmt->execute([$student_name,$student_ic,$student_grade,
        $student_center_id,$student_address,$student_tel_no,$student_email])){
            echo("ok");
        }  
    }

    //CLASS (STUDENT_DATABASE_MANAGEMENT_MODEL) FUNC FETCH EDIT (STUDENT)
     public function m_fetch_edit_student($fetch_edit_data){
        $sql = "SELECT student_0_db.* , general_0_center.* FROM student_0_db JOIN general_0_center ON student_0_db.student_center_id = general_0_center.center_id   WHERE student_0_db.student_id = ? " ;
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$fetch_edit_data]);
        while($row = $stmt->fetch()){
           $json_array[] = $row;
        }
        echo json_encode($json_array);
    }

   //CLASS (STUDENT_DATABASE_MANAGEMENT_MODEL) FUNC EDIT (STUDENT)
    public function m_edit_student($student_id,$student_name,$student_ic,$student_grade,$student_center_id,$student_address,$student_tel_no, $student_email){
        $sql = "UPDATE 
        student_0_db SET 
        student_name = ?,
        student_ic = ?,
        student_grade = ?,
        student_center_id = ?,
        student_address = ?,
        student_tel_no = ?,
        student_email = ?
        WHERE 
        student_id = ?";
        $stmt = $this->connect()->prepare($sql);
        if($stmt->execute([$student_name,$student_ic,$student_grade,$student_center_id,$student_address,$student_tel_no, $student_email,$student_id])){
            echo("ok");
        }  
    }

}  

     
?>