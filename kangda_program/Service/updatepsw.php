<?php
require_once('config.php');
header("content-type:text/html;charset=utf-8");
$machine = $_POST['machineid'];
$pwd = $_POST['newpassword'];
$conn = oci_connect(USERNAME, PASSWORD,HOST);
// 建立连接
if (!$conn) {
	$e = oci_error();
	print htmlentities($e['message']);
	exit ;
}
$flag;
$sql_sp="begin web.updatepsw(:p_machine,:p_pwd);end;";
$stmt=ociparse($conn, $sql_sp);
ocibindbyname($stmt,":p_machine",$machine, 20);
ocibindbyname($stmt,":p_pwd",$pwd , 20);
ociexecute($stmt);
oci_close($conn);
?>