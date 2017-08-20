var dtask = null;

function createDownloadTask(url, tip, cb1) {
	if (dtask) {
		outLine("下载任务已创建！");
		return;
	}
	var options = {
		method: "GET"
	};
	dtask = plus.downloader.createDownload(url, options);
	dtask.addEventListener("statechanged", function(task, status) {
		if (!dtask) {
			return;
		}

		switch (task.state) {
			case 1: // 开始

				break;
			case 2: // 已连接到服务器
				//	outLine( "链接到服务器..." );
				break;
			case 3: // 已接收到数据
				//outSet( "下载数据更新:" );
				tip.innerHTML = task.downloadedSize + "/" + task.totalSize;
				//outLine( task.downloadedSize+"/"+task.totalSize );
				if (task.downloadedSize == task.totalSize) {

					tip.innerHTML = '已下载';
					cb1.style.display = 'none';
					tip.style.color='green';
				}
				break;
			case 4: // 下载完成
				cb1.parentElement.onclick = function() {
                    plus.storage.setItem('zuoyehao',this.id)
					var w = plus.webview.create('Phone_RecordShow.html');
					w.show();
				}
				break;
		}
	});
	// outSet( "创建下载任务成功！" );
}

function startDownloadTask() {
	if (!dtask) {
		//	outSet( "请先创建下载任务！" );
		return;
	}

	dtask.start();
}
// 暂停下载任务
function pauseDownloadTask() {
	dtask.pause();
	// outSet( "暂停下载！" );
}
// 恢复下载任务
function resumeDownloadTask() {
	dtask.resume();

	//outSet( "恢复下载！" );
}

function cancelDownloadTask() {
	dtask.abort();
	dtask = null;
	//outSet( "取消下载任务！" );
}

function clearDownloadTask() {

}

function startAll() {
	
	document.getElementById('btx').style.display = 'block';
	document.getElementById('n1').style.display = 'none';
	plus.downloader.startAll();
}