<?php require_once("../includes/session.php"); ?>
<?php require_once("../includes/db_connection.php"); ?>
<?php require_once("../includes/functions.php"); ?>

<?php
	$current_page_id= $_GET["page"];
	if (!$current_page_id) {
		redirect_to("manage_content.php");
	}

  $query = "DELETE FROM pages WHERE id = {$current_page_id} LIMIT 1 ";
  $result = mysqli_query($connection,$query) ;
  if ($result && mysqli_affected_rows($connection) == 1) {
  	$_SESSION["message"] = "Page Deleted." ;
  	redirect_to("manage_content.php");
  }else {
  	$_SESSION["message"] = "Page deletion failed {$current_page_id}";
  	redirect_to("manage_content.php");
  }

 ?>
