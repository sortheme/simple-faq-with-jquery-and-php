<?php 
//  here we should connect to database and update table
require 'connection.php';
$faqs = $_POST['faqs'];
$faqs = rtrim($faqs, '|');

$query = "UPDATE faqs SET faqs='$faqs' WHERE page_id = 12";
$result = mysqli_query($con, $query);
echo('<pre style=direction:ltr;text-align:left>');var_dump($faqs);echo('</pre>');
