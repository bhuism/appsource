<?php

function html_form_option($name,$arr,$tdefault='',$onchangesubmit=FALSE)
{
$returner = '<select name="'.$name.'"'.($onchangesubmit ? ' onchange="submit();"' :'').'>';
while (list($key,$val) = each($arr)) $returner .= "<option value=\"$key\"".((strcmp($tdefault,$key)==0) ? " selected":"").">".htmlspecialchars($val)."</option>";
$returner .= "</select>";
return $returner;
};

function html_form_text($name,$tdefault = '',$size = 16)
{
return "<input type=text name=\"$name\"".((strlen($tdefault) > 0) ? " value=\"".htmlspecialchars($tdefault)."\"" : '')." size=$size>";
};

function html_form_password($name,$tdefault = '',$size = 16)
{
return "<input type=password name=\"$name\"".((strlen($tdefault) > 0) ? " value=\"".htmlspecialchars($tdefault)."\"" : '')." size=$size>";
//return "<input type=password name=\"$name\" size=$size>";
};

function html_form_hidden($name,$value)
{
return "<input type=hidden name=\"$name\" value=\"".htmlspecialchars($value)."\">";
};

function html_form_submit($value = 'Verstuur',$name = 'submitbuttonvalue')
{
return "<table border=\"0\" cellpadding=\"0\" cellspacing=\"0\"><tr><td><input type=submit value=\"$value\" name=\"$name\"></td></tr></table>";
};

function html_form_submitimg($src = '/images/text.php?Verstuur',$name = 'submitbuttonvalue')
{
return "<input type=image src=\"$src\" name=\"$name\" border=\"0\">";
};

function html_form_textarea($name,$tdefault = '',$width = 20,$height = 4)
{
return "<textarea name=\"$name\" cols=\"$width\" rows=\"$height\">".htmlspecialchars($tdefault)."</textarea>";
};

function html_form_checkbox($name,$tdefault = false)
{
return "<input type=checkbox name=\"$name\"".(($tdefault === true) ? ' checked':'').'>';
};

function html_form_radio($name,$value='',$tdefault = 'off')
{
return "<input type=radio value=\"$value\" name=\"$name\"".(($tdefault == 'on') ? ' checked':'').'>';
};
?>
