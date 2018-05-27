var QiangdaRunning = false;

$("#btn-start").click(function() {
	$("#Delay").val(Number($("#Delay").val()));
	$("#TimeOut").val(Number($("#TimeOut").val()));


	var delay = Number($("#Delay").val());
	var timeout = Number($("#TimeOut").val());
	if(delay<0 || timeout <0){
		return false;
	}
    $("#btn-start").html("正在发送请求");
	$.ajax({
		type: 'POST',
		url: '/race/admin/ajax_new_qd',
		data: {
			'delay': delay,
			'timeout': timeout
		},
		success: function(data) {
			if(data.status == 1) {
				$("#btn-start").attr("disabled",true);
				for (var i=0;i<delay;i++) {
					var toshow = delay - i;
					setTimeout("$(\"#showResult\").html(\"" + toshow + "\")",1000*i);
				}
				setTimeout("$(\"#showResult\").html(\"开始抢答！\")",1000*delay);
				//setTimeout("$(\"#btn-start\").attr(\"disabled\",false)",1000*delay);
				QiangdaRunning = false;
				setTimeout("QiangdaRunning = true;",1000*delay+500);
			}
			else {
				alert(data.msg);
			}
			$("#btn-start").html("开始");
		},
		dataType: 'json',
		error: function() {
			layer.alert('请求异常，请检查网络连接。');
			$("#but0").html("开始");
		}
	});
});
function getresult() {
	if (QiangdaRunning) {
		$.ajax({
			type: 'GET',
			url: '/race/admin/ajax_result',
			timeout : 3000,
			dataType: 'json',
			success: function(data) {
				if (data.status == 1) {
					$("#showResult").html(data.html);
					if (data.html == "") $("#showResult").html("开始抢答！");
				}
				else {
					$("#showResult").html(data.html);
                    $("#btn-start").attr("disabled",false);

                    layer.alert('抢答结束！');

					QiangdaRunning = false;

				}
			},
			error: function() {
				$("#showResult").html("请求异常，请检查网络连接！");
			}
		});
	}
	setTimeout("getresult()",500);
}
getresult();
