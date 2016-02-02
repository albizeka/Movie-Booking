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

 ?>
<!DOCTYPE html>
 <html>
 <head>
 	<title></title>
 </head>
 <body>
 	<div id="body">
  <table class="table table-striped"> 
    <head>
	 <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>Welcome - <?php echo $userRow['email']; ?></title>
	<link rel="stylesheet" href="style.css" type="text/css" />
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">

	<!-- Optional theme -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css" integrity="sha384-fLW2N01lMqjakBkx3l/M9EahuwpSfeNvV63J5ezn3uZzapT0u7EYsXMjQV+0En5r" crossorigin="anonymous">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
	<!-- Latest compiled and minified JavaScript -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>

  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
  <style type="text/css">
    #header {
      width: 100%;
      height: auto;
      background: #e74c3c;
      padding: 0px;
      bottom: -10px;
      float: left;
      color: #ecf0f1;
    }
  </style>
</head> 
	<div id="header">
    <h1 class="text-center">My Basket</h1>
  </div> 
    <table class="table table-striped"> 
    <thead> 
      <tr> 
        <th>Movie Name</th> 
        <th>Price</th> 
        <th>Date</th> 
        <th>Tickets</th>
        <th>Total</th>
       </tr> 
     </thead> 
     <tbody>     
    <?php 


       $res=mysql_query("SELECT mo.movie_name, mo.date, ub.id, ub.tickets, mo.price, ub.`user_id` FROM movie AS mo INNER JOIN use_books ub ON ub.`movie_id` = mo.`movie_id` WHERE ub.`user_id` = '".$_SESSION['user']."'  GROUP BY mo.`movie_name`");
        // $movie=mysql_fetch_array($res);
    

     while ($row = mysql_fetch_assoc($res)) {
        echo "<tr>";
        echo "<td>". $row['movie_name']. "</td>";
        echo "<td>". $row['price']. "</td>";
        echo "<td>". $row['date']. "</td>";
        echo "<td>". $row['tickets']. "</td>";
        echo "<td>". $row['tickets'] * $row['price']."</td>";
        echo "<td><i style='padding:1px 6px;' data-toggle='modal' id='".$row['id']."' data-id='".$row['tickets']."' data-target='.bs-example-modal-sm' class='fa fa-pencil edit' onclick='thisFunc(this);'></i><i id='".$row['id']."' data-id='".$row['tickets']."' onclick='deleteFunc(this)' class='fa fa-trash'></i></td>";
        echo "</tr>";
     } 
            ?>
    </tbody> 
  </table>

  <div class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
      <div class="modal-header">
        <div class="modal-title">Edit number of tickets</div>
      </div>
      <div class="modal-body">
          <div class="form-group">
            <label for="exampleInputPassword1">Tickets</label>
            <input type="text" name="ticket" class="form-control" id="price">
            <input type="hidden" name="hiden" class="form-control" value="<?php echo $row['id']; ?>" id="hiden">
          </div>
      </div>
      <div class="model-footer">
        <input type="submit" class="btn btn-success" onclick="updateFunc(this)" value="Save">
      </div>
    </div>
  </div>
</div>
</div>
<script type="text/javascript">
    function thisFunc (param) {
      document.getElementById('hiden').value = param.id;
      $.ajax({
        url: 'mybookedEdit.php?id=' + param.id,
        method: 'GET',
        success: function (response) {
          document.getElementById('price').value = response; 
        
        }
      });
    }

    function updateFunc (param) {
      var id = document.getElementById('hiden').value;
      var ticket = document.getElementById('price').value;
      $.ajax({
        url: 'editBooked.php?id=' + id,
        method: 'POST',
        data: {ticket: ticket},
        success: function (response) {
         $('.modal').modal('hide');
         location.reload();
        }
      });

    }

    function deleteFunc (param) {
      var ticket = document.getElementById('price').value;
      $.ajax({
        url: 'deleteBooked.php?id='+param.id,
        method: 'DELETE',
        success:function () {
          location.reload();
        }
      });
    }

</script>
 </body>
 </html> 