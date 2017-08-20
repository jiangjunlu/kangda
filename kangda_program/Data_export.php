<!DOCTYPE html>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<meta name="viewport" content="initial-scale=1.0, user-scalable=no" />
		<link rel="stylesheet" href="css/style.css" />
		<link href=" //netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css" rel="stylesheet">
		<script src="js/jquery-2.2.0.min.js">
		</script>
		<script src="js/script.js">
		</script>
		<script type="text/javascript" src="js/clickEvent.js">
		</script>
		<script src="js/GetLengthInMap.js">
		</script>
		<script src="js/Download.js">
		</script>
		<script src="js/clickEvent.js">
		</script>
		<script src="js/laydate/laydate.js">
		</script>
		<script src="js/mycookie.js"></script>
		<script src='http://cdn.bootcss.com/jquery/1.11.1/jquery.min.js'>
		</script>
		<script src='http://cdn.bootcss.com/bootstrap/3.2.0/js/bootstrap.min.js'>
		</script>
		<title>
			吉林康达保护性耕作监测系统
		</title>
		<style>
		body {
	padding-top: 70px;
}
#_table {
	padding: 10px;
	overflow: scroll;
	height: 300px;
	margin-top: 20px;
}
#table-name {
	text-align: left;
}
#out {
	display: block;
	text-decoration: none;
	border: 2px solid #999999;
	text-align: center;
	width: 50px;
	cursor: pointer;
	float: right;
	margin-top: 10px;
	margin-right: 10px;
}</style>
		<script>var first = true;
var data;
var n;
var jsondata;
window.onload = function() {
	if(getCookie('username')==''){
		alert("您还未登录");
		window.location.href="Login.php";
	}
	var li1 = document.getElementById("li-1");
	var li2 = document.getElementById("li-2");
	var li3 = document.getElementById("li-3");
	var li4 = document.getElementById("li-4");
	var li5 = document.getElementById("li-5");
	var li6 = document.getElementById("li-6");
	var fu = document.getElementById("fu");
	var demo = document.getElementById("demo");
	var ok = document.getElementById("ok");
	var gongkuang = document.getElementById("gongkuang");
	var center = document.getElementById("center");
	li1.onclick = function() {
		window.location.href = "Report.php";
	}
	li2.onclick = function() {
		window.location.href = "index.php";
	}
	li3.onclick = function() {
		window.location.href = "history.php";
	}
	li4.onclick = function() {
		window.location.href = "WorkDescribe.php";
	}
	li5.onclick = function() {
		window.location.href = "Data_export.php";
	}
	li6.onclick = function() {
			window.location.href="machine_list.php";
		}
	ok.onclick = function() {
		n = demo.value.replace(/-/g, "_");
		getTable(n);
	}
	fu.style.display = "block";
	n="2016_04_28";
	getTable(n);
}

function getTable(n) {
	var form = new FormData();
	form.append('table', n);
	var xmlhttp;
	if (window.XMLHttpRequest) { // code for IE7+, Firefox, Chrome, Opera, Safari
		xmlhttp = new XMLHttpRequest();
	} else { // code for IE6, IE5
		xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
	}
	xmlhttp.open('POST', 'Service/getTable.php', true);
	xmlhttp.send(form);
	xmlhttp.onreadystatechange = function() {
		if (xmlhttp.readyState == 4) {
			if (xmlhttp.status == 200) {
				jsondata = xmlhttp.responseText;
				data = JSON.parse(xmlhttp.responseText);
				var table = document.getElementById("Ta").getElementsByTagName("tr");
				for (var col = 1; col <= 8; col++) {
					var k = table[col].getElementsByTagName("td");
					k[0].innerHTML = data.RECORD_ID[col - 1];
					k[1].innerHTML = data.MACHINE_ID[col - 1];
					k[2].innerHTML = data.JINDU[col - 1];
					k[3].innerHTML = data.WEIDU[col - 1];
					k[4].innerHTML = data.ZUOYEHAO[col - 1];
					k[5].innerHTML = data.SHENDU[col - 1];
					k[6].innerHTML = data.MIANJI[col - 1];
					k[7].innerHTML = data.TIME[col - 1];
				}
			} else {
				alert("数据请求出错");
			}
		}
	}
}
function Export(dates) {
	var form = new FormData();
	var len=data.RECORD_ID.length;
	form.append('data', dates);
	form.append('name', n);
	form.append('count',len);
	var xmlhttp;
	if (window.XMLHttpRequest) { // code for IE7+, Firefox, Chrome, Opera, Safari
		xmlhttp = new XMLHttpRequest();
	} else { // code for IE6, IE5
		xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
	}
	xmlhttp.open('POST', 'Export.php', false);
	xmlhttp.send(form);
	window.open("Excel/"+n+".xlsx");
}
</script>
	</head>
	<body>
		<!--<div id="wait" style="z-index: 102;position: absolute;width: 100%;height: 100%;">
		<img src="img/5-121204193935-51.gif"  style="padding-top:50%;padding-left: 50%;"/>
		</div>-->
		<div id="header">
			<ul id="main">
				<li id="li-1">
					<a href="#">
						报表查询
					</a>
				</li>
				<li id="li-2">
					<a href="#">
						工况监测
					</a>
				</li>
				<li id="li-3">
					<a href="#">
						历史记录
					</a>
				</li>
				<li id="li-4">
					<a href="#">
						作业描述
					</a>
				</li>
				<li id="li-5">
					<a href="#">
						数据导出
					</a>
				</li>
				<li id="li-6">
					<a href="#">
						设备管理
					</a>
				</li>
			</ul>
			<img class="logo0" src="img/logo0.png" />
			<img class="logo1" src="img/logo1.png" />
			<br />
			<div id="fu">
				<input class="laydate-icon" id="demo" value="" onclick="laydate()">
				<a id="ok">
					提交
				</a>
			</div>
		</div>
		<br />
		<div id="_table"align=center class="s" >
			<p id="table-name">
				表名
			</p>
			<table id="Ta" class="table table-bordered table-hover table-responsive ">
				<thead>
					<tr>
						<td>
							编号
						</td>
						<td>
							设备号
						</td>
						<td>
							经度
						</td>
						<td>
							纬度
						</td>
						<td>
							作业号
						</td>
						<td>
							深度
						</td>
						<td>
							面积
						</td>
						<td>
							时间
						</td>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td>
						</td>
						<td>
						</td>
						<td>
						</td>
						<td>
						</td>
						<td>
						</td>
						<td>
						</td>
						<td>
						</td>
						<td>
						</td>
					</tr>
					<tr>
						<td>
						</td>
						<td>
						</td>
						<td>
						</td>
						<td>
						</td>
						<td>
						</td>
						<td>
						</td>
						<td>
						</td>
						<td>
						</td>
					</tr>
					<tr>
						<td>
						</td>
						<td>
						</td>
						<td>
						</td>
						<td>
						</td>
						<td>
						</td>
						<td>
						</td>
						<td>
						</td>
						<td>
						</td>
					</tr>
					<tr>
						<td>
						</td>
						<td>
						</td>
						<td>
						</td>
						<td>
						</td>
						<td>
						</td>
						<td>
						</td>
						<td>
						</td>
						<td>
						</td>
					</tr>
					<tr>
						<td>
						</td>
						<td>
						</td>
						<td>
						</td>
						<td>
						</td>
						<td>
						</td>
						<td>
						</td>
						<td>
						</td>
						<td>
						</td>
					</tr>
					<tr>
						<td>
						</td>
						<td>
						</td>
						<td>
						</td>
						<td>
						</td>
						<td>
						</td>
						<td>
						</td>
						<td>
						</td>
						<td>
						</td>
					</tr>
					<tr>
						<td>
						</td>
						<td>
						</td>
						<td>
						</td>
						<td>
						</td>
						<td>
						</td>
						<td>
						</td>
						<td>
						</td>
						<td>
						</td>
					</tr>
					<tr>
						<td>
						</td>
						<td>
						</td>
						<td>
						</td>
						<td>
						</td>
						<td>
						</td>
						<td>
						</td>
						<td>
						</td>
						<td>
						</td>
					</tr>
				</tbody>
			</table>
		</div>
		<a id="out" href="" onclick="Export(jsondata)">
			导出
		</a>
		<div id="gongkuang">
		</div>
		<div id="lishi">
		</div>
		<div id="center">
		</div>
		<br />
		<br />
		<div id="allmap">
		</div>
		<div id="footer">
			<img class="banquan0" src="img/banquan0.png" />
			<img class="banquan1" src="img/banquan1.png" />
			<img class="banquan2" src="img/banquan2.png" />
		</div>
	</body>
</html>
