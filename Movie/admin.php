<?php
session_start();
$host="localhost"; // Host name 
$username="root"; // Mysql username 
$password=""; // Mysql password 
$db_name="movie_booking"; // Database name 
// Connect to server and select databse.
$con = mysql_connect("$host", "$username", "$password")or die("cannot connect"); 
mysql_select_db("$db_name")or die("cannot select DB");

if(!isset($_SESSION['user']))
{
  // header("Location: index.php");
}
$res=mysql_query("SELECT * FROM users WHERE user_id=".$_SESSION['user']);
$userRow=mysql_fetch_array($res);

if (isset($_POST['sbt'])) {
  $user = $_POST['usr'];
  $movie_id = $_POST['mov'];

  $user = $userRow['user_id'];

  $tickets = $_POST['tickets'];

  $resultAll = "INSERT INTO use_books(movie_id, user_id, tickets) VALUES ('$movie_id', '$user', '$tickets')";
  $retval = mysql_query( $resultAll, $con );
  if ($retval) {
    header('location', 'admin.php');
    mysql_close($con);
  }


};

$uses = $userRow['user_id'];

$selectBasket = mysql_query("SELECT * FROM use_books where user_id = '$uses'");
$num_rows = mysql_num_rows($selectBasket);

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
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
<!-- Latest compiled and minified JavaScript -->
 <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
  <script type="text/javascript">
  $(document).ready(function(){
      $("#filter").keyup(function(){
   
          // Retrieve the input field text and reset the count to zero
          var filter = $(this).val(), count = 0;
   
          // Loop through the comment list
          $("tbody tr").each(function(){
   
              // If the list item does not contain the text phrase fade it out
              if ($(this).text().search(new RegExp(filter, "i")) < 0) {
                  $(this).fadeOut();
   
              // Show the list item if the phrase matches and increase the count by 1
              } else {
                  $(this).show();
                  count++;
              }
          });
   
          // Update the count
          var numberItems = count;
          $("#filter-count").text("Number of Comments = "+count);
      });
  });
  </script>
  <style type="text/css">
  a {
    color:white;
    text-decoration: none;
  }
  a:hover {
    color:white;
  }

  p {
    color:black;
  }
  .la {
    color: white;
  }
  </style>
</head>
<body>
<!-- <div id="header">
  <div id="left">
    <label>cleartuts</label>
    </div>
    <div id="right">
      <div id="content">
         <a href="logout.php">Sign Out</a>
        </div>
    </div>
    
</div> -->
<nav class="navbar navbar-default navbar-fixed-top" style="background:#e74c3c;color:#fff;">
  <div class="container">
    <p class="navbar-text" style="color:white;"><?php echo $userRow['username']; ?></p>
    <p class="navbar-text navbar-right"><a href="mybasket.php?id='"<?php $_SESSION['user']; ?>"'">My basket (<?php echo $num_rows; ?>)</a> <a href="logout.php" class="navbar-link la" style="color:white;">Log out</a></p>
  </div>
</nav>
<div id="body">
   <input type="text" class="text-input" id="filter" value="" />
    <span id="filter-count"></span>
  <table class="table table-striped"> 
    <thead> 
      <tr> 
        <th>Movie Name</th> 
        <th>Movie price</th> 
        <th>City</th> 
        <th>Bookings</th>
       </tr> 
     </thead> 
     <tbody> 
    <?php 

       function getRes () {
         $res=mysql_query("SELECT mo.`movie_id`, mo.`movie_name`, mo.`price`, ci.`city_name`  FROM movie AS mo INNER JOIN city AS ci ON mo.`city_id` = ci.`city_id` ");  
       };

       $res=mysql_query("SELECT mo.`movie_id`, mo.`movie_name`, mo.`price`, ci.`city_name`  FROM movie AS mo INNER JOIN city AS ci ON mo.`city_id` = ci.`city_id` ");
        // $movie=mysql_fetch_array($res);
    

     while ($row = mysql_fetch_assoc($res)) {
        echo "<tr>";
        echo "<td><a style='color:black;' href='movieDetails.php?id=".$row['movie_id']."'>". $row['movie_name']. "</a></td>";
        echo "<td>". $row['price']. "</td>";
        echo "<td>". $row['city_name']. "</td>";
        echo "<td><a  style='color:black;' id='".$row['movie_id']."' onclick='thisFunc(this.id);' >Book this ticket</a></td>";
        echo "<td><form action='admin.php' method='POST'><input type='text' style='display:none' name='tickets' id='field".$row['movie_id']."'><input type='text' style='display:none' name='mov' value='".$row['movie_id']."' id='fi".$row['movie_id']."'><input type='text' style='display:none' name='usr' value='".$row['movie_id']."' id='fm".$row['movie_id']."'><input type='submit' value='Book' style='display:none' class='btn btn-success' name='sbt' id='button".$row['movie_id']."'></form></td>";
        echo "</tr>";
     } 


            ?>
    </tbody> 
  </table>
</div>
  <script type="text/javascript">
    function thisFunc (val) {
      $("#field" + val).show();
      $("#button" + val).show();    
    };
  </script>
</body>
</html>