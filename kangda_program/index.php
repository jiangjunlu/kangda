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
		<script src="js/mycookie.js"></script>
		<script type="text/javascript" src="http://api.map.baidu.com/api?v=2.0&ak=6qZsSVHIwaY5jmVE1uK0j1k0"></script>
		<title>吉林康达保护性耕作监测系统</title>
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
		<span id="nowtime" style="left: 220px;top: 90px;position: fixed;z-index: 98;"></span>
		<div id="gongkuang" style="overflow: auto;">
			
		</div>
		<div id="lishi">
			
		</div>
		<div id="center">
			
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
    var loc='';
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
	function add_mark(body) {
		var convertor = new BMap.Convertor();
		var myIcon = new BMap.Icon("img/zuobiao.png", new BMap.Size(7,7));
		var myIcon1 = new BMap.Icon("img/zuobiao1.png", new BMap.Size(7,7));
		var myIcon2 = new BMap.Icon("img/zuobiao2.png", new BMap.Size(7,7));
		var nowpoint;
		if(first){
			first=false;
		for (var i = 0; i < body.ZUOYEHAO.length; i++) {
			var txt = body.MACHINE_ID[i];
			nowpoint = new BMap.Point(body.JINDU[i], body.WEIDU[i]);
            var myCompOverlay = new ComplexCustomOverlay(nowpoint,txt,txt);
				//bm.setCenter(nowpoint);
				bm.addOverlay(myCompOverlay);
				}
		}
		else{
			for (var i = 0; i < body.ZUOYEHAO.length; i++) {
			nowpoint = new BMap.Point(body.JINDU[i], body.WEIDU[i]);
				bm.setCenter(nowpoint);
				if(i%2==0){
				var mark = new BMap.Marker(nowpoint,{icon:myIcon});
				}else{
					var mark = new BMap.Marker(nowpoint,{icon:myIcon1});
				}
				bm.addOverlay(mark);
				}
		}	
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
    function getLoc(x,y){
    	var addComp;
    	var geoc = new BMap.Geocoder();   
		var pt = new BMap.Point(x, y);
		geoc.getLocation(pt, function(rs){
			addComp = rs.addressComponents;
			if (rs!=''){
		   loc=rs.address;
		   }
		   else{
		   }
		});
    }
    /*数据获取及页面展示js*/
   var first= true;
		var body;
			function getData() {
				var xmlhttp;
				if (window.XMLHttpRequest) { // code for IE7+, Firefox, Chrome, Opera, Safari
					xmlhttp = new XMLHttpRequest();
				} else { // code for IE6, IE5
					xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
				}
				xmlhttp.open('POST', 'Service/getData.php', true);
				xmlhttp.send();
				xmlhttp.onreadystatechange = function() {
					if (xmlhttp.readyState == 4) {
						if (xmlhttp.status == 200) {
							if(xmlhttp.responseText!='No data found'){
							body = JSON.parse(xmlhttp.responseText);
							showdata();
							}
							else{
								//alert("暂无设备工作中");
								setTimeout("getData()", 3000);
							}
						} else {
							alert("数据请求出错");
						}
					}
				}
			}
            /*展示数据*/
			function showdata() {
				fresh();
				add_mark(body);
			    setTimeout("getData()", 1000);
			}
			
			function fresh(){
					gongkuang=document.getElementById('gongkuang');
					gongkuang.innerHTML='';
					create();
					}
		function create(){
			var time=document.getElementById("nowtime");
			for(var i=0;i<body.ZUOYEHAO.length;i++){
			getLoc(body.JINDU[i],body.WEIDU[i]);
			var dl = document.createElement("dl");
			dl.setAttribute("class","dll");
			var sheBeiHao = body.MACHINE_ID[i];
			var dt = document.createElement("dt");
			dt.innerHTML = "设备号："+sheBeiHao;
			var dd = document.createElement("dd");
			var ul = document.createElement("ul");
			ul.setAttribute("class","dul");
			var li1 = document.createElement("li");
			var li2 = document.createElement("li");
			var li3 = document.createElement("li");
			var li4 = document.createElement("li");
			var mianJi = body.MIANJI[i];
			var nowtime=body.TIME[0].substring(5);
			time.innerHTML=nowtime;
			li1.innerHTML = "面积："+mianJi+"平方米";
			var fuGaiLv = body.FUGAILV[i];
			li2.innerHTML = "覆盖率："+fuGaiLv+"%";
			//var luozishu1 = body.LUOZISHU1[i];
			//li3.innerHTML = "落籽数1："+ luozishu1;
			//var luozishu2 = body.LUOZISHU2[i];
			//li4.innerHTML = "落籽数2："+ luozishu2;
			var shendu=body.SHENDU[i];
			if(shendu!=512){
			li3.innerHTML="深松深度："+shendu+"厘米";
			}else{
			li3.innerHTML="深松深度：0厘米";
			}
			li4.innerHTML="设备地点："+loc;
			ul.appendChild(li1);
			ul.appendChild(li2);
			ul.appendChild(li3);
			ul.appendChild(li4);
			dd.appendChild(ul);
			dl.appendChild(dt);
			dl.appendChild(dd);
			gongkuang.appendChild(dl);
			gongkuang.style.display = "block";
			//close1.style.display = "block";
			}
		}
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
			getMachine(n);
		}
		getData();
	}
</script>