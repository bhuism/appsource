<?php
define('PIXEL','<img width="1" height="1" src="/images/pixel.gif" alt="">');

class Callendar
{
var $HighLight = Array();
var $Border = 0;
var $CellSpacing = 1;
var $CellPadding = 2;

var $ShowTitle = true;
var $ShowDayNames = true;
var $ShowOtherDays = false;
var $ShowWeekNumbers = true;

var $TitleSize = '+0';
var $DaySize = '-1';
var $WeekSize = '-2';

var $Color_Title_BG = '#aaaaaa';
var $Color_Title_FG = '#ffffff';

var $Color_InActiveDay_FG = '#444444';
var $Color_InActiveDay_BG = '#cccccc';
var $Color_ActiveDay_FG = '#000000';
var $Color_ActiveDay_BG = '#888888';

var $Color_Other_BG = '#ffffff';
var $Color_Other_FG = '#aaaaaa';

var $Color_Week_FG = '#000000';
var $Color_Week_BG = '#eeeeee';

var $Color_Table_BG = '#000000';

var $TitleLink = '?';
var $DayLink = '?';
var $WeekLink = '?';
var $LinkOnlyActiveDays = true;

function Callendar($highlight = '',$daylink = '',$titlelink = '',$weeklink = '')
	{
	if ((func_num_args() >= 1) && (is_array($highlight))) $this->HighLight = $highlight;
	if (func_num_args() >= 2) $this->DayLink = $daylink;
	if (func_num_args() >= 3) $this->TitleLink = $titlelink;
	if (func_num_args() >= 4) $this->WeekLink = $weeklink;
	}

function String($timestamp = 0)
	{
	if (!$timestamp) $timestamp = time();
	$year = strftime('%Y',$timestamp)+0;
	$month = strftime('%m',$timestamp)+0;
	$numofdays = strftime('%d',mktime(0,0,0,$month+1,0,$year))+0;

	$string = '<table border="'.$this->Border.'" bgcolor="'.$this->Color_Table_BG.'" cellspacing="'.$this->CellSpacing.'" cellpadding="'.$this->CellPadding.'">'."\n";

	//do the title
	if ($this->ShowTitle)
		{
		//do the month name
		$string .= '<tr>'."\n";
		if ($this->ShowWeekNumbers) $string .= '<td '.($this->ShowDayNames ? 'rowspan=2 ' : '').'bgcolor="'.$this->Color_Other_BG.'">'.PIXEL.'</td>'."\n";
		$string .= '<td align="center" colspan="7" bgcolor="'.$this->Color_Title_BG.'">';
		if (strlen($this->TitleLink) > 0) $string .= '<a href="'.$this->TitleLink.mktime(0,0,0,$month,1,$year).'">';
		$string .= '<font color="'.$this->Color_Title_FG.'" size="'.$this->TitleSize.'">';
		$string .= strftime('%B',mktime(0,0,0,$month,1,$year));
		$string .= '</font>';
		if (strlen($this->TitleLink) > 0) $string .= '</a>';
		$string .= '</td>'."\n";
		$string .= '</tr>'."\n";
		};

	//do the weekdays
	if ($this->ShowDayNames)
		{
		$string .= "<tr>\n";
		for ($i = 0,$day = mktime(0,0,0,9,3,2001); $i < 7; $i++,$day+=(24*60*60))
			{
//			$string .= '<td align="center" bgcolor="'.$this->Color_Week_BG.'"><font color="#3070FF" size="'.$this->WeekSize.'">'.strtolower(substr(strftime('%A',$day),0,1)).'</font></td>'."\n";
			$string .= '<td align="center" bgcolor="'.$this->Color_Week_BG.'"><font color="'.$this->Color_Week_FG.'" size="'.$this->WeekSize.'">'.strtolower(substr(strftime('%A',$day),0,1)).'</font></td>'."\n";
			};
		$string .= "</tr>\n";
		};

	sort($this->HighLight);
	reset($this->HighLight);
	for ($day = 1;$day <= $numofdays;$day++)
		{
		$daystart = mktime(0,0,0,$month,$day,$year);
		$daystop = mktime(23,59,59,$month,$day,$year);
		$dayofweek = strftime('%w',$daystart);
		$isactiveday = ((current($this->HighLight)>=$daystart&&current($this->HighLight)<=$daystop) ? true : false);

		if (($dayofweek == 1) || ($day == 1))
			{
			//week number
			$string .= '<tr>'."\n";

			if ($this->ShowWeekNumbers)
				{
				$weekday = strftime('%V',$daystart);
				$string .= '<td align=center valign=middle bgcolor="'.$this->Color_Week_BG.'">';
				if ((($weekday > 6) && ($month == 1)) || (($weekday < 46) && ($month == 12)) || ($weekday > 52) || ($weekday < 1))
					{
					$string .= '&nbsp;';
					}
				else	{
					$string .= ($weekday <= 9 ? '&nbsp;' : '');
					if (strlen($this->WeekLink) > 0)
						{
						$string .= '<a href="'.$this->WeekLink.'">';
						}
					$string .= '<font color="'.$this->Color_Week_FG.'" size="'.$this->WeekSize.'">';
					$string .= ($weekday+0);
					$string .= '</font>';
					if (strlen($this->WeekLink) > 0)
						{
						$string .= '</a>';
						}
					};
				$string .= '</td>'."\n";
				};
			if ($day == 1)
				{
/*
				$numofweeks = 4;
				for ($i = 23;$i <= $numofdays;$i++)
					{
					if (strftime('%w',mktime(0,0,0,$month,$i,$year)) == 1) $numofweeks++;
					};

				$string .= '<td rowspan="'.$numofweeks.'">';

				$week = strftime('%V',$daystart)+0;
				$string .= '<table height="100%" width="100%" border="0" cellpadding="0" cellspacing="0">';
				for ($i = 0;$i < $numofweeks;$i++)
					{
					$string .= "<tr>\n<td align=center valign=middle><font size=\"-1\">$week</font></td>\n</tr>\n";
					$week++;
					};
				$string .= '</table>';

				$string .= '</td>';
*/				if ($dayofweek != 1)
					{
					$temp = ($dayofweek+6)%7;
					if ($this->ShowOtherDays)
						{
						$counter = strftime('%d',mktime(0,0,0,$month,-$temp+1,$year));
						for ($i = 0;$i < $temp;$i++)
							{
							$string .= '<td bgcolor="'.$this->Color_Other_BG.'" align=center><font size="'.$this->DaySize.'" color="'.$this->Color_Other_FG.'">'.$counter++.'</font></td>'."\n";
							};
						}
					else	$string .= '<td colspan="'.$temp.'" bgcolor="'.$this->Color_Other_BG.'" align=center>'.PIXEL.'</td>'."\n";
					};
				};
			};

		while (current($this->HighLight) < $daystart)
			{
			if (!next($this->HighLight)) break;
			};
		if ($isactiveday)
			{
			$string .= '<td align=center valign=middle bgcolor="'.$this->Color_ActiveDay_BG.'">';
			}
		else	{
			$string .= '<td align=center valign=middle bgcolor="'.$this->Color_InActiveDay_BG.'">';
			};
		if ((strlen($this->DayLink) > 0) && ((($this->LinkOnlyActiveDays) && ($isactiveday)) || (!($this->LinkOnlyActiveDays))))
			{
			$string .= '<a href="'.$this->DayLink.$daystart.'">';
			};
		if ($isactiveday)
			{
			$string .= '<font size="'.$this->DaySize.'" color="'.$this->Color_ActiveDay_FG.'">';
			}
		else	{
			$string .= '<font size="'.$this->DaySize.'" color="'.$this->Color_InActiveDay_FG.'">';
			};
		$string .= $day;
		$string .= '</font>';
		if ((strlen($this->DayLink) > 0) && ((($this->LinkOnlyActiveDays) && ($isactiveday)) || (!($this->LinkOnlyActiveDays))))
			{
			$string .= '</a>';
			};
		$string .= '</td>'."\n";
		if (($dayofweek == 0) || ($day == $numofdays))
			{
			if ($day == $numofdays)
				{
				$temp = ((7-strftime('%w',$daystart)))%7;
				if ($temp > 0)
					{
					if ($this->ShowOtherDays)
						{
						$counter = 1;
						for ($i = 0;$i < $temp;$i++)
							{
							$string .= '<td bgcolor="'.$this->Color_Other_BG.'" align=center><font size="'.$this->DaySize.'" color="'.$this->Color_Other_FG.'">'.$counter++.'</font></td>'."\n";
							};
						}
					else	$string .= '<td colspan="'.$temp.'" bgcolor="'.$this->Color_Other_BG.'" align=center>'.PIXEL.'</td>'."\n";
					};
				};
			$string .= "</tr>\n";
			};
		};

	$string .= "</table>\n";
	return $string;
	}
};

?>