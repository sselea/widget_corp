<?php require_once("../includes/session.php"); ?>
<?php require_once("../includes/db_connection.php"); ?>
<?php require_once("../includes/functions.php"); ?>
<?php require_once("../includes/validation_functions.php"); ?>
<?php find_selected_page(); ?> 

<?php 
	if (!$current_page) {
		redirect_to("manage_content.php");
	}
?>

<?php 

	if (isset($_POST["submit"])){
		
		
		$required_fields = array("subject_id", "menu_name", "position", "visible", "content");
		validate_presences($required_fields);

		$fields_with_max_length = array("menu_name" => 30);
		validate_max_lengths($fields_with_max_length);

		if (empty($errors)) {
				$subject_id = $_POST["subject_id"];
				$menu_name = mysql_prep($_POST["menu_name"]) ;
				$position = (int) $_POST["position"];
				$visible = (int) $_POST["visible"];
				$content = mysql_prep($_POST["content"]) ;
				$id = $current_page["id"];

				$query = "UPDATE pages SET ";
				$query .= "subject_id = {$subject_id}, ";
				$query .= "menu_name = \"{$menu_name}\", ";
				$query .= "position = {$position}, ";
				$query .= "visible = {$visible}, ";
				$query .= "content = \"{$content}\" ";
				$query .= "WHERE id = {$id} ";
				$query .= "LIMIT 1" ;
				$result = mysqli_query($connection, $query);

				if ($result && mysqli_affected_rows($connection) >= 1) {
					$_SESSION["message"] = "Page Updated";
					
					redirect_to("manage_content.php");
				}else {
					$message = "Page Update Failed";
				}

		}else{
				
		}
	}
?>
<?php $layout_context = "admin" ?>
<?php include("../includes/layouts/header.php"); ?>



<div id="main">
	<div id="navigation">
		<?php echo navigation($current_subject, $current_page) ?>
	</div>
	<div id="page">
			<?php
				if (!empty($message)) {
					echo "<div class=\"message\">" . htmlentities($message) . "</div>";
				}  
			?>

			<?php echo form_errors($errors);?>
			<h2> Edit Page : <?php echo htmlentities($current_page["menu_name"]) ?> </h2>
			<form action="edit_page.php?page=<?php echo $current_page["id"]; ?> " method="post">
				<p> Page name: 
					<input type="hidden" name="subject_id" value="<?php echo $current_page["subject_id"]; ?>" />
					<input type="text" name= "menu_name" value="<?php echo htmlentities($current_page["menu_name"]) ?>" />
				</p>
				<p> Position
					<select name="position">
						<?php
							$page_set= find_pages_for_subject($current_page["subject_id"], false);
							$page_count = mysqli_num_rows($page_set);
							for($count = 1; $count <= $page_count; $count++) {
								echo "<option value=\"{$count}\"";
								if ($current_page["position"] == $count) {
									echo "selected";
								}
								echo ">{$count}</option>" ;
							}
						?>
					</select>
				</p>
				<p> Visible 
					<input type="radio" name="visible" value="0" <?php if ($current_page["visible"] == 0) {echo "checked";} ?> /> No
					<input type="radio" name="visible" value="1" <?php if ($current_page["visible"] == 1) {echo "checked";} ?>/> Yes
				</p>
				<p>
					Content:<br>
					<textarea rows="6" cols="75" name="content" value=""> <?php echo $current_page["content"] ;?> </textarea>
				</p>
				<input type="submit" value="Edit Page" name="submit" />
			</form>
			<br>
			<a href="manage_content.php"> Cancel </a>
			||
			<a href="delete_page.php?subject=<?php echo $current_page["id"]; ?>" onclick="return confirm('Are you sure you want to delete');"> Delete Subject </a>
	</div>
</div>

<?php include("../includes/layouts/footer.php"); ?>

 