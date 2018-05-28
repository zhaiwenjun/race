$(function(){

    $("#name").val(window.localStorage.getItem('qd-name'));
    //抢答开始
    $("#btn-qd").click(function(){

        var name=$("#name").val();
        if(name == ''){
            layer.open({
                content: '请输入你的姓名'
                ,skin: 'msg'
                ,time: 2 //2秒后自动关闭
            });
            return false;
        }
        $(this).html("正在发送请求");

        window.localStorage.setItem('qd-name',name);
        $.ajax(
            {
                type: 'POST',
                url: '/phone/race/index/ajax_race',
                data: {
                    'name': name

                },
                dataType: 'json',
                success: function(data){
                    if(data.status==1){

                        layer.open({
                            content: '抢答成功！'
                            ,skin: 'msg'
                            ,time: 2 //2秒后自动关闭
                        });
                    }
                    else {
                        layer.open({
                            content: data.msg
                            ,skin: 'msg'
                            ,time: 1 //2秒后自动关闭
                        });
                    }
                    $("#btn-qd").html("抢答");
                },

                error: function(){
                    layer.open({
                        content: '请求异常'
                        ,skin: 'msg'
                        ,time: 1 //2秒后自动关闭
                    });
                    $("#btn-qd").html("抢答");
                }
            }
        );
    });
})

//ping 测试
function pingtest() {
	var sttime = new Date().getTime();
	$.ajax(
		{
			type: 'GET',
			timeout : 3000,
			//url: '/race/index/ajax_ping',
			url:'/plugins/race/data/ping.json',
			data: {
				't': sttime
			},
			success: function(data) {
				var curtime = new Date().getTime();
				var pingtime = curtime - sttime;
				$("#ping").html("Ping:" + pingtime  + "ms");
			},
			dataType: 'json',
			error: function(a,b,c) {
				$("#ping").html("请检查网络连接");
			}
		}
	);
}
setTimeout("pingtest()",1000);
setInterval("pingtest()",5000);
