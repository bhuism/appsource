<?php

include ('html.inc.php');

function html($var)
{
if (is_array($var))
        {
        if (count($var) > 0)
                {
                $temp = "<table border=1 cellpadding=0 cellspacing=0>\n";
                while (list($key,$val) = each($var))
                        {
                        $temp .= '<tr>';
                        $temp .= '<td bgcolor="#B0B0B0" align=right>'.nl2br(htmlspecialchars(trim($key))).'</td>';
                        $temp .= "<td align=left>".html($val)."</td>";
                        $temp .= "</tr>\n";
                        };
                $temp .= "</table>\n";
                return $temp;
                }
        else    return ' &nbsp ';
        }
elseif (is_object($var))
        {
        return html(get_object_vars($var));
        }
elseif (strlen($var) > 0) return "<code>".nl2br(htmlspecialchars(trim($var)))."</code>";
else return ' &nbsp ';
};

function getmicrotime()
{ 
list($usec, $sec) = explode(" ",microtime()); 
return ((float)$usec + (float)$sec); 
};

?>