<?php
class ATTENDENCE_MANAGEMENT_VIEW extends ATTENDENCE_MANAGEMENT_MODEL{

    //CLASS (ATTENDENCE_MANAGEMENT_MODEL)-->(ATTENDENCE_MANAGEMENT_VIEW) FUNC SEARCH (STUDENT)
    public function v_search_student($search){
        $this->m_search_student($search);
    }
    //CLASS (ATTENDENCE_MANAGEMENT_MODEL)-->(ATTENDENCE_MANAGEMENT_VIEW) FUNC DISPLAY (ATTENDENCE)
    public function v_display_attendence($date,$class_id){
        $this->m_display_attendence($date,$class_id);
    }
    

     //CLASS (ATTENDENCE_MANAGEMENT_MODEL)-->(ATTENDENCE_MANAGEMENT_VIEW) FUNC DISPLAY (CLASS TITLE)
     public function v_display_class_title_func($class_id){
        $this->m_display_class_title_func($class_id);
    }

}
?>