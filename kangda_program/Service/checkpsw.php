<?php
require_once('config.php');
header("content-type:text/html;charset=utf-8");
$machine = $_POST['machineid'];
$pwd = $_POST['psw'];
$conn = oci_connect(USERNAME, PASSWORD,HOST);
// 建立连接
if (!$conn) {
	$e = oci_error();
	print htmlentities($e['message']);
	exit ;
}
$flag;
$sql_sp="begin web.checkpsw(:p_machine,:p_pwd,:p_flag);end;";
$stmt=ociparse($conn, $sql_sp);
ocibindbyname($stmt,":p_machine",$machine, 20);
ocibindbyname($stmt,":p_pwd",$pwd , 20);
ocibindbyname($stmt,":p_flag",$flag , 2);
ociexecute($stmt);
echo $flag;
oci_close($conn);
?>