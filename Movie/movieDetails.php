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

	/**
	* Rest part
	*/

	$id = $_GET['id'];

	$result = mysql_query("SELECT mo.movie_id, mo.city_id, mo.movie_name, mo.`showtiming`, mo.`date`, ct.city_id, ct.`city_name`, th.theatre_name FROM movie AS mo INNER JOIN city AS ct ON mo.city_id  = ct.`city_id` INNER JOIN theatre AS th ON mo.`theatre_id` = th.`theatre_id` WHERE mo.`movie_id` = '$id'");




?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
	<style type="text/css">
	body {
		margin: 0px;
		padding: 0px;
	}
		/*
	 * To see in action, go to http://jsfiddle.net/seydoggy/9jv5e8d1/
	 */
	.panel-horizontal {
	    display:table;
	    width:100%;
	}
	.panel-horizontal > .panel-heading, .panel.panel-horizontal > .panel-body, .panel.panel-horizontal > .panel-footer {
	    display:table-cell;
	}
	.panel-horizontal > .panel-heading, .panel.panel-horizontal > .panel-footer {
	    width: 25%;
	    border:0;
	    vertical-align: middle;
	}
	.panel-horizontal > .panel-heading {
	    border-right: 1px solid #ddd;
	    border-top-right-radius: 0;
	    border-bottom-left-radius: 4px;
	}
	.panel-horizontal > .panel-footer {
	    border-left: 1px solid #ddd;
	    border-top-left-radius: 0;
	    border-bottom-right-radius: 4px;
	}
	</style>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">

<!-- Optional theme -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css" integrity="sha384-fLW2N01lMqjakBkx3l/M9EahuwpSfeNvV63J5ezn3uZzapT0u7EYsXMjQV+0En5r" crossorigin="anonymous">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
<!-- Latest compiled and minified JavaScript -->
 <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
</head>
<body>
	<nav class="navbar navbar-default navbar-fixed-top" style="background: #e74c3c;
    color: #fff;
    height: 38px;
    padding: 1px;;">
  <div class="container">
    <p class="navbar-text" style="color:white;"><?php echo $userRow['username']; ?></p>
    <p class="navbar-text navbar-right"></p>
  </div>
</nav>
<div class="row">
	<div class="col-md-12">
		<div class="col-md-5" style="float: none;margin: 62px 17px;">	
			<div class="panel panel-default">
	  <!-- Default panel contents -->
			<?php	while ($row = mysql_fetch_assoc($result)) { ?>  
			  <div class="panel-heading">Details of  <?php echo $row['movie_name'] ?></div>
			  <div class="panel-body">
			    <p>...</p>
			  </div>

			  <!-- List group -->
			  <ul class="list-group">
			    
			    <li class="list-group-item"><b>Theatre name:</b> <?php echo $row['theatre_name'] ?></b></li>
			    <li class="list-group-item"><b>City name:</b> <?php echo $row['city_name'] ?></li>
			    <li class="list-group-item"><b>Show timing:</b> <?php echo $row['showtiming'] ?></li>
			    <li class="list-group-item"><b>Date:</b> <?php echo $row['date'] ?></li>
			  </ul>
			<?php } ?> 
			</div>
		</div>	
</div>


</div>

</body>
</html>