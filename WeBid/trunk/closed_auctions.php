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

include 'includes/common.inc.php';
include $include_path . 'auctionstoshow.inc.php';

if (!empty($_GET['user_id']))
{
	$user_id = intval($_GET['user_id']);
}
elseif ($user->logged_in)
{
	$user_id = $user->user_data['id'];
}
else
{
	header('location: user_login.php');
	exit;
}

$NOW = time();
// get number of closed auctions for this user
$query = "SELECT count(id) AS auctions FROM " . $DBPrefix . "auctions
	  WHERE user = " . intval($user_id) . "
	  AND closed = 1";
$result = mysql_query($query);
$system->check_mysql($result, $query, __LINE__, __FILE__);
$num_auctions = mysql_result($result, 0, 'auctions');

// Handle pagination
$TOTALAUCTIONS = $num_auctions;
if (!isset($_GET['PAGE']) || $_GET['PAGE'] == 1 || $_GET['PAGE'] == '')
{
	$OFFSET = 0;
	$PAGE = 1;
}
else
{
	$OFFSET = ($PAGE - 1) * $LIMIT;
}
$PAGES = ceil($TOTALAUCTIONS / $LIMIT);
if (!$PAGES) $PAGES = 1;

$qs = "SELECT * FROM " . $DBPrefix . "auctions
	WHERE user = " . intval($user_id) . "
	AND closed = 1 ";
$qs .= "ORDER BY ends ASC LIMIT $OFFSET, $LIMIT";
$result = mysql_query($qs);
$system->check_mysql($result, $qs, __LINE__, __FILE__);

$bgColor = '#EBEBEB';
while ($row = mysql_fetch_array($result))
{
	$bid = $row['current_bid'];
	$starting_price = $row['current_bid'];

	if ($bgColor == '#EBEBEB')
	{
		$bgColor = '#FFFFFF';
	}
	else
	{
		$bgColor = '#EBEBEB';
	}

	if (strlen($row['pict_url']) > 0)
	{
		$row['pict_url'] = $system->SETTINGS['siteurl'] . 'getthumb.php?w=' . $system->SETTINGS['thumb_show'] . '&fromfile=' . $uploaded_path . $row['id'] . '/' . $row['pict_url'];
	}
	else
	{
		$row['pict_url'] = get_lang_img('nopicture.gif');
	}

	// number of bids for this auction
	$query = "SELECT bid FROM " . $DBPrefix . "bids WHERE auction=" . $row['id'];
	$tmp_res = mysql_query($query);
	$system->check_mysql($tmp_res, $query, __LINE__, __FILE__);
	$num_bids = mysql_num_rows($tmp_res);

	$difference = time() - $row['ends'];
	$days_difference = intval($difference / 86400);
	$difference = $difference - ($days_difference * 86400);

	if (intval($difference / 3600) > 12) $days_difference++;

	$template->assign_block_vars('auctions', array(
			'BGCOLOUR' => $bgColor,
			'ID' => $row['id'],
			'PIC_URL' => $row['pict_url'],
			'TITLE' => $row['title'],
			'BNIMG' => get_lang_img(($row['bn_only'] == 'n') ? 'buy_it_now.gif' : 'bn_only.png'),
			'BNVALUE' => $row['buy_now'],
			'BNFORMAT' => $system->print_money($row['buy_now']),
			'BIDVALUE' => $row['minimum_bid'],
			'BIDFORMAT' => $system->print_money($row['minimum_bid']),
			'NUM_BIDS' => $num_bids,
			'TIMELEFT' => $days_difference . ' ' . $MSG['126a'],

			'B_BUY_NOW' => ($row['buy_now'] > 0 && ($row['bn_only'] == 'y' || $row['bn_only'] == 'n' && ($row['num_bids'] == 0 || ($row['reserve_price'] > 0 && $row['current_bid'] < $row['reserve_price'])))),
			'B_BNONLY' => ($row['bn_only'] == 'y')
			));

	$auctions_count++;
}

if ($auctions_count == 0)
{
	$template->assign_block_vars('no_auctions', array());
}

// get this user's nick
$query = "SELECT * FROM " . $DBPrefix . "users WHERE id = " . $user_id;
$result = mysql_query($query);
$system->check_mysql($result, $query, __LINE__, __FILE__);
if (mysql_num_rows($result) > 0)
{
	$TPL_user_nick = mysql_result($result, 0, 'nick');
}
else
{
	$TPL_user_nick = '';
}

$LOW = $PAGE - 5;
if ($LOW <= 0) $LOW = 1;
$COUNTER = $LOW;
$pagenation = '';
while ($COUNTER <= $PAGES && $COUNTER < ($PAGE + 6))
{
	if ($PAGE == $COUNTER)
	{
		$pagenation .= '<b>' . $COUNTER . '</b>&nbsp;&nbsp;';
	}
	else
	{
		$pagenation .= '<a href="closed_auctions.php?PAGE=' . $COUNTER . '&user_id=' . $user_id . '"><u>' . $COUNTER . '</u></a>&nbsp;&nbsp;';
	}
	$COUNTER++;
}

$template->assign_vars(array(
		'B_MULPAG' => ($PAGES > 1),
		'B_NOTLAST' => ($PAGE < $PAGES),
		'B_NOTFIRST' => ($PAGE > 1),

		'USER_ID' => $user_id,
		'USERNAME' => $TPL_user_nick,
		'THUMBWIDTH' => $system->SETTINGS['thumb_show'],
		'NEXT' => intval($PAGE + 1),
		'PREV' => intval($PAGE - 1),
		'PAGE' => $PAGE,
		'PAGES' => $PAGES,
		'PAGENA' => $pagenation
		));

include 'header.php';
$template->set_filenames(array(
		'body' => 'auctions_closed.tpl'
		));
$template->display('body');
include 'footer.php';

?>