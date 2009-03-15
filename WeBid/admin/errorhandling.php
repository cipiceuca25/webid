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
include $main_path."fck/fckeditor.php";

unset($ERR);

if(isset($_POST['action']) && $_POST['action'] == "update") {
    // Update database
    $query = "UPDATE " . $DBPrefix . "settings SET
			  errortext = '" . addslashes($_POST['errortext']) . "',
			  errormail = '" . $_POST['errormail'] . "'";
    $system->check_mysql(mysql_query($query), $query, __LINE__, __FILE__);
	$system->SETTINGS['errortext'] = $_POST['errortext'];
	$system->SETTINGS['errormail'] = $_POST['errormail'];
	$ERR = $MSG['413'];
}

$oFCKeditor = new FCKeditor('errortext');
$oFCKeditor->BasePath = '../fck/';
$oFCKeditor->Value = stripslashes($system->SETTINGS['errortext']);
$oFCKeditor->Width  = '550';
$oFCKeditor->Height = '400';

loadblock($MSG['411'], $MSG['410'], $oFCKeditor->CreateHtml());
loadblock($MSG['412'], $MSG['417'], 'text', 'errormail', $system->SETTINGS['errormail']);

$template->assign_vars(array(
		'ERROR' => (isset($ERR)) ? $ERR : '',
		'SITEURL' => $system->SETTINGS['siteurl'],
		'TYPE' => 'set',
		'TYPENAME' => $MSG['5142'],
		'PAGENAME' => $MSG['409']
		));

$template->set_filenames(array(
        'body' => 'adminpages.html'
        ));
$template->display('body');
?>
