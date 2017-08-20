var MyObj = function(id, value) {　　　　
	return {
		id: id,
		value: value　　　　
	}
}

var tongbu_request = function(arr, url, method) {
	var form = new FormData();
	for (var x in arr) {
		form.append(arr[x].id, arr[x].value);

	}
	var xmlhttp;
	if (window.XMLHttpRequest) { // code for IE7+, Firefox, Chrome, Opera, Safari
		xmlhttp = new XMLHttpRequest();

	} else { // code for IE6, IE5
		xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
	}
	xmlhttp.open(method, url, false);
	xmlhttp.send(form);
	return xmlhttp;
}



var yibu_request = function(arr, url, method, callback) {
	var form = new FormData();
	for (var x in arr) {
		form.append(arr[x].id, arr[x].value);
	}
	var xmlhttp;
	if (window.XMLHttpRequest) { // code for IE7+, Firefox, Chrome, Opera, Safari
		xmlhttp = new XMLHttpRequest();
	} else { // code for IE6, IE5
		xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
	}

	xmlhttp.open(method, url, true);
	xmlhttp.onreadystatechange = function() {
	//	if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
			callback(xmlhttp);
		//}
	}
	xmlhttp.send(form);
}

var GetMachineid = function(account, url, method) {
	var form = new FormData();
	form.append('account', account);
	var xmlhttp;
	if (window.XMLHttpRequest) { // code for IE7+, Firefox, Chrome, Opera, Safari
		xmlhttp = new XMLHttpRequest();

	} else { // code for IE6, IE5
		xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
	}
	xmlhttp.open(method, url, false);
	xmlhttp.send(form);
	return xmlhttp.responseText;
}

		function get_zhongfei(zhongfei, start, end) {
				var str = '';
				if (zhongfei.length == 8) {
					var fei = zhongfei.substring(start, end);
					if (fei == '00') {
						str = '正常';
					}
					if (fei == '01') {
						str = '镜片脏';
					}
					if (fei == '10') {
						str = '缺肥';
					}
					if (fei == '11') {
						str = '堵肥'
					}
				}
				return str;
			}