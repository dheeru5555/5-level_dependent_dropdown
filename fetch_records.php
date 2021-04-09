<?php 

$conn = mysqli_connect("localhost","root","","mulitiple_dropdown");

$getCity = $_POST['stateName'];

$sql = "SELECT city.* from states JOIN city ON states.id = city.state_id WHERE states.id = $getCity";

$query = mysqli_query($conn,$sql);

$output =array();

while($row=mysqli_fetch_assoc($query))
 {
     $output[] = $row;
    
 }
 echo json_encode($output);



?>