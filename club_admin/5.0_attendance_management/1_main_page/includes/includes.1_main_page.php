<?php 
session_start();

$date = $_SESSION["date"];
$class_id = $_SESSION["class_id"];

require '../../../../dbh.class.php';
require "../classes/1_main_page.model.class.php";
require '../classes/1_main_page.contr.class.php';
require "../classes/1_main_page.view.class.php";
$action = $_POST["action"]; 

// SEARCH
if($action =="search"){
    $search = $_POST["search_data"];
    $search_student_func = new ATTENDENCE_MANAGEMENT_VIEW();
    $search_student_func->v_search_student($search);
}
// INSERT
if($action =="insert"){
    $student_id = $_POST["student_id"];
    $insert_attendence_func = new ATTENDENCE_MANAGEMENT_CONTR();
    $insert_attendence_func->c_insert_attendence($date,$class_id,$student_id);
}
// DISPLAY CLASS TITLE
if($action =="display_class_title"){
    $display_class_title_func = new ATTENDENCE_MANAGEMENT_VIEW();
    $display_class_title_func->v_display_class_title_func($class_id);
}
// DISPLAy ATTENDENCE
if($action =="display_attendence"){
    $display_attendence_func = new ATTENDENCE_MANAGEMENT_VIEW();
    $display_attendence_func->v_display_attendence($date,$class_id);
}
// DELETE ATTENDENCE
if($action =="delete_attendence"){
    $student_id = $_POST["delete_data"];
    $delete_attendence_func = new ATTENDENCE_MANAGEMENT_CONTR();
    $delete_attendence_func->c_delete_attendence_func($date,$class_id,$student_id);
}
?>