<?php
error_reporting(E_ALL ^ E_DEPRECATED);
/*
  $link=mysql_connect("localhost","root","root");
  mysql_select_db("MyDB",$link);
 */

if (isset($_POST['submit'])) {
    $barcode = $_POST['barcode'];
//$query = mysql_query(" INSERT INTO barcode VALUES ('','$barcode',now())");
    echo $barcode.'<br>';
    //header("LOCATION:test-barcode.php");6001068379101
}
?>

<!DOCTYPE html>
<html>
    <head>
        <title></title>
    </head>
    <body>
        <form method="POST" action="test-barcode.php">

            <input type="text" name="barcode" autofocus>
            <input type="submit" name="submit">

        </form>
    </body>
</html>﻿