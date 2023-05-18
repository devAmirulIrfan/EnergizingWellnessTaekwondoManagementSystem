<?php 
require '../../../../dbh.class.php';
require '../classes/0_redirect_page.model.class.php';
require "../classes/0_redirect_page.view.class.php";
$action = $_POST["action"]; 

// DISPLAY 
if($action =="display"){
    $today = $_POST["today"];
    $display_classes_func = new CLASS_DISPLAY_VIEW();
    $display_classes_func->v_display_class($today);
}
// GET CLASS 
if($action =="get_class"){
    $class_id = $_POST["get_class__data"];
    session_start();
    $_SESSION["class_id"] = $class_id;
    $_SESSION["date"] = date("Y-m-d");

    echo "ok";

}
?>