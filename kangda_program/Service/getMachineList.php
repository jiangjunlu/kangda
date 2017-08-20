<?php
require_once('config.php');
$conn = oci_connect(USERNAME, PASSWORD, HOST);
//$conn = oci_connect('scott', 'Kangda2', '101.201.50.78:1521/Kangda');
// 建立连接
if (!$conn) {
	$e = oci_error();
	print htmlentities($e['message']);
	exit ;
}
$sql_sp = "begin WEB.select_machinelist(:mycur);end;";
$stmt = oci_parse($conn, $sql_sp);
$p_cursor = oci_new_cursor($conn); 
oci_bind_by_name($stmt, ":mycur", $p_cursor, -1, OCI_B_CURSOR);
oci_execute($stmt);
oci_execute($p_cursor);
$nrows = oci_fetch_all($p_cursor, $results);
if ($nrows > 0) {
	echo json_encode($results);
} else {
	echo "No data found";
}
oci_free_statement($p_cursor);
oci_close($conn);
?>