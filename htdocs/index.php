<?php
require_once('include/html-start.inc.php');
require_once('include/head-start.inc.php');
require_once('include/head-stop.inc.php');
require_once('include/body-start.inc.php');
?>
<table border=0 align=center valign=middle width="100%" height="100%">
<tr>
<td width="100%" height="100%" align=center valign=middle>
<table border="0" cellspacing="0" cellpadding="0" align=center valign=middle>
<tr><td align=right><?php echo (new IntlDateFormatter('nl_NL', IntlDateFormatter::LONG, IntlDateFormatter::LONG))->format(time()); ?></td></tr>
<tr><td><img src="/images/pixel.gif" width="1" height="2" alt=""></td></tr>
<tr bgcolor="#000000"><td><img src="/images/pixel.gif" width="1" height="1" alt=""></td></tr>
<tr><td><img src="/images/pixel.gif" width="1" height="2" alt=""></td></tr>
<tr><td align=center><a href="/contact.php"><img src="/images/appsource.gif" border=0 alt="Appsource"></a></td></tr>
<tr><td><img src="/images/pixel.gif" width="1" height="2" alt=""></td></tr>
<tr bgcolor="#000000"><td><img src="/images/pixel.gif" width="1" height="1" alt=""></td></tr>
<tr><td><img src="/images/pixel.gif" width="1" height="2" alt=""></td></tr>
<tr><td align=left><?php echo (new IntlDateFormatter('nl_NL', IntlDateFormatter::LONG, IntlDateFormatter::LONG))->format(time()); ?><</td></tr>
</table>
</td>
</tr>
</table>
<?php
require_once('include/body-stop.inc.php');
require_once('include/html-stop.inc.php');
?>

