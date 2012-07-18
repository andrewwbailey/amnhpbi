<?php
$page_title = 'Planetary Biodiversity Inventory';
include ('inc/pbi_head.html');
echo '<h1>Planetary Biodiversity Inventory</h1><br />';

require_once("../../../connect_pbilocality.php");
// Prepare the query:
$stmt = $mysqli->prepare("SELECT localityuid, localitystr, dlat, dlong, nnotes, sitename, createdate, updatedate, createdby, updatedby FROM Locality LIMIT 50");

if (!$stmt->execute())
  echo "Execute failed: (" . $stmt->errno . ") " . $stmt->error;

$stmt->store_result();
$stmt->bind_result($col1,$col2,$col3,$col4,$col5,$col6,$col7,$col8,$col9,$col10);


echo "Number of rows: " . $stmt->num_rows . "<br />";
echo "Number of fields: " . $stmt->field_count . "<br />";
  
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

while ($stmt->fetch()) {
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

$stmt->close();
$stmt->free_result();
	
//mysqli_free_result ($r);
//mysqli_close($dbc);

include ('inc/pbi_foot.html');
?>
