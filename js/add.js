layui.use(['form', 'layer'], function () {
	var form = layui.form;
	var $ = layui.$,
		layer = layui.layer;
	//监听提交
	form.on('submit(formDemo)', function (data) {
		return false;
	});
	//提交
	$("#submit").click(function () {
		if ($("#name").val() == '' || $("#name").val() == null) {
			//alert("姓名不能为空")
		} else if ($("#age").val() == '' || $("#age").val() == null) {
			//alert("年龄不能为空");
		} else if ($("#phone").val() == '' || $("#phone").val() == null) {
			//alert("手机号码不能为空");
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
		} else if (getRadioVal('sex') !== '男' && getRadioVal('sex') !== '女') {
			layer.msg('性别格式不对', {
				icon: 5
			});
		} else if ($("#date").val().length < 8 ) {
			layer.msg('生日格式不对', {
				icon: 5
			});
		} else {
			layer.msg('加载中', {
				icon: 16,
				shade: 0.01
			});
			// console.log($("#name").val());
			// console.log(getRadioVal('sex'));
			// console.log($("#age").val());
			// console.log( $("#phone").val());
			// console.log( $("#date").val());
			$.ajax({
				url: 'php/add.php',
				type: 'POST',
				datatype: 'text',
				data: {
					name: $("#name").val(),
					sex: getRadioVal('sex'),
					age: $("#age").val(),
					phone: $("#phone").val(),
					birthday : $("#date").val()
				},
				error: function (result) {
					console.log(result);
				},
				success: function (result) {
					if (result == '0') {
						layer.msg('添加失败', {
							icon: 5
						});
					} else if (result == '1') {
						layer.msg('添加成功', {
							icon: 6
						});
						setInterval(function () {
							window.top.location = 'index.php';
						}, 1000);
					}else if(result == '2'){
						layer.msg('添加成功',{
							icon:6
						});
						setInterval(function(){
							window.top.location = 'login.php';
						},1000);
					}
				}
			});
		}
	});
});