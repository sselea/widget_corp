<?php require_once("../includes/session.php"); ?>
<?php require_once("../includes/db_connection.php"); ?>
<?php require_once("../includes/functions.php"); ?>

<?php 
	$admin_id = $_GET["admin"];
	if (!$admin_id) {
		redirect_to("manage_admins.php");
	}

	$query = "DELETE FROM admins WHERE id = {$admin_id} LIMIT 1"; 
	$result = mysqli_query($connection, $query);
	if ($result && mysqli_affected_rows($connection) == 1) {
		$_SESSION["message"] = "Admin Deleted";
		redirect_to("manage_admins.php");
	} else {
		$_SESSION["message"] = "Admin Deletion Failed";
		redirect_to("manage_admins.php");
	}
?>
