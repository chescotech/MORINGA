<?php

include('../dist/includes/dbcon.php');

$name = $_POST['name'];

mysqli_query($con, "INSERT INTO warehouses(name) 
				VALUES('$name')")or die(mysqli_error($con));

echo "<script type='text/javascript'>alert('Successfully added new Warehouse!');</script>";
echo "<script>document.location='manage-warehouses'</script>";
?>