<?php
$page_title = 'PBI - AMNH';

include ('inc/pbi_head.html');

echo "<header>
	<h1>Planetary Biodiversity Inventory for Plant Bugs(@AMNH)</h1> <br />
	<h2>Data Clean-Up Project</h2>
	</header>";


require_once("../../../connect_pbilocality.php");

$display = 250;

$stmtCount = $mysqli->prepare("SELECT COUNT(localityuid) FROM Locality");

if (!$stmtCount->execute()) {
	echo "Database query error: (" . $stmtCount->errno . ") " . $stmtCount->error;
	}

$stmtCount->bind_result($recCount);

while($stmtCount->fetch()){
	echo $recCount . "<p/>";
}
$stmtCount->close();

$pages = ceil($recCount/$display);

echo 'Pages: ' . $pages . '<br />';

$p = 0;

if (isset($_GET['p'])) {
	$p = $_GET['p'];
	$ubound = $display * $p;
	$lbound = $display * ($p - 1);
}else{
	$ubound = $display;
	$lbound = 0;
}
echo 'Page Click: ' . $p . '<br />';
echo 'Ubound: ' . $ubound . '<br />';
echo 'Lbound: ' . $lbound;

echo '<div class="datagrid">';
// Prepare the query:
$stmtMain = $mysqli->prepare("SELECT localityuid, localitystr,
 dlat, dlong, nnotes, sitename, createdate, updatedate, createdby, 
 updatedby FROM Locality LIMIT " . $lbound . "," . $ubound);

if (!$stmtMain->execute()) {
	echo "Execute failed: (" . $stmtMain->errno . ") " . $stmtMain->error;
	}
  
$stmtMain->bind_result($col1,$col2,$col3,$col4,$col5,$col6,$col7,$col8,$col9,$col10);

echo '<table align="center" cellspacing="0" cellpadding="5" width="90%">
<tr>
	<td align="left" width="35"><b>Locality ID</b></td>
	<td align="left" width="35"><b>Locality String</b></td>
	<td align="left" width="35"><b>Latitude</b></td>
	<td align="left" width="35"><b>Longitude</b></td>
	<td align="left" width="35"><b>Notes</b></td>
	<td align="left" width="35"><b>Site Name</b></td>
	<td align="left" width="35"><b>Date Created</b></td>
	<td align="left" width="35"><b>Date Updated</b></td>
	<td align="left" width="35"><b>Created By</b></td>
	<td align="left" width="35"><b>Updated By</b></td>
</tr>';

while ($stmtMain->fetch()) {
	echo '<tr>
		<td align="left">' . $col1 . '</td> 
		<td align="left">' . $col2 . '</td>
		<td align="left">' . $col3 . '</td>
		<td align="left">' . $col4. '</td>
		<td align="left">' . $col5 . '</td>
		<td align="left">' . $col6. '</td>
		<td align="left">' . $col7 . '</td>
		<td align="left">' . $col8 . '</td>
		<td align="left">' . $col9 . '</td>
		<td align="left">' . $col10 . '</td>
	</tr>';
}

echo '</table></div><div class="page-select">';

for($i = 1; $i <= $pages; $i++){
	echo '<a href="?p=' . $i . '">[' . $i . '] </a>';
}

echo '</div>';

$stmtMain->close();

include ('inc/pbi_foot.html');
?>
