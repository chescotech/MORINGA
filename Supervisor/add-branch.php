<?php

include('../dist/includes/dbcon.php');

$name = $_POST['name'];

mysqli_query($con, "INSERT INTO stores_branch(branch_name) 
				VALUES('$name')")or die(mysqli_error($con));

echo "<script type='text/javascript'>alert('Successfully added new branch!');</script>";
echo "<script>document.location='branch-setup.php'</script>";
?>