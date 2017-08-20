function tanchu(n,body){
	/*查询该日期文件下的设备号，for循环添加li标签*/
	var u = document.createElement("ul");
	var lishi = document.getElementById("lishi");
	u.style.padding = "0";
	u.style.listStyle = "none";
	u.style.paddingTop = "10px";
	for(var i=0;i<body.MACHINE_ID.length;i++){
	var l = document.createElement("li");
	l.innerHTML = "设备号:"+body.MACHINE_ID[i];
	l.id=body.MACHINE_ID[i];
	l.onmouseover = function(){
		this.style.background = "#009F95";
		this.style.color = "#FFFFFF";
		this.style.cursor = "pointer";
	}
	l.onmouseout = function(){
		this.style.background = "";
		this.style.color = "black";
	}
	/*点击设备号显示出对应的作业号，点击设备号，显示对应点*/
	l.onclick = function(){
		getWork(n,this.id);
	}
	u.appendChild(l);
	}
	lishi.innerHTML='';
	lishi.appendChild(u);
	lishi.style.display="block";
}