 <?php 

  $conn = mysqli_connect("localhost","root","","mulitiple_dropdown");

 ?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>Bootstrap Example</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>
<body>

<div class="container">
  <h3 class="text-center mt-4">Select State List</h3>
  <div class="row mt-5">

    <div class="col-sm-2">
      <h5 class="text-info mb-4">Choose State List</h5>
      <select name="" id="state" class="form-control">
        <option><h1>Select State</h1></option>
        <?php $sql = "SELECT * from states"; 
              $query = mysqli_query($conn,$sql);
              while($row=mysqli_fetch_assoc($query))
               { ?>
                 <option value="<?php echo $row['id'] ?>"><?php echo $row['state_name'] ?></option>
            <?php } ?>
      </select>
    </div>
 
    <div class="col-sm-3">
        <h5 class="text-info  mb-4"> City List</h5>
        <select  id="city" class="form-control" disabled >
          <option>City List</option>
       </select>
    </div>
    <div class="col-sm-3">
        <h5 class="text-info  mb-4">Stadiums List</h5>
        <select  id="stadium" class="form-control" disabled>
       </select>
    </div>
    <div class="col-sm-4">
        <h5 class="text-info  mb-4">Stadiums Address</h5>
        <select id="address" class="form-control" disabled>
       </select>
    </div>
  </div>
</div>

</body>
</html>

<script>
// Get City List 

  $(document).ready(function(){
    $('#state').change(function(){
       var state = $('#state').val();
       $('#city').html('');
        $.ajax({
          url:'fetch_records.php',
          type:'POST',
          data:{stateName:state},
          dataType: "json",
          success:function(data)
          {
            $.each(data, function(key, city)
             {     
              $('#city').prop('disabled', false).css('background','aliceblue').append('<option value="'+city.id+'">'+city.city_name+'</option>');
            });
          }
      });
    });
  });

  // Get STADIUM and ADDRESS by CITY

  $(document).ready(function(){
    $('#city').change(function(){
       var city = $('#city').val();
       $.ajax({
          url:'get_stadium_address.php',
          type:'POST',
          data:{cityID:city},
          dataType: "json",
          success:function(data)
          {
            $.each(data, function(key, city)
             {     
              $('#stadium').prop('disabled', false).css('background','aliceblue').html('<option>'+city.stadium_name+'</option>');
              $('#\').prop('disabled', false).css('background','aliceblue').html('<option>'+city.stadium_add+'</option>');
            });
          }
      });
    });
  });
</script>  