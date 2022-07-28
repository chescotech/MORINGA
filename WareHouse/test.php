<?php

$date = "08/01/2015";
$date = explode('/', $date);

$month = $date[0];
$day = $date[1];
$year = $date[2];

$expireDate = $year."-".$month."-".$day;

echo 'expireDate '.$expireDate;

?>