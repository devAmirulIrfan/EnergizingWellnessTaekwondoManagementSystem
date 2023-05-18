<?php
class STUDENT_DATABASE_MANAGEMENT_VIEW extends STUDENT_DATABASE_MANAGEMENT_MODEL{

    //CLASS (STUDENT_DATABASE_MANAGEMENT)-->(STUDENT_DATABASE_MANAGEMENT_VIEW) FUNC DISPLAY (STUDENT)
   public function v_display_student(){
       $this->m_display_student();
   }

    //CLASS (STUDENT_DATABASE_MANAGEMENT)-->(STUDENT_DATABASE_MANAGEMENT_VIEW) FUNC SEARCH (STUDENT)
    public function v_search_student($search){
        $this->m_search_student($search);
    }
}
?>