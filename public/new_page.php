<?php require_once("../includes/session.php"); ?>
<?php require_once("../includes/db_connection.php"); ?>
<?php require_once("../includes/functions.php"); ?>
<?php require_once("../includes/validation_functions.php"); ?>
<?php $layout_context = "admin" ?>
<?php include("../includes/layouts/header.php"); ?>
<?php find_selected_page(); ?>


 <?php
 	if (isset($_GET["subject"])) {
  	$sub_id = $_GET["subject"] ;
	}
  ?>

<?php
	if (isset($_POST["submit"])) {
			
		$sub_id= (int) $_POST["subject_id"];
		$menu_name= $_POST["menu_name"];
		$visible= (int) $_POST["visible"];
		$content= $_POST["content"];
		$position = (int) $_POST["position"];

		$required_fields= array("subject_id","menu_name", "position", "visible", "content");
		validate_presences($required_fields);

		$fields_with_max_length = array("menu_name" => 30);
		validate_max_lengths($fields_with_max_length);

		if (!empty($errors)) {
			$_SESSION["errors"] = $errors;
			redirect_to("new_page.php?subject={$sub_id}");
		}

			$query = "INSERT INTO pages (";
			$query .= "subject_id, menu_name, position, visible, content" ;
			$query .= ") VALUES (";
			$query .= "{$sub_id}, \"{$menu_name}\", {$position}, {$visible}, \"{$content}\"";
			$query .= ");";
			$result = mysqli_query($connection, $query);

			if ($result) {
				$_SESSION["message"] = "Page Created";
				redirect_to("manage_content.php");
			} else {
				redirect_to("new_page.php?subject={$sub_id}");
			}
		} else {
			
		}


 ?>

<div id="main">
	<div id="navigation">
		<?php echo navigation($current_subject, $current_page) ?>
	</div>
	<div id="page">
			<?php echo message(); ?>
			<?php $errors = errors(); ?>
			<?php echo form_errors($errors);?>
			<h2> Create a page </h2>
			<form action="new_page.php?subject=<?php echo $sub_id; ?>" method="post">
				<p> Page name: 
					<input type="hidden" name="subject_id" value=<?php echo $sub_id ;?> />
					<input type="text" name= "menu_name" value="" />
				</p>
				<p> Position
					<select name="position">
						<?php
							$page_set= find_pages_for_subject($sub_id, false);
							$page_count = mysqli_num_rows($page_set);
							for($count = 1; $count <= ($page_count +1); $count++) {
								echo "<option value=\"{$count}\">{$count}</option>" ;
							}
						?>
					</select>
				</p>
				<p> Visible
					<input type="radio" name="visible" value="0" /> No 
					<input type="radio" name="visible" value="1" /> Yes 
				</p>
				<p>
					<textarea name="content" value=""> </textarea>
				</p>
				<input type="submit" value="Create Page" name="submit" />
			</form>
			<br>
			<a href="manage_content.php"> Cancel </a>
	</div>
</div>

<?php include("../includes/layouts/footer.php"); ?>
