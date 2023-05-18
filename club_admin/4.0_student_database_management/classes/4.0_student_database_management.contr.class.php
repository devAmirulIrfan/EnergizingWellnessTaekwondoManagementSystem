<?php
class STUDENT_DATABASE_MANAGEMENT_CONTR extends STUDENT_DATABASE_MANAGEMENT_MODEL{

     //CLASS (STUDENT_DATABASE_MANAGEMENT_MODEL)-->(STUDENT_DATABASE_MANAGEMENT_CONTR) FUNC INSERT (STUDENT)
   public function c_insert_student($student_name,$student_ic,$student_grade,
   $student_center_id,$student_address,$student_tel_no,$student_email){
    $this->m_insert_student($student_name,$student_ic,$student_grade,
    $student_center_id,$student_address,$student_tel_no,$student_email);  
   }
   
 //CLASS (STUDENT_DATABASE_MANAGEMENT_MODEL)-->(STUDENT_DATABASE_MANAGEMENT_CONTR) FUNC FETCH EDIT (STUDENT)
  public function c_fetch_edit_student($fetch_edit_data){
    $this->m_fetch_edit_student($fetch_edit_data);   
  }

//CLASS (STUDENT_DATABASE_MANAGEMENT_MODEL)-->(STUDENT_DATABASE_MANAGEMENT_CONTR) FUNC EDIT (STUDENT)
public function c_edit_student($student_id,$student_name,$student_ic,$student_grade,$student_center_id,$student_address,$student_tel_no, $student_email){
  $this->m_edit_student($student_id,$student_name,$student_ic,$student_grade,$student_center_id,$student_address,$student_tel_no, $student_email);  
}


}

?>