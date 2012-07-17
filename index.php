<?php
$page_title = 'Planetary Biodiversity Inventory';
include ('inc/pbi_head.html');
echo '<h1>Planetary Biodiversity Inventory</h1><br />';

require_once ('../../connect_pbilocality.php');

// Prepare the query:
$stmt = $mysqli->prepare("SELECT localityuid, localitystr, dlat, dlong, nnotes, sitename, createdate, updatedate, createdby, updatedby FROM locality LIMIT 50");

if (!$stmt->execute())
  echo "Execute failed: (" . $stmt->errno . ") " . $stmt->error;
echo 'These are words!';
$res = $stmt->get_result();
$row = $res->fetch_assoc();
	
//printf("id = %s (%s)\n", $row['id'], gettype($row['id']));
//printf("label = %s (%s)\n", $row['label'], gettype($row['label']
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

$bg = '#eeeeee'; // Set the initial background color.

while ($row = mysqli_fetch_array($r, MYSQLI_ASSOC)) {

	$bg = ($bg=='#eeeeee' ? '#ffffff' : '#eeeeee'); // Switch the background color.
	
	echo '<tr bgcolor="' . $bg . '">
		<td align="left">' . $row['localityuid'] . '</td> 
		<td align="left">' . $row['localitystr'] . '</td>
		<td align="left">' . $row['dlat'] . '</td>
		<td align="left">' . $row['dlong'] . '</td>
		<td align="left">' . $row['nnotes'] . '</td>
		<td align="left">' . $row['sitename'] . '</td>
		<td align="left">' . $row['createdate'] . '</td>
		<td align="left">' . $row['updatedate'] . '</td>
		<td align="left">' . $row['createdby'] . '</td>
		<td align="left">' . $row['updatedby'] . '</td>
	</tr>';
	
} // End of WHILE loop.


mysqli_free_result ($r);
mysqli_close($dbc);

include ('inc/pbi_foot.html');
?>
