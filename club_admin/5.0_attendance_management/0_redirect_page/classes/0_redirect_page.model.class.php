<?php
class CLASS_DISPLAY_MODEL extends Dbh{

    //CLASS (CLASS_DISPLAY_MODEL) FUNC DISPLAY (CLASS)
    public function m_display_class($today){
        $sql = "SELECT general_3_class.* ,general_0_center.* , general_1_session.* FROM general_3_class INNER JOIN general_0_center  ON general_3_class.class_center_id = general_0_center.center_id  INNER JOIN general_1_session ON general_3_class.class_session_id = general_1_session.session_id WHERE general_3_class.class_day = ?"  ;
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$today]);
        while($row = $stmt->fetch()){
            $json_array[] = $row;
        }
        echo json_encode($json_array); 
    }
}
?>