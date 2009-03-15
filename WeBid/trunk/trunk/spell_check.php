<?php
// some using language dev tools
define('InWeBid', 1);
include('language/EN/messages.inc.php');

if($_GET['i'] == 'free') {
	echo 'Free to use<br>';
	for($i = 10; $i <= 1000; $i++) {
		$t = (strlen($i) == 2) ? '0'.$i : $i;
		if(!isset($MSG[$t])) echo $t . '<br>';
	}
} elseif($_GET['i'] == 'ffree') {
	echo 'Free to use<br>';
	$count = 0;
	$arr = '';
	$i = 10;
	while($i <= 1000) {
		$t = (strlen($i) == 2) ? '0'.$i : $i;
		if(!isset($MSG[$t])) {
			$count++;
			$arr .= $t . '<br>';
		} else {
			$count = 0;
			$arr = '';
		}
		if($count == $_GET['n']) {
			break;
		}
		$i++;
	}
	echo $arr;
} else {
	foreach($MSG as $k => $v) {
		echo '(' . $k . ')' . "\t-\t" . $v . '<br>';
	}
}
?>