<?php

//In This File All Other Files Will Be Included So That We can Include This Single File To Other Files That We'll Work With
include 'connection.php';
include 'project-settings.php';
include 'crud-operation.php';
include 'date-time.php';
include 'file-operations.php';



// this function will refresh the page 
// this can be used to stop Form Resubmmision in POST method
function refresh() {
    $page = $_SERVER['REQUEST_URI'];
//    $page = $_SERVER['PHP_SELF'];
    echo "<script>window.location='$page';</script>";
}

//this function will be used to redirect to the page 
function move($page) {
    echo "<script>window.location='$page';</script>";
}


