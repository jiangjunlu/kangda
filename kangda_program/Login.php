<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title>吉林康达保护性耕作监测系统</title>
		<link rel="stylesheet" href="css/DLjiemian.css" />
		<script src="js/mycookie.js"></script>
		<script>
		function login() {
	var FileController = "Service/login.php"; // 接收上传文件的后台地址
	var name = document.getElementById('j_username').value;
	var pwd = document.getElementById('j_password').value;
	var form = new FormData();
	form.append("name", name);
	form.append("password", pwd);
	// XMLHttpRequest 对象
	var xhr = new XMLHttpRequest();
	if(window.XMLHttpRequest) { // code for IE7+, Firefox, Chrome, Opera, Safari
		xhr = new XMLHttpRequest();
	} else { // code for IE6, IE5
		xhr = new ActiveXObject("Microsoft.XMLHTTP");
	}
	xhr.open("POST", FileController, true);
	xhr.onload = function() {
		if(xhr.responseText == 1) {
			setCookie('username',name);
			location.replace('index.php');
		} else {
			alert("用户名或密码有误！");
		}
	};
	xhr.send(form);
}
</script>
	</head>
	<body>
		<div class="page-container">
			<div class="main_box">
				<div class="login_box">
					<div class="login_logo">
						<h2 style="color: white">吉林康达保护性耕作监测系统</h2>
					</div>
					<div class="login_form">
						<!--<form action="Service/login.php" id="login_form" method="post" enctype="multipart/form-data">-->
						<div class="form-group">
							<label for="j_username" class="t" style="color: white">用户名：</label>
							<input id="j_username" value="" name="name" type="text" class="name_paw" >
						</div>
						<div class="form-group">
							<label for="j_password" class="t" style="color: white">密　码：</label>
							<input id="j_password" value="" name="password" type="password" class="name_paw">
						</div>
						<div class="form-group space">
							<label class="b"></label>
							<button type="submit"  id="submit_btn" onclick="login()" 	class="btn btn-primary ">
							&nbsp;登&nbsp;录&nbsp
							</button>
							<input type="reset" id="reset_btn" value="&nbsp;重&nbsp;置&nbsp;" class="btn btn-default ">
						</div>
						<!--</form>-->
					</div>
				</div>
			</div>
		</div>
	</body>
</html>
