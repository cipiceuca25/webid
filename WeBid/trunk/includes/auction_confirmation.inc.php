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

if (!defined('InWeBid')) exit();

if ($user->user_data['startemailmode'] == 'yes')
{
	$emailer = new email_class();
	$emailer->assign_vars(array(
			'SITE_URL' => $system->SETTINGS['siteurl'],
			'SITENAME' => $system->SETTINGS['sitename'],

			'A_ID' => $auction_id,
			'A_TITLE' => $title,
			'A_TYPE' => ($atype == 1) ? $MSG['642'] : $MSG['641'],
			'A_PICURL' => ($pict_url != '') ? $uploaded_path . $auction_id . '/' . $pict_url : 'images/email_alerts/default_item_img.jpg',
			'A_MINBID' => $system->print_money($minimum_bid, true, false),
			'A_RESERVE' => $system->print_money($reserve_price, true, false),
			'A_BNPRICE' => $system->print_money($buy_now_price, true, false),
			'A_ENDS' => ArrangeDateNoCorrection($a_ends + $system->tdiff),

			'C_NAME' => $user->user_data['name']
			));
	$emailer->email_uid = $user->user_data['id'];
	$subject = $system->SETTINGS['sitename'] . ' ' . $MSG['099'] . ': ' . $title . ' (' . $auction_id . ')';
	$emailer->email_sender($user->user_data['email'], 'auctionmail.inc.php', $subject);
}
?>
