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
	  header("Location: index.php");
	}
	$res=mysql_query("SELECT * FROM users WHERE user_id=".$_SESSION['user']);
	$userRow=mysql_fetch_array($res);


	$id = $_GET['id'];

	$ticket = $_POST['ticket'];

	$sql = "UPDATE use_books set tickets='$ticket' WHERE id='$id'";

	$res = mysql_query($sql, $con);

	if ($res) {
		return true;
	} else {
		return false;
	}

	$con->close();

?>