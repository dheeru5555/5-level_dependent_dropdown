<?php 

$conn = mysqli_connect("localhost","root","","mulitiple_dropdown");

$cityID = $_POST['cityID'];


$sql = "SELECT stadium.stadium_name,address.stadium_add from city
        JOIN stadium ON city.id = stadium.city_id 
        JOIN address ON city.id = address.city_id
        WHERE city.id  = $cityID";

$query = mysqli_query($conn,$sql);

$output =array();

while($row=mysqli_fetch_assoc($query))
 {
     $output[] = $row;
 
 }
 echo json_encode($output);



?>