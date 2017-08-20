<!DOCTYPE html>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<meta name="viewport" content="initial-scale=1.0, user-scalable=no" />
		<link rel="stylesheet" href="css/style.css" />
		<script src="js/jquery-2.2.0.min.js"></script>
		<script src="js/script.js"></script>
		<script type="text/javascript" src="js/clickEvent.js"></script>
		<script src="js/GetLengthInMap.js"></script>
		<script src="js/Download.js"></script>
		<script src="js/clickEvent.js"></script>
		<script src="js/laydate/laydate.js"></script>
		<script src="js/echarts.min.js"></script>
		<script src="js/macarons.js"></script>
		<script src="js/mycookie.js"></script>
		<script type="text/javascript" src="http://api.map.baidu.com/api?v=2.0&ak=6qZsSVHIwaY5jmVE1uK0j1k0"></script>
		<title>吉林康达保护性耕作监测系统</title>
		<script>
		var avg;
		var areas;
		var day;
		var zuoyehao;
		var first= true;
		var body;
		/*next is to drawing the report*/
				function draw(){
			var center = document.getElementById("center");
			center.style.display = "block";
			var myChart = echarts.init(document.getElementById('report'), 'macarons');
option = {
	title: {
		text: '作业面积和覆盖率',
		subtext: '当天数据'
	},
	tooltip: {
		trigger: 'axis'
	},
	legend: {
		data: ['面积', '覆盖率']
	},
	toolbox: {
		show: true,
		feature: {
			mark: {
				show: true
			},
			dataView: {
				show: true,
				readOnly: false
			},
			magicType: {
				show: true,
				type: ['line', 'bar']
			},
			restore: {
				show: true
			},
			saveAsImage: {
				show: true
			}
		}
		
	},
	calculable: true,
	xAxis: [{
		type: 'category',
		data:  areas.ZUOYEHAO   //['1月', '2月', '3月', '4月', '5月', '6月', '7月', '8月', '9月', '10月', '11月', '12月']
	}],
	yAxis: [{
		type: 'value'
	}],
	series: [{
		name: '面积',
		type: 'bar',
		data:areas.MIANJI,
		markPoint: {
			data: [{
				type: 'max',
				name: '最大值'
			}, {
				type: 'min',
				name: '最小值'
			}]
		},
		markLine: {
			data: [{
				type: 'average',
				name: '平均值'
			}]
		}
	}, {
		name: '覆盖率',
		type: 'bar',
		data: avg.FUGAILV,//[2.6, 5.9, 9.0, 26.4, 28.7, 70.7, 175.6, 182.2, 48.7, 18.8, 6.0, 2.3],
		markPoint: {
			data: [{
				name: '年最高',
				value: 182.2,
				xAxis: 7,
				yAxis: 183,
				symbolSize: 18
			}, {
				name: '年最低',
				value: 2.3,
				xAxis: 11,
				yAxis: 3
			}]
		},
		markLine: {
			data: [{
				type: 'average',
				name: '平均值'
			}]
		}
	}]
};
myChart.setOption(option);
}
/*以下程序用于报表*/
		//获取面积数据
		function getReport(day){
			var xmlhttp;
				if (window.XMLHttpRequest) { // code for IE7+, Firefox, Chrome, Opera, Safari
					xmlhttp = new XMLHttpRequest();
				} else { // code for IE6, IE5
					xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
				}
				var form=new FormData();
				form.append("table",day);
				xmlhttp.open('POST', 'Service/Mianji_Report.php', false);
				xmlhttp.send(form);
			    areas=JSON.parse(xmlhttp.responseText);
				for(var i=0;i<areas.ZUOYEHAO.length;i++){
					areas.MIANJI[i]=parseFloat(areas.MIANJI[i]);
				}
				getReportavg(day);
				}
		//获取平均覆盖率数据
		function getReportavg(day){
			var xmlhttp;
			if (window.XMLHttpRequest) { // code for IE7+, Firefox, Chrome, Opera, Safari
					xmlhttp = new XMLHttpRequest();
				} else { // code for IE6, IE5
					xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
				}
				var form=new FormData();
				form.append("table",day);
				xmlhttp.open('POST', 'Service/avg_Report.php', false);
				xmlhttp.send(form);
				var str=xmlhttp.responseText;
				//var temp = avg+"";
				str=str.replace(/AVG\(FUGAILV\)/,"FUGAILV");
				avg=JSON.parse(str);
				for(var i=0;i<avg.ZUOYEHAO.length;i++){
				avg.FUGAILV[i]=parseFloat(avg.FUGAILV[i]);
				}
				draw();
			}	
	    window.onload = function() {
	    	if(getCookie('username')=='')
	    	{
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
			window.location.href="Data_export .php";
		}
		li6.onclick = function() {
			window.location.href="machine_list.php";
		}
		ok.onclick = function() {
			day = demo.value.replace(/-/g, "_");
			getReport(day);
		}
		fu.style.display="block";
	}
		</script>
	</head>
	<body>
	<!--<div id="wait" style="z-index: 102;position: absolute;width: 100%;height: 100%;">
		<img src="img/5-121204193935-51.gif"  style="padding-top:50%;padding-left: 50%;"/>
	</div>-->
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
		<div id="gongkuang">
			
		</div>
		<div id="lishi">
			
		</div>
		<div id="center">
		<div id="report">
			
		</div>
		</div>

		<br />
		<br />
		<div id="allmap"></div>
		<div id="footer">
			<img class="banquan0" src="img/banquan0.png" />
			<img class="banquan1" src="img/banquan1.png" />
			<img class="banquan2" src="img/banquan2.png" />
		</div>
	</body>

</html>

<script type="text/javascript">
	var markcol;
	// 百度地图API功能
	//GPS坐标
	var x = 125.307;
	var y = 43.82714;
	var ggPoint = new BMap.Point(x, y);
	//地图初始化
	var bm = new BMap.Map("allmap");
	bm.centerAndZoom(ggPoint, 18);
	bm.addControl(new BMap.NavigationControl());
	bm.enableScrollWheelZoom(true);
	var basepoint = null;
	var top_left_control = new BMap.ScaleControl({
		anchor: BMAP_ANCHOR_TOP_LEFT
	});
	bm.addControl(top_left_control);

	function to_center(j, w) {
		var p = new BMap.Point(j, w);
		bm.setCenter(p);
	}
/*以下程序为添加自定义覆盖物*/	
	function ComplexCustomOverlay(point, text, mouseoverText){		
	 this._point = point;
      this._text = text;
      this._overText = mouseoverText;
    }
    ComplexCustomOverlay.prototype = new BMap.Overlay();
    ComplexCustomOverlay.prototype.initialize = function(map){
      this._map = map;
      var div = this._div = document.createElement("div");
      div.style.position = "absolute";
      div.style.zIndex = BMap.Overlay.getZIndex(this._point.lat);
      div.style.backgroundColor = "#EE5D5B";
      div.style.border = "1px solid #BC3B3A";
      div.style.color = "white";
      div.style.height = "18px";
      div.style.padding = "2px";
      div.style.lineHeight = "18px";
      div.style.whiteSpace = "nowrap";
      div.style.MozUserSelect = "none";
      div.style.fontSize = "12px";
      var span = this._span = document.createElement("span");
      div.appendChild(span);
      span.appendChild(document.createTextNode(this._text));      
      var that = this;
      var arrow = this._arrow = document.createElement("div");
      arrow.style.background = "url(http://map.baidu.com/fwmap/upload/r/map/fwmap/static/house/images/label.png) no-repeat";
      arrow.style.position = "absolute";
      arrow.style.width = "11px";
      arrow.style.height = "10px";
      arrow.style.top = "22px";
      arrow.style.left = "10px";
      arrow.style.overflow = "hidden";
      div.appendChild(arrow);
      div.onmouseover = function(){
        this.style.backgroundColor = "#6BADCA";
        this.style.borderColor = "#0000ff";
        this.getElementsByTagName("span")[0].innerHTML = that._overText;
        arrow.style.backgroundPosition = "0px -20px";
      }

      div.onmouseout = function(){
        this.style.backgroundColor = "#EE5D5B";
        this.style.borderColor = "#BC3B3A";
        this.getElementsByTagName("span")[0].innerHTML = that._text;
        arrow.style.backgroundPosition = "0px 0px";
      }
      bm.getPanes().labelPane.appendChild(div);
      return div;
    }
    ComplexCustomOverlay.prototype.draw = function(){
      var map = this._map;
      var pixel = map.pointToOverlayPixel(this._point);
      this._div.style.left = pixel.x - parseInt(this._arrow.style.left) + "px";
      this._div.style.top  = pixel.y - 30 + "px";
    }
			
</script>