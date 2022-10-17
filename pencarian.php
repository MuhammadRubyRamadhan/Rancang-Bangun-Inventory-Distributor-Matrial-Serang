<?php 

$conn = mysql_connect("localhost", "root", "phpdasar");

function query($query) {
	global $conn;
	$result = mysql_query($conn, $query);
	$rows = [];
	while( $row = mysqli_fetch_assoc($result) ) {
		$rows[] = $row;
	}
	return $rows;
}

function search($keyboard) {

	$query = "SELECT * FROM barang
				WHERE
			nama = '$keyboard'
		";
	return query($query);
}