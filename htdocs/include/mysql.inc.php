<?php


function mysqlerror($msg)
{
echo "<hr>\n";
echo "MySQL Error:".mysql_errno().": ".mysql_error()."<br>\n";
echo "MySQL Error:<font color=red>".htmlspecialchars($msg)."</font><br>\n";
echo "<hr>\n";
}


#define(config[db][host], '127.0.0.1');
$config[db][host] = '127.0.0.1';
$config[db][user] = 'root';
$config[db][pass] = 'killer';
$config[db][name] = 'store';

function mysqlconnect()
{
global $config;
return mysql_connect($config[db][host],$config[db][user],$config[db][pass]);
};

function mysqlquery($query)
{
global $config;
$link = mysqlconnect();
if ($link)
	{
	if (mysql_select_db($config[db][name],$link))
		{
//		echo $query."<br>";
		$result = mysql_query($query,$link);
		if ($result)
			{
//			mysql_close($link);
			return $result;
			}
		else	mysqlerror($query);
		}
	else 	mysqlerror("mysql_select_db()");
	mysql_close($link);
	}
else	{
	mysqlerror("mysql_connect('".$config[db][host]."','".$config[db][user]."')");
	exit;
	};
return false;
}

/*
function mysqlquerykeyval($query)
{
$result = mysqlquery($query);
if ($result == false) return;
$result = Array();
};
*/

function mysqlquerykeyval($query)
{
$ret = array();
$result = mysqlquery($query);
while ($row = mysql_fetch_row($result))
	{
	$ret[$row[0]] = $row[1];
	};
return $ret;
};



function htmlresult($result,$header = '')
{
echo "<table border=\"1\" cellspacing=\"0\" cellpadding=\"0\">\n";
if ($result)
	{
	if (strlen($header) > 0) echo "<tr><th colspan=".mysql_num_fields($result).">$header</th></tr>\n";
	echo '<tr>';
	for ($tel = 0; $tel < mysql_num_fields($result) ; $tel++)
		{
		echo '<th>'.ucfirst(mysql_field_name($result,$tel)).'</th>';
		};
	echo "</tr>\n";
	while ($row = mysql_fetch_assoc($result))
		{
		while (list(,$val) = each($row)) echo '<td>'.(($val != '') ? nl2br(htmlspecialchars($val)) : '&nbsp').'</td>';
		echo "</tr>\n";
		};
	};
echo "</table>\n";
};

function htmlquery($query)
{
$result = mysqlquery($query);
if ($result)
	{
	htmlresult($result);
	return $result;
	}
else	{
	echo "query '$query' failed<br>\n";
	return FALSE;
	};
};

?>