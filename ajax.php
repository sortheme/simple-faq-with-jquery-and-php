<?php 
// TODO:: if page is new then no record is in table, so we cant use update
// and should use insert into first. we need to set page_id somehow.
//  here we should connect to database and update table
require 'connection.php';
$faqs = $_POST['faqs'];
$faqs = rtrim($faqs, '|');
$page_id = intval($_POST['page_id']);
if(!$page_id){
    echo 'page_id_error';
    exit();
}
// check if any record with current page_id exists
$already = mysqli_query($con, "SELECT id FROM faqs WHERE page_id = '$page_id'");
if(!empty($faqs)){
    if(mysqli_num_rows($already)){
        $query = "UPDATE faqs SET faqs='$faqs' WHERE page_id = '$page_id'";
        $result = mysqli_query($con, $query);
    }else{
        $query = "INSERT INTO faqs (page_id, faqs) VALUES('$page_id', '$faqs')";
        $result = mysqli_query($con, $query);
    }
}else{
    $query = "DELETE FROM faqs WHERE page_id = '$page_id'";
    $result = mysqli_query($con, $query);
}

echo $result;
die();