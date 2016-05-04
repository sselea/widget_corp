<?php require_once("../includes/session.php"); ?>
<?php require_once("../includes/db_connection.php"); ?>
<?php require_once("../includes/functions.php"); ?>
<?php require_once("../includes/validation_functions.php"); ?>
<?php $layout_context = true ?>
<?php include("../includes/layouts/header.php"); ?>


<?php 
	if (isset($_POST["submit"])) {

		$username = $_POST["username"];
		$hashed_password = password_encrypt($_POST["hashed_password"]);

		$required_fields= array("username", "hashed_password");
		validate_presences($required_fields);

		$fields_with_max_length = array("username" => 30);
		validate_max_lengths($fields_with_max_lengths);

		if (!empty($errors)) {
			$_SESSION["errors"] = $errors;
			redirect_to("new_admin.php");
		}

		$query = "INSERT INTO admins (" ;
		$query .= "username, hashed_password" ;
		$query .= ") VALUES (";
		$query .= "\"{$username}\", \"{$hashed_password}\"";
		$query .= ")";
		$result = mysqli_query($connection,$query);

		if ($result) {
			$_SESSION["message"] = "New user created";
			redirect_to("manage_admins.php");
		} else {
			$message = "New user creation failed !";
		}
	}
?>


<div id="main">
	<div id="navigation">
		<br>
		
		<br>
	</div>
	<div id="page">
		<?php echo message(); ?>
		<?php echo form_errors($errors); ?>

		<form action="new_admin.php" method="post">
			<h2> Sign Up </h2>
			<p>
				Username:
				<input type="text" name="username" value="" ?>
			</p>
			<p>
				Password:
				<input type="password" name="hashed_password" value="" />
			</p>
			<p>
				<input type="submit" name="submit" value="Create User"/>
			</p>
		</form>
				
	</div>
</div>

<?php include("../includes/layouts/footer.php"); ?>
