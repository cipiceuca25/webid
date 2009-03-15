<?php
require('includes/config.inc.php');
include $include_path . "countries.inc.php";

$query = "SELECT * FROM " . $DBPrefix . "countries";
$res = mysql_query($query);
$system->check_mysql($res, $query, __LINE__, __FILE__);

$OK = array();
while($row = mysql_fetch_array($res)) {
	$coun[$row['country']] = $row['country'];
}

print_r($coun);

for($i = 0; $i < count($countries); $i++) {
	$row = $countries[$i];
	$OK[$row] = $row;
}

print_r($OK);
?>