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

$rest = mysql_query("SELECT seat, movie_id, theatre_id, DATE, TIME FROM seats WHERE movie_id = '$id'");

$rows = array();

while ($r = mysql_fetch_assoc($rest)) {
	$rows = $r;
}

print json_encode($rows);

function seatReserved () {
	$val = "dwa";
	print json_encode($val);
}