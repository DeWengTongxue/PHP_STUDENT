layui.use(['form', 'layer','laydate'], function () {
    var form = layui.form;
    var $ = layui.$,
        layer = layui.layer,
		laydate = layui.laydate;
    //监听提交
    form.on('submit(formDemo)', function (data) {
        return false;
    });
    //提交
    $("#submit").click(function () {
        if ($("#name").val() == '' || $("#name").val() == null) {
            //alert("姓名不能为空");
        } else if ($("#age").val() == '' || $("#age").val() == null) {
            //alert("年龄不能为空"); 
        } else if ($("#phone").val() == '' || $("#phone").val() == null) {
            //alert("年龄不能为空");
        } else if ($("#name").val().length > 6 || $("#name").val().length < 2) {
            layer.msg('姓名格式不对', {
                icon: 5
            });
        } else if (!(myIsNaN($("#age").val())) || parseInt($("#age").val()) >= 60) {
            layer.msg('年龄格式不对', {
                icon: 5
            });
        } else if (!myPhone($("#phone").val())) {
            layer.msg('手机号码格式不对', {
                icon: 5
            });
        } else {
            //执行加载动画
            layer.msg('加载中', {
                icon: 16,
                shade: 0.01
            });
            //Ajax提交
            $.ajax({
                url: 'php/update.php',
                type: 'POST',
                datatype: 'text',
                data: {
                    name: $("#name").val(),
                    sex: getRadioVal('sex'),
                    age: $("#age").val(),
                    phone: $("#phone").val(),
					birthday: $("#date").val()
                },
                error: function (result) {
                    console.log(result);
                },
                success: function (result) {
                    if (result == '0') {
                        layer.msg('修改失败', {
                            icon: 5
                        });
                    } else if (result == '1') {
                        layer.msg('修改成功', {
                            icon: 6
                        });
                        setInterval(function () {
                            window.top.location = window.top.location.href;
                        }, 1000);
                    } else {
                        layer.msg('修改失败,未知错误', {
                            icon: 5
                        });
                    }
                }
            });
        }
    });
	laydate.render({
	  elem: '#date' //指定元素
	});
});