<?php
$host="localhost";
$user="root";
$pass="";
$db="grapara";
$conn=mysqli_connect($host,$user,$pass,$db);

if(mysqli_connect_error()){
	echo"not connected";
}
?>