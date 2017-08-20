<?php
require_once('config.php');
$conn = oci_connect(USERNAME, PASSWORD, HOST);
// 建立连接
if (!$conn) {
	$e = oci_error();
	print htmlentities($e['message']);
	exit ;
}
$table = $_POST['table'];
$machine_id = $_POST['machine_id'];
//$machine_id='1168299786241';
$sql_sp = "begin WEB.select_zuoyehao(:p_table_name,:p_machine_id,:mycur);end;";
$stmt = oci_parse($conn, $sql_sp);
//$table = 'dmr_'.date('Y_m_d',time());;
$tablename = "dmr_".$table;
//$tablename='dmr_2016_04_24';
oci_bind_by_name($stmt, ":p_table_name",$tablename,20);
oci_bind_by_name($stmt, ":p_machine_id",$machine_id,20);
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