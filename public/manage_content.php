 
<?php require_once("../includes/session.php"); ?>
<?php require_once("../includes/db_connection.php"); ?>
<?php require_once("../includes/functions.php"); ?>
<?php $layout_context = "admin" ?>
<?php include("../includes/layouts/header.php"); ?>
<?php confirm_logged_in() ;?>
<?php find_selected_page(); ?> 



<div id="main">
	<div id="navigation">
		<br>
		<a href="admin.php"> &laquo; Main Menu </a> <br>
		<?php echo navigation($current_subject, $current_page) ?>
		<br>
		<a href="new_subject.php"> + Add a subject </a> <br>
	</div>
	<div id="page">
			<?php echo message(); ?>
			<?php if ($current_subject) { ?>
				 <h2> Manage Subject </h2>
				 <?php echo htmlentities($current_subject["menu_name"]);?> <br>
				 Position: <?php echo $current_subject["position"] ?> <br>
				 Visible: <?php echo $current_subject["visible"] ==1 ? 'yes' : "no"; ?> <hr>
				 <a href="edit_subject.php?subject=<?php echo $current_subject["id"]?>"> Edit Subject </a>||
				 <a href="new_page.php?subject=<?php echo $current_subject["id"] ;?>"> Add a page to this subject </a>
				<?php } elseif ($current_page) { ?>
					<h2> Manage Page </h2>
					<?php echo htmlentities($current_page["menu_name"]); ?><br>
					Position: <?php echo $current_page["position"] ?> <br>
				 Visible: <?php echo $current_page["visible"] ==1 ? 'yes' : "no"; ?> <hr>
				 <br>
				 <div class="view_content">
				 	<?php echo htmlentities($current_page["content"]) ; ?>
				 </div>
				 <a href="edit_page.php?page=<?php echo $current_page["id"] ;?> "> Edit this page </a> ||
				 <a href="delete_page.php?page=<?php echo $current_page["id"] ;?>" > Delete this page </a>
				<?php }else {
					echo "Please select a subject or a page";
				}
			?>
	</div>
</div>

<?php include("../includes/layouts/footer.php"); ?>

