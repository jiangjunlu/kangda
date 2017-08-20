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
		<script src='http://cdn.bootcss.com/jquery/1.11.1/jquery.min.js'>
		</script>
		<script src='http://cdn.bootcss.com/bootstrap/3.2.0/js/bootstrap.min.js'>
		</script>
		<script src="js/mycookie.js"></script>
		<script type="text/javascript" src="http://api.map.baidu.com/api?v=2.0&ak=6qZsSVHIwaY5jmVE1uK0j1k0">
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
}
</style>
		<script>
		var machineid;
var first = true;
var data;
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
	}
	getMachineList();
}
function getMachineList() {
	var xmlhttp;
	if (window.XMLHttpRequest) { // code for IE7+, Firefox, Chrome, Opera, Safari
		xmlhttp = new XMLHttpRequest();
	} else { // code for IE6, IE5
		xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
	}
	xmlhttp.open('POST', 'Service/getMachineList.php', true);
	xmlhttp.send();
	xmlhttp.onreadystatechange = function() {
		if (xmlhttp.readyState == 4) {
			if (xmlhttp.status == 200) {
				data = JSON.parse(xmlhttp.responseText);
				var table = document.getElementById("Ta").getElementsByTagName("tr");
				for (var col = 1; col <= data.MACHINE_ID.length; col++) {
					var k = table[col].getElementsByTagName("td");
					k[0].innerHTML = data.MACHINE_ID[col - 1];
					k[1].innerHTML = "深松机";
					if(data.STATES[col - 1]=='0'){
						k[2].innerHTML ="设备停止工作";
					}
					else{
						k[2].innerHTML ="设备工作中";
					}
					k[3].innerHTML = data.WIDTH[col - 1];
					k[4].innerHTML = data.PERSON[col - 1];
				}
				for(var i=data.MACHINE_ID.length+1;i<=8;i++){
					var k = table[i].getElementsByTagName("td");
					k[5].style.visibility="hidden";
				}
			} else {
				alert("数据请求出错");
			}
		}
	}
}
/*update*/
function changediv(obj)
        {
            inorup = 1;
            var updatediv = document.getElementById("update");
            updatediv.style.display = "block";
            parent.document.documentElement.scrollTop = parent.document.body.scrollTop = 0;
            document.getElementById("Ta").style.opacity = 0.1;
            document.getElementById("Ta").style.filter = "alpha(opacity = 30)";
            document.getElementById("Ta").style.backgroundColor = "#383838";//虚化背景
            var xmlhttp;
            if (window.XMLHttpRequest) { // code for IE7+, Firefox, Chrome, Opera, Safari
                xmlhttp = new XMLHttpRequest();
            } else { // code for IE6, IE5
                xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
            }
            machineid = obj.parentNode.parentNode.getElementsByTagName('td')[0].innerHTML;
            document.getElementById("machine_id").value =machineid;
        }
        function checkpasw(){
        	var psw=document.getElementById('psw').value;
        	var form= new FormData();
        	form.append('machineid',machineid);
        	form.append('psw',psw);
            var xmlhttp;
            if (window.XMLHttpRequest) { // code for IE7+, Firefox, Chrome, Opera, Safari
                xmlhttp = new XMLHttpRequest();
            } else { // code for IE6, IE5
                xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
            }
            xmlhttp.open("POST", "Service/checkpsw.php", false);
            xmlhttp.send(form);
            s=xmlhttp.responseText;
            if (s==1)
            {
                document.getElementById("checkpsw").style.color="green";
                document.getElementById("checkpsw").innerHTML = "原密码正确";
            }
            else{
                document.getElementById("checkpsw").style.color="red";
                document.getElementById("checkpsw").innerHTML = "原密码有误，重新输入";
            }
        }
        function checknewpsw(){
        	var first_psw=document.getElementById('first_psw').value;
        	var second_psw=document.getElementById('second_psw').value;
        	if(first_psw!=second_psw){
        		document.getElementById("checknewpsw").style.color="red";
                document.getElementById("checknewpsw").innerHTML = "两次输入密码不一致，重新输入";
        	}
        	else{
        		tijiao();
        	}
        }
        function tijiao(){
            var newpassword = document.getElementById("second_psw").value;
            var FileController = "Service/updatepsw.php";    // 接收上传文件的后台地址
            var form = new FormData();
            form.append("machineid", machineid);
            form.append("newpassword", newpassword);// 可以增加表单数据
            // XMLHttpRequest 对象

            var xhr = new XMLHttpRequest();
            if (window.XMLHttpRequest) { // code for IE7+, Firefox, Chrome, Opera, Safari
                xhr = new XMLHttpRequest();
            }
            else { // code for IE6, IE5
                xhr = new ActiveXObject("Microsoft.XMLHTTP");
            }
            xhr.open("post", FileController, true);
            xhr.onload = function () {
                alert("设备密码成功!");
                window.location = "machine_list.php";
            };
            xhr.send(form);
        }
         function c() {
            window.location.href = "machine_list.php";
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
				设备信息
			</p>
			<table id="Ta" class="table table-bordered table-hover table-responsive ">
				<thead>
					<tr>
						<td width="20%">设备号</td>
						<td width="15%">设备类型</td>
						<td width="15%">工作状态</td>
						<td width="15%">深松宽度(米)</td>
						<td width="15%">所属用户</td>
						<td width="20%">操作选项</td>
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
							<a onclick="changediv(this)" href="javascript:; " id="xiugai8">修改设备密码</a>
                    <!--&nbsp;&nbsp;<a onclick="deletedata(this)" href="javascript:;" id="shanchu8">删除</a>
                    &nbsp;&nbsp;<a onclick="look(this)" href="javascript:;" id="chakan8">查看</a>
						-->
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
							<a onclick="changediv(this)" href="javascript:; " id="xiugai8">修改设备密码</a>
                    <!--&nbsp;&nbsp;<a onclick="deletedata(this)" href="javascript:;" id="shanchu8">删除</a>
                    &nbsp;&nbsp;<a onclick="look(this)" href="javascript:;" id="chakan8">查看</a>
						-->
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
							<a onclick="changediv(this)" href="javascript:; " id="xiugai8">修改设备密码</a>
                    <!--&nbsp;&nbsp;<a onclick="deletedata(this)" href="javascript:;" id="shanchu8">删除</a>
                    &nbsp;&nbsp;<a onclick="look(this)" href="javascript:;" id="chakan8">查看</a>
						-->
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
							<a onclick="changediv(this)" href="javascript:; " id="xiugai8">修改设备密码</a>
                    <!--&nbsp;&nbsp;<a onclick="deletedata(this)" href="javascript:;" id="shanchu8">删除</a>
                    &nbsp;&nbsp;<a onclick="look(this)" href="javascript:;" id="chakan8">查看</a>
						-->
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
							<a onclick="changediv(this)" href="javascript:; " id="xiugai8">修改设备密码</a>
                    <!--&nbsp;&nbsp;<a onclick="deletedata(this)" href="javascript:;" id="shanchu8">删除</a>
                    &nbsp;&nbsp;<a onclick="look(this)" href="javascript:;" id="chakan8">查看</a>
						-->
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
							<a onclick="changediv(this)" href="javascript:; " id="xiugai8">修改设备密码</a>
                    <!--&nbsp;&nbsp;<a onclick="deletedata(this)" href="javascript:;" id="shanchu8">删除</a>
                    &nbsp;&nbsp;<a onclick="look(this)" href="javascript:;" id="chakan8">查看</a>
						-->
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
							<a onclick="changediv(this)" href="javascript:; " id="xiugai8">修改设备密码</a>
                    <!--&nbsp;&nbsp;<a onclick="deletedata(this)" href="javascript:;" id="shanchu8">删除</a>
                    &nbsp;&nbsp;<a onclick="look(this)" href="javascript:;" id="chakan8">查看</a>
						-->
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
							<a onclick="changediv(this)" href="javascript:; " id="xiugai8">修改设备密码</a>
                    <!--&nbsp;&nbsp;<a onclick="deletedata(this)" href="javascript:;" id="shanchu8">删除</a>
                    &nbsp;&nbsp;<a onclick="look(this)" href="javascript:;" id="chakan8">查看</a>
						-->
						</td>
					</tr>
				</tbody>
			</table>
			<div class="templatemo-content-container" id="update" style="display: none; width:80%;height: 90%; position: absolute; top:100px; left: 10%">
        <div class="templatemo-content-widget no-padding">
            <div class="panel panel-default table-responsive">
                <table class='tableBorder table table-striped table-bordered templatemo-user-table' align=center>
                    <img src="./img/closediv.png" onclick="c()" style="float:right;height:40px;width:40px" />
                    <tr>
                        <th class='tableHeaderText green-bg white-text' colspan=2 height=25>修改设备信息</th>
                    <tr>
                        <td height=23 colspan="2" class='forumRow'>
                            <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
                    </tr>
                    <tr>
                        <td height="10">&nbsp;</td>
                    </tr>
                </table>
                </td>
                </tr>
                <tr>
                    <td>设备号 </td>
                    <td class='forumRow'>
                        <div class="form-group">
                            <input name='machine_id' type='text' id='machine_id' class="form-control" readonly="readonly">
                        </div>
                    </td>
                </tr>
                <tr>
                    <td class='forumRow' height=23>原密码 <p style="float:right;" id="checkpsw"></p></td>
                    <td class='forumRow'>
                        <div class="form-group">
                            <input type='password' name='psw' class="form-control" id="psw"  onblur="checkpasw()">
                        </div>
                    </td>
                </tr>
            <tr>
                <td class='forumRowHighLight' height=23>新密码</td>
                <td class='forumRowHighLight'>
                    <span class="forumRow">
                        <div class="form-group">
                            <input name='first_psw' type='password' id='first_psw' value="" size='40' class="form-control">
                        </div>
                </td>
            </tr>
            <tr>
                <td class='forumRowHighLight' height=23>确认密码 <p style="float:right;" id="checknewpsw"></p></td>
                <td class='forumRowHighLight'>
                    <span class="forumRow">
                        <div class="form-group">
                            <input name='second_psw' type='password' id='second_psw' value="" size='40' class="form-control" onblur="checknewpsw()">
                        </div>
                </td>
            </tr>
            
        </div>
    </div>
		</div>
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
