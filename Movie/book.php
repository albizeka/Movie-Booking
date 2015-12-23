<?php
session_start();
$host="localhost"; // Host name 
$username="root"; // Mysql username 
$password=""; // Mysql password 
$db_name="movie_booking"; // Database name 
// Connect to server and select databse.
 mysql_connect("$host", "$username", "$password")or die("cannot connect"); 
mysql_select_db("$db_name")or die("cannot select DB");

if(!isset($_SESSION['user']))
{
  // header("Location: index.php");
}
$res=mysql_query("SELECT * FROM users WHERE user_id=".$_SESSION['user']);
$userRow=mysql_fetch_array($res);

$id = $_GET['id'];

$res2 = mysql_query("SELECT mo.movie_id, mo.movie_name, se.movie_id, se.`theatre_id`, se.date, se.time FROM movie AS mo INNER JOIN seats AS se WHERE mo.movie_id= '$id'");
$byUser = mysql_fetch_array($res2);

 

 ?>

<!DOCTYPE html>
<html>
<head>
  <title></title>
  <link rel="stylesheet" href="style.css" type="text/css" />
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>

  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">

  <!-- Optional theme -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css" integrity="sha384-fLW2N01lMqjakBkx3l/M9EahuwpSfeNvV63J5ezn3uZzapT0u7EYsXMjQV+0En5r" crossorigin="anonymous">

  <!-- Latest compiled and minified JavaScript -->
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
</head>
<body>
<h1>Book this <?php echo $byUser['movie_name']; ?></h1>
<br>
<div class="row">
  <div class="col-md-12">
    
  <?php 
    for ($i=1; $i < 13 ; $i++) {  
      ?>
        <button class="btn btn-success" id="button<?php echo $i; ?>" value="<?php echo $i; ?>" class="seat" onclick="myFunction(this.value)">Book this seat</button>    

   <?php 
      }
  ?>


  </div>
</div>
<script>
function myFunction(val) {
   $.ajax({
    url: 'getSeats.php?id=' + val,
    type: 'GET',
    success: function (response) {
      console.log(response);
    }
   });

}
</script>
</body>
</html>