<html>
<head>
    <link rel="stylesheet" type="text/css" href="{SITEURL}admin/style.css" />
</head>
<body style="margin:0;">
<table width="100%" border="0" cellpadding="0" cellspacing="0">
<tr> 
    <td background="{SITEURL}admin/images/bac_barint.gif">
        <table width="100%" border="0" cellspacing="5" cellpadding="0">
            <tr> 
                <td width="30"><img src="{SITEURL}admin/images/i_con.gif" ></td>
                <td class="white">{L_25_0018}&nbsp;&gt;&gt;&nbsp;{L_516}</td>
            </tr>
        </table>
    </td>
</tr>
<tr>
    <td>&nbsp;</td>
</tr>
<tr> 
    <td align="center" valign="middle">
        <table width="95%" border="0" cellpadding="1" bgcolor="#0083D7">
        <tr>
            <td align="center" class="title">{TITLE}</td>
        </tr>
        <tr>
            <td bgcolor="#FFFFFF">
            	<form name="addnew" action="" method="post">
                <table width="100%" cellpadding="2" border="0">
<!-- IF ERROR ne '' -->
					<tr bgcolor="yellow">
						<td class="error" colspan="3" align="center">{ERROR}</td>
					</tr>
<!-- ENDIF -->
<!-- BEGIN lang -->
					<tr valign="top">
	<!-- IF lang.S_FIRST_ROW -->
    					<td width="204" valign="top" align="right">{L_519}:</td>
    <!-- ELSE -->
    					<td>&nbsp;</td>
    <!-- ENDIF -->
						<td width="10"><img src="../includes/flags/{lang.LANG}.gif"></td>
                        <td width="486"><input type="text" name="title[{lang.LANG}]" size="40" maxlength="255" value="{lang.TITLE}"></td>
					</tr>
<!-- END lang -->
<!-- BEGIN lang -->
					<tr>
	<!-- IF lang.S_FIRST_ROW -->
    					<td width="204" valign="top" align="right">{L_520}:</td>
    <!-- ELSE -->
    					<td>&nbsp;</td>
    <!-- ENDIF -->
						<td width="10" valign="top"><img src="../includes/flags/{lang.LANG}.gif"></td>
                        <td width="486"><textarea name="content[{lang.LANG}]" cols="45" rows="20">{lang.CONTENT}</textarea></td>
					</tr>
<!-- END lang -->
                    </tr>
                    <tr>
                        <td valign="top" align="right">{L_521}</td>
                        <td>&nbsp;</td>
                        <td>
                            <input type="radio" name="suspended" value="0"<!-- IF B_ACTIVE --> checked="checked"<!-- ENDIF -->> {L_030}
                            <input type="radio" name="suspended" value="1"<!-- IF B_INACTIVE --> checked="checked"<!-- ENDIF -->> {L_029}
                        </td>
                    </tr>
                    <tr>
                        <td valign="top" align="right">&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>
                            <input type="hidden" name="action" value="update">
                            <input type="submit" value="{BUTTON}">
                        </td>
                    </tr>
                </table>	
                </form>
            </td>
        </tr>
        </table>
    </td>
</tr>
</table>

<!-- INCLUDE footer.tpl -->