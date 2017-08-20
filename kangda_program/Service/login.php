<?php
	require_once('config.php');
	header("content-type:text/html;charset=utf-8");
	$name = $_POST['name'];
	$pwd = $_POST['password'];
	$conn = oci_connect(USERNAME, PASSWORD,HOST);
	// 建立连接
	if (!$conn) {
	$e = oci_error();
	print htmlentities($e['message']);
	exit ;
	}
	$flag;
	$sql_sp="begin web.login(:p_name,:p_pwd,:p_flag);end;";
	$stmt=ociparse($conn, $sql_sp);
	ocibindbyname($stmt,":p_name", $name, 20);
	ocibindbyname($stmt,":p_pwd",$pwd , 20);
	ocibindbyname($stmt,":p_flag",$flag , 2);
	ociexecute($stmt);
	echo $flag;
oci_close($conn);
?>