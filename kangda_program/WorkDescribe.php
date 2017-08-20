<!DOCTYPE html>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<meta name="viewport" content="initial-scale=1.0, user-scalable=no" />
		<link rel="stylesheet" href="css/newfirst.css"/>
		<script src="js/jquery-2.2.0.min.js"></script>
		<script src="js/script.js"></script>
		<script type="text/javascript" src="js/clickEvent.js"></script>
		<script src="js/GetLengthInMap.js"></script>
		<script src="js/Download.js"></script>
		<script src="js/clickEvent.js"></script>
		<script src="js/laydate/laydate.js"></script>
		<script src="js/mycookie.js"></script>
		<script type="text/javascript" src="http://api.map.baidu.com/api?v=2.0&ak=6qZsSVHIwaY5jmVE1uK0j1k0"></script>
		<title>吉林康达保护性耕作监测系统</title>
		<script>
	    window.onload = function() {
	    	if(getCookie('username')=='')
	    	{
	    		alert("您还未登录");
	    		window.location.href="Login.php";
	    	}else{
		var li1 = document.getElementById("li-1");
		var li2 = document.getElementById("li-2");
		var li3 = document.getElementById("li-3");
		var li4 = document.getElementById("li-4");
		var li5 = document.getElementById("li-5");
		var li6 = document.getElementById("li-6");
		var fu = document.getElementById("fu");
		var demo = document.getElementById("demo");
		var ok = document.getElementById("ok");
		var gongkuang= document.getElementById("gongkuang");
		var center = document.getElementById("center");
		li1.onclick = function() {
			window.location.href="Report.php";
		}
		li2.onclick = function() {
			window.location.href="index.php";
		}
		li3.onclick = function() {
			window.location.href="history.php";
		}
		li4.onclick = function() {
			window.location.href="WorkDescribe.php";
		}
		li5.onclick = function() {
			window.location.href="Data_export.php";
		}
		li6.onclick = function() {
			window.location.href="machine_list.php";
		}
		ok.onclick = function() {
			var n = demo.value.replace(/-/g, "_");
			getDescribe(n);
		}
		fu.style.display="block";
		}
	}
	  function getDescribe(n){
	  	var form = new FormData();
	  	form.append('table',n);
	  	var xmlhttp;
	  	if (window.XMLHttpRequest) { // code for IE7+, Firefox, Chrome, Opera, Safari
		xmlhttp = new XMLHttpRequest();
	} else { // code for IE6, IE5
		xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
	}
	xmlhttp.open('POST', 'Service/getDescribe.php', true);
	xmlhttp.send(form);
	xmlhttp.onreadystatechange = function() {
		if (xmlhttp.readyState == 4) {
			if (xmlhttp.status == 200) {
				data = JSON.parse(xmlhttp.responseText);
				for(var i=0;i<data.MACHINE_ID.length;i++){
				var ul = document.getElementById("big-ul");
				var li1= document.createElement("li");
				var li2= document.createElement("li");
				var li3= document.createElement("li");
				var ul1= document.createElement("ul");
				var ul2= document.createElement("ul");
				var span1= document.createElement("span");
				var span2= document.createElement("span");
				li1.className="big-ul-li";
				li3.className="des";
				span1.className="idnum";
				span2.className="machine_id";
				span1.innerHTML="身份证号："+ data.ID[i];
				span2.innerHTML="设备号："+data.MACHINE_ID[i];
				li3.innerHTML="本次作业号为："+data.ZUOYEHAO[i]+",作业面积为："+data.MIANJI[i]+"平方米,"+"平均覆盖率为："+data.FUGAILV[i].substr(0,5)+"%,"+"平均深度为："+data.SHENDU[i].substr(0,5)+"厘米.";
				ul.appendChild(li1);
				li1.appendChild(span1);
				li1.appendChild(ul1);
				ul1.appendChild(li2);
				li2.appendChild(span2);
				li2.appendChild(ul2);
				ul2.appendChild(li3);
				}
			} else {
				alert("数据请求出错");
			}
		}
	}
	}
		</script>
	</head>
	<body>
		<div id="header">
			<ul id="main">
				<li id="li-1"><a href="#">报表查询</a></li>
				<li id="li-2"><a href="#">工况监测</a></li>
				<li id="li-3"><a href="#">历史记录</a></li>
				<li id="li-4"><a href="#">作业描述</a></li>
				<li id="li-5"><a href="#">数据导出</a></li>
				<li id="li-6"><a href="#">设备管理</a></li>
			</ul>
			<img class="logo0" src="img/logo0.png" /><img class="logo1" src="img/logo1.png" />
			<div id="fu">
				<input class="laydate-icon" id="demo" value="" onclick="laydate()"><a id="ok">提交</a></div>
		</div>
		<br/>
		<div class="center">
			<div class="center-ul">
				<ul id="big-ul">
					<!--<li class="big-ul-li">身份证号：<span class="idnum"></span>
						<ul>
							<li>设备ID：<span class="machine_id"></span>
								<ul>
									<li class="des"></li>
								</ul>
							</li>
							
						</ul>
					</li>
					<li class="big-ul-li">身份证号：<span class="idnum"></span>
						<ul>
							<li>设备ID：<span class="machine_id"></span>
								<ul>
									<li class="des"></li>
								</ul>
							</li>
							
						</ul>
					</li>
					<li class="big-ul-li">身份证号：<span class="idnum"></span>
						<ul>
							<li>设备ID：<span class="machine_id"></span>
								<ul>
									<li class="des"></li>
								</ul>
							</li>
						</ul>
					</li>-->
				</ul>
			</div>
		 </div>
		<div id="footer">
			<img class="banquan0" src="img/banquan0.png" />
			<img class="banquan1" src="img/banquan1.png" />
			<img class="banquan2" src="img/banquan2.png" />
		</div>
	</body>
</html>