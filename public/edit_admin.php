<?php require_once("../includes/session.php"); ?>
<?php require_once("../includes/db_connection.php"); ?>
<?php require_once("../includes/functions.php"); ?>
<?php require_once("../includes/validation_functions.php"); ?>
<?php $admin = find_admin_by_id(); ?>


<?php 
	if (isset($_POST["submit"])) {

		$required_fields = array("username", "hashed_password"); 
		validate_presences($required_fields); 

		$fields_with_max_lengths = array("username" => 20);
		validate_max_lengths($fields_with_max_lengths);

		if (empty($errors)) {
			$username = $_POST["username"];
			$hashed_password = password_encrypt($_POST["hashed_password"]);
			$id = $admin["id"];

			$query = "UPDATE admins SET username =\"{$username}\", hashed_password =\"{$hashed_password}\" WHERE id = {$id}";
			$result = mysqli_query($connection,$query);

			if ($result && mysqli_affected_rows($connection) == 1) {
				$_SESSION["message"] = "Admin edited";
				redirect_to("manage_admins.php");
			}else {
				$message = "Subject Failed";
			}
		}
	}
?>

<?php $layout_context = "admin" ?>
<?php include("../includes/layouts/header.php"); ?>
<div id="main">
	<div id="navigation">
	</div>
	<div id="page">
			<?php 
				if (!empty($message)) {
					echo "<div class=\"message\">" . $message . "</div>";
				}  
			?>

			<?php echo form_errors($errors);?>

			<h2> Edit Admin : <?php echo $admin["username"] ;?> </h2>
			

			<form action="edit_admin.php?admin=<?php echo $admin["id"];?>" method="post">
					<p> Username : 
						<input type="text" name="username" value="<?php echo $admin["username"]; ?>" />
					</p>
					<p> Password: 
						<input type="password" name="hashed_password" value="" />
					</p>
					<input type="submit" value="Edit Admin" name="submit" />
			</form>
				<br>
				<a href="manage_admins.php"> Cancel </a>
				||
				<a href="delete_admin.php?admin=<?php echo $admin["id"]; ?>" onclick="return confirm('Are you sure you want to delete');"> Delete Admin </a>
	</div>
</div>

<?php include("../includes/layouts/footer.php"); ?>
