<?php 
	$dbhost = "localhost";
	$dbuser = "widget_cms";
	$dbpass = "sebi";
	$dbname = "widget_corp";
	$connection = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);

	if(mysqli_connect_errno()) {
		die("Database connection failed:" . mysqli_connect_error() . " (" . mysqli_connect_errno() . ")"
		);
	}
?>

<?php
	$menu_name = "Edit Me";
	$position = 4 ;
	$visible = 1 ;
	$query= "INSERT INTO subjects (menu_name, position, visible) VALUES ('{$menu_name}',{$position}, {$visible}) ";
	$result = mysqli_query($connection, $query);
	if ($result) {
		echo "Success";
	} else {
		die("Database Failed." . mysqli_error($connection));
	}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
   "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
  <title> Index</title>
</head>
<body> 
	<h1> Databases </h1>
	
</body>
</html>

<?php
	mysqli_close($connection)
?>