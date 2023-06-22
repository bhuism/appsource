<?php
require_once('include/html-start.inc.php');
require_once('include/head-start.inc.php');
require_once('include/head-stop.inc.php');
require_once('include/body-start.inc.php');
require_once('include/menu-start.inc.php');

#require_once('html_form_functions.inc.php');

require_once('include/calendar.inc.php');

function start()
{
return  '<table cellpadding="0" cellspacing="0" border="0">'.
	'<tr height="10"><td width="10"><img src="test/lb.gif"></td><td background="test/b.gif"><img width="1" height="1" src="/images/pixel.gif"></td><td width="10"><img src="test/rb.gif"></td></tr>'.
	'<tr><td background="test/l.gif"><img width="1" height="1" src="/images/pixel.gif"></td><td bgcolor="#dddddd">';
};

function stop()
{
return	'</td><td background="test/r.gif"><img width="1" height="1" src="/images/pixel.gif"></td></tr>'.
	'<tr height="10"><td><img src="test/lo.gif"></td><td background="test/o.gif"><img width="1" height="1" src="/images/pixel.gif"></td><td><img src="test/ro.gif"></td></tr>'.
	'</table>';
};

$timetoshow = ( (is_numeric($_SERVER["QUERY_STRING"])) ? $_SERVER["QUERY_STRING"] : time() );
$yeartoshow = strftime('%y',$timetoshow)+0;
$yearstart = mktime(0,0,0,1,1,$yeartoshow);
$yearstop = mktime(23,59,59,1,0,$yeartoshow+1);

$highlight = Array();
for ($i = 0;$i < 100;$i++) $highlight[] = mt_rand($yearstart,$yearstop);

$cal = new Callendar($highlight);

$borders = Array(0=>0,1=>1,2=>2,3=>3,4=>4,5=>5);
$cellpaddings = Array(0=>0,1=>1,2=>2,3=>3,4=>4,5=>5,6=>6,7=>7,8=>8,9=>9);
$cellspacings = Array(0=>0,1=>1,2=>2,3=>3,4=>4,5=>5,6=>6,7=>7,8=>8,9=>9);
$sizes = Array('+5'=>'plus 5','+4'=>'plus 4','+3'=>'plus 3','+2'=>'plus 2','+1'=>'plus 1','+0'=>'normal','-1'=>'minus 1','-2'=>'minus 2','-3'=>'minus 3');

define('GRAY1','#222222');
define('GRAY2','#444444');
define('GRAY3','#666666');
define('GRAY4','#888888');
define('GRAY5','#aaaaaa');
define('GRAY6','#cccccc');
define('GRAY7','#eeeeee');

$colors = Array('#000000'=>'black','#ffffff'=>'white','#ff0000'=>'red','#00ff00'=>'green','#0000ff'=>'blue',GRAY1=>'gray1',GRAY2=>'gray2',GRAY3=>'gray3',GRAY4=>'gray4',GRAY5=>'gray5',GRAY6=>'gray6',GRAY7=>'gray7');

$items = Array(
		'tableborder' => 	Array('type'=>'option','membervar'=>'Border','array'=>$borders),
		'tablecellpadding' => 	Array('type'=>'option','membervar'=>'CellPadding','array'=>$cellpaddings),
		'tablecellspacing' => 	Array('type'=>'option','membervar'=>'CellSpacing','array'=>$cellspacings),

		'showtitle' => 		Array('type'=>'checkbox','membervar'=>'ShowTitle'),
		'showdaynames' =>	Array('type'=>'checkbox','membervar'=>'ShowDayNames'),
		'showotherdays' =>	Array('type'=>'checkbox','membervar'=>'ShowOtherDays'),
		'showweeks' =>		Array('type'=>'checkbox','membervar'=>'ShowWeekNumbers'),

		'titlesize' =>		Array('type'=>'option','membervar'=>'TitleSize','array'=>$sizes),
		'daysize' =>		Array('type'=>'option','membervar'=>'DaySize','array'=>$sizes),
		'weeksize' =>		Array('type'=>'option','membervar'=>'WeekSize','array'=>$sizes),

		'title_fg' =>		Array('type'=>'option','membervar'=>'Color_Title_FG','array'=>$colors),
		'title_bg' =>		Array('type'=>'option','membervar'=>'Color_Title_BG','array'=>$colors),
		'ac_days_fg' =>		Array('type'=>'option','membervar'=>'Color_ActiveDay_FG','array'=>$colors),
		'ac_days_bg' =>		Array('type'=>'option','membervar'=>'Color_ActiveDay_BG','array'=>$colors),
		'inac_days_fg' =>	Array('type'=>'option','membervar'=>'Color_InActiveDay_FG','array'=>$colors),
		'inac_days_bg' =>	Array('type'=>'option','membervar'=>'Color_InActiveDay_BG','array'=>$colors),
		'other_fg' =>		Array('type'=>'option','membervar'=>'Color_Other_FG','array'=>$colors),
		'other_bg' =>		Array('type'=>'option','membervar'=>'Color_Other_BG','array'=>$colors),
		'table_bg' =>		Array('type'=>'option','membervar'=>'Color_Table_BG','array'=>$colors),
		'weeks_fg' =>		Array('type'=>'option','membervar'=>'Color_Week_FG','array'=>$colors),
		'weeks_bg' =>		Array('type'=>'option','membervar'=>'Color_Week_BG','array'=>$colors),

		'titlelink' =>		Array('type'=>'text','membervar'=>'TitleLink'),
		'weeklink' =>		Array('type'=>'text','membervar'=>'WeekLink'),
		'daylink' =>		Array('type'=>'text','membervar'=>'DayLink'),


		'linkonlyactivedays' =>	Array('type'=>'checkbox','membervar'=>'LinkOnlyActiveDays')
		);

/*
reset($items);
while (list($key,$item) = each($items))
	{
	if ($item['type'] === 'option')
		{
		if ((isset($HTTP_POST_VARS[$key])) && (isset($item['array'][$HTTP_POST_VARS[$key]])))
			{
			$cal->$item['membervar'] = $HTTP_POST_VARS[$key];
			};
		}
	elseif ($item['type'] === 'checkbox')
		{
		if ($HTTP_POST_VARS['button'] === 'Update')
			{
			if ($HTTP_POST_VARS[$key] === 'on') $cal->$item['membervar'] = true;
			else $cal->$item['membervar'] = false;
			};
		}
	elseif ($item['type'] === 'text')
		{
		if ((strlen($HTTP_POST_VARS[$key]) > 0) && (strlen($HTTP_POST_VARS[$key]) < 40))
			{
			$cal->$item['membervar'] = ($HTTP_POST_VARS[$key]);
			};
		};
	};
*/

echo "<center>\n";
echo '<table border="0" cellpadding="1" cellspacing="2">'."\n";
echo '<tr>'."\n";
echo '<td colspan="4">'."\n";

echo '<table border="0" cellpadding="0" cellspacing="0" width="100%">';
echo '<tr>';
echo '<td valign=bottom align="left"><font size="+1"><a href="'.$_SERVER['PHP_SELF'].'?'.mktime(0,0,0,1,1,strftime('%Y',$timetoshow)-1).'">'.(strftime('%Y',$timetoshow)-1).'</a></font></td>';
echo '<td valign=bottom align="center"><font size="+2"><a href="'.$_SERVER['PHP_SELF'].'?'.mktime(0,0,0,1,1,strftime('%Y',$timetoshow)).'">'.strftime('%Y',$timetoshow).'</a></font></td>';
echo '<td valign=bottom align="right"><font size="+1"><a href="'.$_SERVER['PHP_SELF'].'?'.mktime(0,0,0,1,1,strftime('%Y',$timetoshow)+1).'">'.(strftime('%Y',$timetoshow)+1).'</a></font></td>';
echo '</tr>';
echo '</table>';

$counter = 1;
for ($y = 0;$y < 3;$y++)
	{
	echo "<tr>\n";
	for ($x = 0;$x < 4;$x++)
		{
		$temp = mktime(0,0,0,$counter++,1,strftime('%Y',$timetoshow));
		echo '<td align=center valign=top>'.$cal->String($temp).'</td>';
		};
	echo "</tr>\n";
	};
echo "</table>\n";

/*

define('PIXEL','<img width="1" height="1" src="/images/pixel.gif" alt="">');

echo '<form method="POST" action="'.$PHP_SELF.'">';
echo '<table border="0" cellspacing="1" cellpadding="2" bgcolor="#888888">';
echo '<tr bgcolor="#cccccc">';
echo '<td align="center" colspan="2">table</td>';
echo '<td align="center" colspan="2">decoratives</td>';
echo '<td align="center" colspan="2">sizes</td>';
echo '<td align="center" colspan="3">colors</td>';
echo '<td align="center" colspan="2">link</td>';
echo '</tr>';
echo '<tr bgcolor="#cccccc">';
echo '<td bgcolor="#ffffff" colspan="7">&nbsp;</td>';
echo '<td align="center">fg</td><td align="center">bg</td>';
echo '<td bgcolor="#ffffff" colspan="2">&nbsp;</td>';
echo '</tr>';
echo '<tr bgcolor="#cccccc">';
echo '<td bgcolor="#ffffff" colspan="6">&nbsp;</td>';
echo '<td bgcolor="#ffffff" align=right>table:</td>';
echo '<td bgcolor="#ffffff">&nbsp;</td>';
echo '<td bgcolor="#ffffff" align="left">'.html_form_option('table_bg',$colors,$cal->Color_Table_BG).'</td>';
echo '<td bgcolor="#ffffff" colspan="2">&nbsp;</td>';
echo '</tr>';
echo '<tr bgcolor="#ffffff">';
echo '<td align="right">border:</td><td align="left">'.html_form_option('tableborder',$borders,$cal->Border).'</td>';
echo '<td align="right">title:</td><td align="left">'.html_form_checkbox('showtitle',$cal->ShowTitle).'</td>';
echo '<td align="right">title:</td><td align="left">'.html_form_option('titlesize',$sizes,$cal->TitleSize).'</td>';
echo '<td align="right">title:</td><td align="left">'.html_form_option('title_fg',$colors,$cal->Color_Title_FG).'</td><td align="left">'.html_form_option('title_bg',$colors,$cal->Color_Title_BG).'</td>';
echo '<td align="right">title:</td><td align="left">'.html_form_text('titlelink',$cal->TitleLink,10).'</td>';
echo '</tr>';
echo '<tr bgcolor="#ffffff">';
echo '<td align="right">spacing:</td><td align="left">'.html_form_option('tablecellspacing',$cellspacings,$cal->CellSpacing).'</td>';
echo '<td align="right">days:</td><td align="left">'.html_form_checkbox('showdaynames',$cal->ShowDayNames).'</td>';
echo '<td align="right">days:</td><td align="left">'.html_form_option('daysize',$sizes,$cal->DaySize).'</td>';
echo '<td align="right">days(ac):</td><td align="left">'.html_form_option('ac_days_fg',$colors,$cal->Color_ActiveDay_FG).'</td><td align="left">'.html_form_option('ac_days_bg',$colors,$cal->Color_ActiveDay_BG).'</td>';
echo '<td align="right">only active:</td><td align="left">'.html_form_checkbox('linkonlyactivedays',$cal->LinkOnlyActiveDays).'</td>';
echo '</tr>';
echo '<tr bgcolor="#ffffff">';
echo '<td align="right">padding:</td><td align="left">'.html_form_option('tablecellpadding',$cellpaddings,$cal->CellPadding).'</td>';
echo '<td align="right">other:</td><td align="left">'.html_form_checkbox('showotherdays',$cal->ShowOtherDays).'</td>';
echo '<td align="right">weeks:</td><td align="left">'.html_form_option('weeksize',$sizes,$cal->WeekSize).'</td>';
echo '<td align="right">days(inac):</td><td align="left">'.html_form_option('inac_days_fg',$colors,$cal->Color_InActiveDay_FG).'</td><td align="left">'.html_form_option('inac_days_bg',$colors,$cal->Color_InActiveDay_BG).'</td>';
echo '<td align="right">days:</td><td align="left">'.html_form_text('daylink',$cal->DayLink,10).'</td>';
echo '</tr>';
echo '<tr bgcolor="#ffffff">';
echo '<td colspan="2">&nbsp;</td>';
echo '<td align="right">weeks:</td><td align="left">'.html_form_checkbox('showweeks',$cal->ShowWeekNumbers).'</td>';
echo '<td colspan="2">&nbsp;</td>';
echo '<td align="right">other:</td><td align="left">'.html_form_option('other_fg',$colors,$cal->Color_Other_FG).'</td><td align="left">'.html_form_option('other_bg',$colors,$cal->Color_Other_BG).'</td>';
echo '<td align="right">weeks:</td><td align="left">'.html_form_text('weeklink',$cal->WeekLink,10).'</td>';
echo '</tr>';
echo '<tr bgcolor="#ffffff">';
echo '<td colspan="2">&nbsp;</td>';
echo '<td colspan="2">&nbsp;</td>';
echo '<td colspan="2">&nbsp;</td>';
echo '<td align="right">weeks:</td><td align="left">'.html_form_option('weeks_fg',$colors,$cal->Color_Week_FG).'</td><td align="left">'.html_form_option('weeks_bg',$colors,$cal->Color_Week_BG).'</td>';
echo '<td colspan="2">&nbsp;</td>';
echo '</tr>';
echo '<tr bgcolor="#cccccc">';
echo '<td align="center" colspan="11">'.html_form_submit('Update','button').'</td>';
echo '</tr>';
echo '</table>';

echo '</form>';

*/

echo '</center>';


//echo '<pre>';
//echo htmlspecialchars(print_r($cal));
//echo htmlspecialchars($cal->String());
//echo '</pre>';


?>
<?php
require_once('include/menu-stop.inc.php');
require_once('include/body-stop.inc.php');
require_once('include/html-stop.inc.php');
?>