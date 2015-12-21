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
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Welcome - <?php echo $userRow['email']; ?></title>
<link rel="stylesheet" href="style.css" type="text/css" />
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">

<!-- Optional theme -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css" integrity="sha384-fLW2N01lMqjakBkx3l/M9EahuwpSfeNvV63J5ezn3uZzapT0u7EYsXMjQV+0En5r" crossorigin="anonymous">

<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
</head>
<body>
<div id="header">
  <div id="left">
    <label>cleartuts</label>
    </div>
    <div id="right">
      <div id="content">
          hi' <?php echo $userRow['username']; ?>&nbsp;<a href="logout.php">Sign Out</a>
        </div>
    </div>
</div>

<div id="body">
  <table class="table table-striped"> 
    <thead> 
      <tr> 
        <th>Movie Name</th> 
        <th>Movie price</th> 
        <th>City</th> 
       </tr> 
     </thead> 
     <tbody> 
    <?php 

       $res=mysql_query("SELECT mo.`movie_id`, mo.`movie_name`, mo.`price`, ci.`city_name`  FROM movie AS mo INNER JOIN city AS ci ON mo.`city_id` = ci.`city_id` ");
        // $movie=mysql_fetch_array($res);
    

     while ($row = mysql_fetch_assoc($res)) {
        echo "<tr>";
        echo "<td>". $row['movie_name']. "</td>";
        echo "<td>". $row['price']. "</td>";
        echo "<td>". $row['city_name']. "</td>";
        echo "</tr>";
     } 


            ?>
    </tbody> 
  </table>
</div>

</body>
</html>