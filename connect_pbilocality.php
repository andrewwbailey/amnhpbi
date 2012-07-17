<?php
$mysqli = new mysqli("localhost", "brownyea_pbiedit", "w@LL@b0ut5", "brownyea_pbilocality");
if ($mysqli->connect_errno) {
    echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
}
?>