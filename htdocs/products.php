<?php
require_once('include/html-start.inc.php');
require_once('include/head-start.inc.php');
require_once('include/head-stop.inc.php');
require_once('include/body-start.inc.php');
require_once('include/menu-start.inc.php');


?>

<?php
//echo html($_POST);
if (is_array($_POST['PROD']))
	{
	if ($_POST['manufacturerbut'] === 'submit')
		{
		mysqlquery('UPDATE PRODUCT SET MANUFACTURER="'.mysql_escape_string($_POST['manufacturer']).'" WHERE id IN ('.implode(',',array_keys($_POST['PROD'])).')' );
		};
	};
php?>

<?php

//$result2 = mysqlquerykeyval('SELECT DISTINCT MANUFACTURER,MANUFACTURER FROM PRODUCT ORDER BY MANUFACTURER');
$result2 = array_merge(array(0 => ''),mysqlquerykeyval('SELECT NAME,NAME FROM MANUFACTURER ORDER BY NAME'));
if (in_array($_POST['selmanufacturer'],$result2)) $themanufacturer = $_POST['selmanufacturer'];

$result = mysqlquery('SELECT MAX(id) FROM PRICELIST');
$row = mysql_fetch_row($result);
$laatstepricelist = $row[0];

$query = '
SELECT PRODUCT.ID,PRODUCT.MANUFACTURER,PRODUCT.DESCR,FORMAT(PRICE.PRICE,2),FORMAT(PRICE.PRICE * 1.19 ,2),PRICELIST.FILENAME
FROM
PRODUCT
INNER JOIN PRICE ON (PRICE.PRODUCT=PRODUCT.ID)
INNER JOIN PRICELIST ON (PRICE.PRICELIST=PRICELIST.ID)
WHERE PRICE.PRICELIST='.$laatstepricelist.'
'.(isset($themanufacturer) ? 'AND PRODUCT.MANUFACTURER="'.$themanufacturer.'"' : '').'
ORDER BY PRODUCT.MANUFACTURER,PRODUCT.DESCR
';

$result = mysqlquery($query);

echo "<table border=\"1\" cellspacing=\"1\" cellpadding=\"1\">\n";
if ($result)
	{
	echo '<tr>';
	echo '<th>ProdNr</th><th>Merk</th><th>&nbsp;</th><th>Omschrijving</th><th>Week</th><th>PrijsEx</th><th>PrijsInc</th>';
	echo "</tr>\n";

	echo '<tr>';
	echo '<th>'.'&nbsp;'.'</th><th>';
	
	echo '<form method="POST">'."\n";
	echo html_form_option('selmanufacturer',$result2,(isset($themanufacturer) ? $themanufacturer : 0),true);
	echo '</form>'."\n";
	
	
	echo '</th><th>&nbsp;</th><th colspan=4>&nbsp;</th>';
	echo "</tr>\n";

	echo '<form method="POST">'."\n";

	echo '<tr>'."\n";
	echo '<td colspan=2 align="right">zet manufacturer</td>';
	echo '<td align="center">&gt;</td><td colspan=4 align="left">';
	$result3 = mysqlquerykeyval('SELECT name,name FROM MANUFACTURER ORDER BY name');
	echo html_form_option('manufacturer',$result3);
	echo html_form_submit('submit','manufacturerbut');
	echo '</td></tr>';

	while ($row = mysql_fetch_row($result))
		{
		echo '<tr>';
		echo '<td>'.htmlspecialchars($row[0]).'</td>';
		echo '<td>'.htmlspecialchars($row[1]).'</td>';
		echo '<td>'.html_form_checkbox('PROD'.'['.$row[0].']').'</td>';
		echo '<td>'.htmlspecialchars($row[2]).'</td>';
		echo '<td>'.htmlspecialchars($row[5]).'</td>';
		echo '<td align="right">'.htmlspecialchars($row[3]).'</td>';
		echo '<td align="right">'.htmlspecialchars($row[4]).'</td>';
		//while (list(,$val) = each($row)) echo '<td>'.(($val != '') ? nl2br(htmlspecialchars($val)) : '&nbsp').'</td>';



		echo "</tr>\n";
		};
	echo '</form>'."\n";
	};
echo '</table>'."\n";

require_once('include/menu-stop.inc.php');
require_once('include/body-stop.inc.php');
require_once('include/html-stop.inc.php');
?>
