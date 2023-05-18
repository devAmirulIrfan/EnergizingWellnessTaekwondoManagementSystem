<?php
class ATTENDENCE_MANAGEMENT_CONTR extends ATTENDENCE_MANAGEMENT_MODEL{ 

   //CLASS (ATTENDENCE_MANAGEMENT_MODEL)-->(ATTENDENCE_MANAGEMENT_CONTR) FUNC INSERT (ATTENDENCE)
    public function c_insert_attendence($date,$class_id,$student_id){
        $this->m_insert_attendence($date,$class_id,$student_id);  
    }

     //CLASS (ATTENDENCE_MANAGEMENT_MODEL)-->(ATTENDENCE_MANAGEMENT_CONTR) FUNC DELETE (ATTENDENCE)
    public function c_delete_attendence_func($date,$class_id,$student_id){
        $this->m_delete_attendence_func($date,$class_id,$student_id);  
       }
}