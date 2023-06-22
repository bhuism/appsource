<table border="0" cellspacing="0" cellpadding="0" width="100%" height="100%">
<tr>
<td colspan="3"><img src="/images/pixel.gif" width="1" height="1" alt=""></td></tr>
<tr>
<td align=left valign=bottom width="45%" height="1%">&nbsp;<?php

$menuitems = Array('home'=>'index.php','calendar'=>'','contact'=>'');

foreach ($menuitems as $key => $val)
	{
	$link = ((strlen($val)>0)?$val:'/'.$key.'.php');
	$menulinks[$key] = "<a href=\"$link\">".(($_SERVER['PHP_SELF']===$link)?'<b>':'').$key.(($_SERVER['PHP_SELF']===$link)?'</b>':'').'</a>';
	};
echo implode('&nbsp;<big><strong>&middot;</strong></big>&nbsp;', $menulinks);
?></td>
<td>&nbsp;</td>
<td align=right valign=bottom width="45%"><?php echo strftime('%a, %b %e %Y'); ?>&nbsp;</td>
</tr>
<tr><td colspan="3"><img src="/images/pixel.gif" width="1" height="1" alt=""></td></tr>
<tr bgcolor="#000000"><td colspan="3"><img src="/images/pixel.gif" width="1" height="1" alt=""></td></tr>
<tr><td colspan="3"><img src="/images/pixel.gif" width="1" height="1" alt=""></td></tr>
<tr>
<td colspan="3" align=center valign=middle height="100%">
<table>
<tr>
<td>
