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

include 'functions.php';
define('InInstaller', 1);

$main_path = getmainpath();
$thisversion = this_version();
echo print_header(false);

$step = (isset($_GET['step'])) ? $_GET['step'] : 0;
switch($step)
{
	case 2:
		$siteURL = urldecode($_GET['URL']);
		$siteEmail = $_GET['EMail'];
		include '../includes/config.inc.php';
		include 'sql/dump.inc.php';
		$queries = count($query);
		if (!mysql_connect($DbHost, $DbUser, $DbPassword))
		{
			die('<p>Cannot connect to ' . $DbHost . '</p>');
		}
		if (!mysql_select_db($DbDatabase))
		{
			die('<p>Cannot select database</p>');
		}
		echo ($_GET['n'] * 25) . '% Complete<br>';
		$from = (isset($_GET['from'])) ? $_GET['from'] : 0;
		$fourth = floor($queries/4);
		$to = ($_GET['n'] == 4) ? $queries : ($fourth * $_GET['n']);
		for ($i = $from; $i < $to; $i++)
		{
			mysql_query($query[$i]) or die(mysql_error() . "\n\t" . $query[$i]);
		}
		flush();
		if ($i < $queries)
		{
			echo '<script type="text/javascript">window.location = "install.php?step=2&URL=' . urlencode($_GET['URL']) . '&EMail=' . $_GET['EMail'] . '&cats=' . $_GET['cats'] . '&n=' . ($_GET['n'] + 1) . '&from=' . $i . '";</script>';
		}
		else
		{
			echo 'Installation complete now set-up your admin account <a href="' . $_GET['URL'] . 'admin/">here</a> and remove the install folder from your server';
		}
		break;
	case 1:
		if (!mysql_connect($_POST['DBHost'], $_POST['DBUser'], $_POST['DBPass']))
		{
			die('<p>Cannot connect to ' . $DbHost . ' with the supplied username and password. <a href="#" onClick="history.go(-1)">Go Back</a></p>');
		}
		if (!mysql_select_db($_POST['DBName']))
		{
			die('<p>Cannot select database ' . $_POST['DBName'] . '. <a href="#" onClick="history.go(-1)">Go Back</a></p>');
		}
		$cats = (isset($_POST['importcats'])) ? 1 : 0;
		echo '<b>Step 1:</b> Writing config file...<br>';
		$path = (!get_magic_quotes_gpc()) ? str_replace('\\', '\\\\', $_POST['mainpath']) : $_POST['mainpath'];
		// generate config file
		$content = '<?php' . "\n";
		$content .= '$DbHost	 = "' . $_POST['DBHost'] . '";' . "\n";
		$content .= '$DbDatabase = "' . $_POST['DBName'] . '";' . "\n";
		$content .= '$DbUser	 = "' . $_POST['DBUser'] . '";' . "\n";
		$content .= '$DbPassword = "' . $_POST['DBPass'] . '";' . "\n";
		$content .= '$DBPrefix	= "' . $_POST['DBPrefix'] . '";' . "\n";
		$content .= '$main_path	= "' . $path . '";' . "\n";
		$content .= '$MD5_PREFIX = "' . md5(microtime() . rand(0,50)) . '";' . "\n";
		$content .= '?>';
		$output = makeconfigfile($content, $path);
		if ($output)
		{
			$check = check_installation();
			if ($check)
			{
				echo '<p>You appear to already have an installation on WeBid running would you like to do a <a href="update.php">upgrade instead?</a></p>';
			}
			echo 'Complete, now to <b><a href="?step=2&URL=' . urlencode($_POST['URL']) . '&EMail=' . $_POST['EMail'] . '&cats=' . $cats . '&n=1">step 2</a></b>';
		}
		else
		{
			echo 'WeBid could not automatically create the config file, please could you enter the following into config.inc.php (this file is located in the includes directory)';
			echo '<p><textarea style="width:500px; height:500px;">
'.$content.'
			</textarea></p>';
			echo 'Once you\'ve done this, you can continue to <b><a href="?step=2&URL=' . urlencode($_POST['URL']) . '&EMail=' . $_POST['EMail'] . '&cats=' . $cats . '&n=1">step 2</a></b>';
		}
		break;
	default:
		$check = check_installation();
		if ($check)
		{
			echo '<p>You appear to already have an installation on WeBid running would you like to do a <a href="update.php">upgrade instead?</a></p>';
		}
		echo show_config_table(true);
	break;
}

?>