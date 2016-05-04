<?php require_once("../includes/session.php"); ?>
<?php require_once("../includes/db_connection.php"); ?>
<?php require_once("../includes/functions.php"); ?>
<?php require_once("../includes/validation_functions.php"); ?>



<?php 
	$username = "";
	if (isset($_POST["submit"])) {

		$required_fields= array("username", "hashed_password");
		validate_presences($required_fields);

		if (empty($errors)) {
			$username = $_POST["username"];
			$hashed_password = $_POST["hashed_password"];
			$found_admin = attempt_login($username, $hashed_password);

			if ($found_admin) {
				$_SESSION["admin_id"] = $found_admin["id"];
				$_SESSION["username"] = $found_admin["username"];
				redirect_to("admin.php"); 
			} else {
				$_SESSION["message"] = "Username / Password not found";
			}
		}
	}
?>

<?php $layout_context = true ?>
<?php include("../includes/layouts/header.php"); ?>

<div id="main">
	<div id="navigation">
		<br>
		
		<br>
	</div>
	<div id="page">
		<?php echo message(); ?>
		<?php echo form_errors($errors); ?>

		<form action="login.php" method="post">
			<h2> Login </h2>
			<p>
				Username:
				<input type="text" name="username" value="<?php echo $username ;?>" ?>
			</p>
			<p>
				Password:
				<input type="password" name="hashed_password" value="" />
			</p>
			<p>
				<input type="submit" name="submit" value="Log In"/>
			</p>
		</form>
				
	</div>
</div>

<?php include("../includes/layouts/footer.php"); ?>
