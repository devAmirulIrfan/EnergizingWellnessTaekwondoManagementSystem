<?php

class ATTENDENCE_REPORT_MODEL extends Dbh{
    //CLASS (ORDER_MANAGEMENT_MODEL) FUNC DISPLAY (FOOD MENU)
    public function m_display_attendence_report_func(){
        $sql = "SELECT 

        student_1_attendence.* , general_3_class.* , general_0_center.*,general_1_session.*,student_0_db.*
        
        FROM 
        
        student_1_attendence
        
        JOIN
        
        general_3_class
        
        ON
        
        student_1_attendence.attendence_class_id = general_3_class.class_id 
        
        JOIN
        
        general_0_center
        
        
        ON
        
        general_3_class.class_center_id = general_0_center.center_id
        
        
        
        JOIN
        
        general_1_session
        
        ON
        
        general_3_class.class_session_id = general_1_session.session_id 
        
        
        JOIN
        
        student_0_db
        
        ON
        
        student_1_attendence.attendence_student_id = student_0_db.student_id
        ";
        $stmt = $this->connect()->query($sql);
        $output = "";
        while($row = $stmt->fetch()){
         echo 
         
         "<tr>".
         "<td>".""."</td>".
         "<td>".$row["attendence_date"]."</td>".
         "<td>".$row["class_day"]."</td>".
         "<td>".$row["class_time"]."</td>".
         "<td>".$row["center_name"]."</td>".
         "<td>".$row["session_name"]."</td>".
         "<td>".$row["student_name"]."</td>".
         "</tr>";
        
        }
        
    }
}
?>