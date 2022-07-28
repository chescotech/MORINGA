<?php

$date1 = new DateTime("2019-07-10 15:35:04");
$date2 = new DateTime("2019-08-11 15:35:04");
$diff = $date1->diff($date2);


// Simply:
$date = date('Y-m-d H:i:s');

echo 'date '.$date;

//echo "difference " . $diff->y . " years, " . $diff->m." months, ".$diff->d." days ";