<?php
/***************************************************************************
 *   copyright				: (C) 2008 WeBid
 *   site					: http://www.webidsupport.com/
 ***************************************************************************/

/***************************************************************************
 *   This program is free software; you can redistribute it and/or modify
 *   it under the terms of the GNU General Public License as published by
 *   the Free Software Foundation; either version 2 of the License, or
 *   (at your option) any later version. Although none of the code may be
 *   sold. If you have been sold this script, get a refund.
 ***************************************************************************/

require('../includes/config.inc.php');
include "loggedin.inc.php";
include $include_path.'time.inc.php';

unset($ERR);

if(isset($_POST['action']) && $_POST['action'] == "update") {
	// Update database
	$query = "UPDATE " . $DBPrefix . "settings set 
			timecorrection = " . intval($_POST['correction']);
	$system->check_mysql(mysql_query($query), $query, __LINE__, __FILE__);
	$system->SETTINGS['timecorrection'] = $_POST['timecorrection'];	
	$ERR = $MSG['347'];
}

$TIMECORRECTION = array(
	"-23" => "-23 h",
	"-22" => "-22 h",
	"-21" => "-21 h",
	"-20" => "-20 h",
	"-19" => "-19 h",
	"-18" => "-18 h",
	"-17" => "-17 h",
	"-16" => "-16 h",
	"-15" => "-15 h",
	"-14" => "-14 h",
	"-13" => "-13 h",
	"-12" => "-12 h",
	"-11" => "-11 h",
	"-10" => "-10 h",
	"-9" => "-9 h",
	"-8" => "-8 h",
	"-7" => "-7 h",
	"-6" => "-6 h",
	"-5" => "-5 h",
	"-4" => "-4 h",
	"-3" => "-3 h",
	"-2" => "-2 h",
	"-1" => "-1 h",
	"0" => "GMT",
	"+1" => "+1 h",
	"+2" => "+2 h",
	"+3" => "+3 h",
	"+4" => "+4 h",
	"+5" => "+5 h",
	"+6" => "+6 h",
	"+7" => "+7 h",
	"+8" => "+8 h",
	"+9" => "+9 h",
	"+10" => "+10 h",
	"+11" => "+11 h",
	"+12" => "+12 h",
	"+13" => "+13 h",
	"+14" => "+14 h",
	"+15" => "+15 h",
	"+16" => "+16 h",
	"+17" => "+17 h",
	"+18" => "+18 h",
	"+19" => "+19 h",
	"+20" => "+20 h",
	"+21" => "+21 h",
	"+22" => "+22 h",
	"+23" => "+23 h"
);

$selectsetting = $system->SETTINGS['timecorrection'];

$html = generateSelect('correction', $TIMECORRECTION);

loadblock($MSG['346'], $MSG['345'], 'dropdown', 'timecorrection', $system->SETTINGS['timecorrection']);

$template->assign_vars(array(
		'ERROR' => (isset($ERR)) ? $ERR : '',
		'SITEURL' => $system->SETTINGS['siteurl'],
		'OPTIONHTML' => $html,	
		'TYPE' => 'pre',
		'TYPENAME' => $MSG['25_0008'],
		'PAGENAME' => $MSG['344'],
		'DROPDOWN' => $html
		));

$template->set_filenames(array(
        'body' => 'adminpages.html'
        ));
$template->display('body');
?>

