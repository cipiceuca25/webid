<html>
<head>
	<link rel="stylesheet" type="text/css" href="{SITEURL}admin/style.css">
</head>
<body>
<table width="100%" border="0" cellpadding="0" cellspacing="0">
<tr>
	<td background="{SITEURL}admin/images/bac_barint.gif">
		<table width="100%" border="0" cellspacing="5" cellpadding="0">
			<tr>
				<td width="30"><img src="{SITEURL}admin/images/i_fee.gif" ></td>
				<td class="white">{L_25_0012}&nbsp;&gt;&gt;&nbsp;{L_445}</td>
			</tr>
		</table>
	</td>
</tr>
<tr>
	<td align="center" valign="middle">&nbsp;</td>
</tr>
<tr>
	<td align="center" valign="middle">
		<br>
		<form name="conf" action="" method="post">
        <input name="action" value="1" type="hidden">
		<table width="95%" border="0" cellpadding="1" bgcolor="#0083D7">
		<tr>
			<td align="center" class="title">{L_445}</td>
		</tr>
		<tr>
			<td>
				<table width="100%" cellpadding="2" align="center" bgcolor="#FFFFFF">
<!-- BEGIN gateways -->
					<tr class="c3">
						<td colspan="2" bgcolor="#CCCCCC"><b>{gateways.NAME}</b></td>
					</tr>
					<tr class="c1">
						<td width="50%"><a href="http://paypal.com" target="_blank">{L_720}</a>: <input type="text" name="{gateways.PLAIN_NAME}_address" value="{gateways.ADDRESS}"></td>
						<td>{L_446} <input type="checkbox" name="{gateways.PLAIN_NAME}_required"{gateways.REQUIRED}></td>
					</tr>
                    <tr class="c1">
						<td colspan="2">{L_447} <input type="checkbox" name="{gateways.PLAIN_NAME}_active"{gateways.ENABLED}></td>
					</tr>
<!-- END gateways -->
					
					<tr>
						<td><input type="hidden" name="action" value="update"></td>
						<td><input type="submit" name="act" value="{L_530}"></td>
					</tr>
				</table>
			</td>
		</tr>
		</table>
		</form>
	</td>
</tr>
</table>

<!-- INCLUDE footer.tpl -->
