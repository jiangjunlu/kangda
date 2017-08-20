<?php
$table =$_POST['table'];
$tablename="dmr_".$table;
$work = $_POST['arr'];
$work_arr=json_decode($work,TRUE);
$work_id=$work_arr["ZUOYEHAO"];
$count=count($work_id);
$filepath = "../Download/".$tablename;
if (is_dir ( $filepath )) {//判断是不是文件夹
    $ch = opendir ( $filepath );//打开文件夹的句柄
    if ($ch) {
        while ( ($filename = readdir( $ch )) != false ) {//判断是不是有子文件或者文件夹
            $filetype = substr ( $filename, strripos ( $filename, "." ) + 1 );
            if ($filetype == "txt" && is_file ( $filepath . "/" . $filename )) {//判断是不是以txt结尾并且是文件
                //echo $filepath . "/" . $filename."内容如下:"."<br/>";
                for($i=0;$i<$count;$i++){
				if($filename==$work_id[$i].".txt")
				{
                $f = fopen ( $filepath . "/" . $filename, "r" );//打开文件
                while (! feof ( $f )) {//循环输出
                    $line = fgets ( $f );
                    echo  $line.";";
                }
                fclose($f);
				}
				}
            }
        }
        closedir ( $ch );
    }
}
?>
