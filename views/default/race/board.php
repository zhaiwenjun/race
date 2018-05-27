<!DOCTYPE html>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no" />
		<title>思途云抢答后台系统</title>
        <link type="text/css" href="/plugins/race/public/css/my.css" rel="stylesheet" />
        {Common::js('jquery.min.js')}
		<link rel="stylesheet" href="https://cdn.bootcss.com/pure/1.0.0/pure-min.css">

	</head>
	<body>
		<h1 class="text-c">思途云抢答</h1>
		<div id="showResult" class="palette palette-river text-c">请创建新抢答</div>
		<div class="pure-form">
			<center>
			<h3>新建抢答</h3>
			<fieldset>
                <div class="mt-5">
				等待时间(秒)<input type="text" id="Delay" value="3" class="ml-5" />
                </div>
                <div class="mt-10">

				进行时间(秒)<input type="text" id="TimeOut" value="60" class="ml-5"/>
                </div>
				<br />
				<button id="btn-start" class="pure-button pure-button-primary pure-input-1-1">开始</button>
			</fieldset>
			</center>
		</div>
		<br>
        <p class="c-333 text-c">Copyright 2018&nbsp;<a href="http://www.stourweb.com" target="_blank">思途智旅</a></p>

        <script src="/plugins/race/public/js/board.js"></script>
        <script src="/res/js/layer/layer.js"></script>
	</body>
</html>

