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

if (!defined('InWeBid')) exit('Access denied');

class user
{
	var $user_data, $numbers, $logged_in;
	
	function user()
	{
		global $_SESSION, $system, $DBPrefix;

		$this->numbers = '1234567890';
		$this->logged_in = false;
		$this->can_sell = false;
		$this->can_buy = false;
		$this->user_data = array();

		if (isset($_SESSION['WEBID_LOGGED_NUMBER']) && isset($_SESSION['WEBID_LOGGED_IN']) && isset($_SESSION['WEBID_LOGGED_PASS']))
		{
			$query = "SELECT * FROM " . $DBPrefix . "users WHERE password = '" . $_SESSION['WEBID_LOGGED_PASS'] . "' AND id = " . $_SESSION['WEBID_LOGGED_IN'];
			$res = mysql_query($query);
			$system->check_mysql($res, $query, __LINE__, __FILE__);

			if (mysql_num_rows($res) > 0)
			{
				$user_data = mysql_fetch_array($res);

				if (strspn($user_data['password'], $user_data['hash']) == $_SESSION['WEBID_LOGGED_NUMBER'])
				{
					$this->logged_in = true;
					$this->user_data = $user_data;
					// check if user can sell or buy
					$user_data['groups'][] = 0; // just in case
					$query = "SELECT can_sell, can_buy FROM " . $DBPrefix . "groups WHERE id IN (" . implode(',', $user_data['groups']) . ") AND (can_sell = 1 OR can_buy = 1)";
					$res = mysql_query($query);
					$system->check_mysql($res, $query, __LINE__, __FILE__);
					while ($row = mysql_fetch_assoc($res))
					{
						if ($row['can_sell'] == 1)
						{
							$this->can_sell = true;
						}
						if ($row['can_buy'] == 1)
						{
							$this->can_buy = true;
						}
					}
				}
			}
		}
	}
}
?>