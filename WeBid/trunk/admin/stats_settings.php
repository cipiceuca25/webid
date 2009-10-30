<?php
/***************************************************************************
 *   copyright				: (C) 2008, 2009 WeBid
 *   site					: http://www.webidsupport.com/
 ***************************************************************************/

/***************************************************************************
 *   This program is free software; you can redistribute it and/or modify
 *   it under the terms of the GNU General Public License as published by
 *   the Free Software Foundation; either version 2 of the License, or
 *   (at your option) any later version. Although none of the code may be
 *   sold. If you have been sold this script, get a refund.
 ***************************************************************************/

define('InAdmin', 1);
include '../includes/common.inc.php';
include $include_path . 'functions_admin.php';
include 'loggedin.inc.php';

unset($ERR);

if (isset($_POST['action']) && $_POST['action'] == 'update')
{
	if (isset($_POST['activate']) && $_POST['activate'] == 'y' && (!isset($_POST['accesses']) && !isset($_POST['browsers']) && !isset($_POST['domains'])))
	{
		$ERR = $ERR_5002;
		$system->SETTINGS = $_POST;
	}
	else
	{
		if (!isset($_POST['accesses'])) $_POST['accesses'] = 'n';
		if (!isset($_POST['browsers'])) $_POST['browsers'] = 'n';
		if (!isset($_POST['domains'])) $_POST['domains'] = 'n';
		// Update database
		$query = "UPDATE " . $DBPrefix . "statssettings SET
					activate = '" . $_POST['activate'] . "',
					accesses = '" . $_POST['accesses'] . "',
					browsers = '" . $_POST['browsers'] . "',
					domains = '" . $_POST['domains'] . "'";
		$system->check_mysql(mysql_query($query), $query, __LINE__, __FILE__);
		$ERR = $MSG['5148'];
		$statssettings = $_POST;
	}
}
else
{
	$query = "SELECT * FROM " . $DBPrefix . "statssettings";
	$res = mysql_query($query);
	$system->check_mysql($res, $query, __LINE__, __FILE__);
	$statssettings = mysql_fetch_assoc($res);
}

loadblock('', $MSG['5144']);
loadblock($MSG['5149'], '', 'yesno', 'activate', $statssettings['activate'], $MSG['030'], $MSG['029']);
loadblock('', $MSG['5150']);
loadblock('' , '', 'checkbox', 'accesses', $statssettings['accesses'], $MSG['5145']);
loadblock('' , '', 'checkbox', 'browsers', $statssettings['browsers'], $MSG['5146']);
loadblock('' , '', 'checkbox', 'domains', $statssettings['domains'], $MSG['5147']);

$template->assign_vars(array(
		'ERROR' => (isset($ERR)) ? $ERR : '',
		'SITEURL' => $system->SETTINGS['siteurl'],
		'TYPE' => 'con',
		'TYPENAME' => $MSG['25_0023'],
		'PAGENAME' => $MSG['5142'],
		'TITLEBARNAME' => $MSG['5141']
		));

$template->set_filenames(array(
		'body' => 'adminpages.tpl'
		));
$template->display('body');
?>
