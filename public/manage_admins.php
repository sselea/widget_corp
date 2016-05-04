<?php require_once("../includes/session.php"); ?>
<?php require_once("../includes/db_connection.php"); ?>
<?php require_once("../includes/functions.php"); ?>
<?php $layout_context = true ?>
<?php include("../includes/layouts/header.php"); ?>
<?php find_selected_page(true); ?> 


<div id="main">
	<div id="navigation">
		<br>
		
		<br>
	</div>
	<div id="page">
		<?php echo message(); ?>
		<div class="admins_page"> 
			<h2> Admins </h2>
		
			<?php 
				$admins_set = find_all_admins(); ?>
				<ul class="admins">
					<?php while($admin = mysqli_fetch_assoc($admins_set)) { ?>
						<li> <h3> <?php echo $admin["username"];?> </h3> 
						</li>
						<a href="edit_admin.php?admin=<?php echo $admin["id"]; ?>"> 	Edit Admin</a> || <a href="delete_admin.php?admin=<?php echo $admin["id"]; ?>"> Delete Admin </a>
					<?php	} ?>
				</ul>
				<hr>
				<a href="new_admin.php"> Add an admin </a>
		</div>
		<br>
		
	</div>
</div>

<?php include("../includes/layouts/footer.php"); ?>
