<?php 

require '../../../dbh.class.php';
require "../classes/4.0_student_database_management.model.class.php";
require "../classes/4.0_student_database_management.view.class.php";
require '../classes/4.0_student_database_management.contr.class.php';
$action = $_POST["action"];


// DISPLAY 
if($action =="display"){
    $display_student = new STUDENT_DATABASE_MANAGEMENT_VIEW();
    $display_student->v_display_student();
}
// SEARCH
if($action =="search"){
    $search = $_POST["search_data"];
    $search_student = new STUDENT_DATABASE_MANAGEMENT_VIEW();
    $search_student->v_search_student($search);
}
// INSERT
if($action =="insert"){
    $student_name = $_POST["student_name"]; //1
    $student_ic = $_POST["student_ic"]; //2
    $student_grade = $_POST["student_grade"]; //3
    $student_center_id = $_POST["student_center_id"]; //4
    $student_address = $_POST["student_address"]; //5
    $student_tel_no = $_POST["student_tel_no"]; //6
    $student_email = $_POST["student_email"]; //7

    $insert_student_func = new STUDENT_DATABASE_MANAGEMENT_CONTR();
    $insert_student_func->c_insert_student
    ($student_name,$student_ic,$student_grade,$student_center_id,$student_address,
    $student_tel_no, $student_email);
}

// FETCH_EDIT
if($action =="fetch_edit"){
    $fetch_edit_data = $_POST["fetch_edit_data"];
    $fetch_edit_student_func = new STUDENT_DATABASE_MANAGEMENT_CONTR();
    $fetch_edit_student_func->c_fetch_edit_student($fetch_edit_data);
}

// EDIT
if($action =="edit"){
    
    $student_id = $_POST["student_id"]; 
    $student_name = $_POST["student_name"]; 
    $student_ic = $_POST["student_ic"]; 
    $student_grade = $_POST["student_grade"]; 
    $student_center_id = $_POST["student_center_id"]; 
    $student_address = $_POST["student_address"]; 
    $student_tel_no = $_POST["student_tel_no"];
    $student_email = $_POST["student_email"]; 
    
    $edit_student_func = new STUDENT_DATABASE_MANAGEMENT_CONTR();
    $edit_student_func->c_edit_student($student_id,$student_name,$student_ic,$student_grade,$student_center_id,$student_address,$student_tel_no, $student_email);
}


?>