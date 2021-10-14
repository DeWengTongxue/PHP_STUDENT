layui.use(['layer', 'form'], function () {
	var $ = layui.$,
		layer = layui.layer,
		form = layui.form;


	//给登出绑定点击事件
	$(".logout").on("click", function () {
		layer.open({
			type: 1,
			title: '温馨提示',
			skin: 'layui-layer-demo', //样式类名
			closeBtn: 0, //不显示关闭按钮
			anim: 1,
			//shadeClose: true, //开启遮罩关闭
			content: '<p class="tips">退出成功，<span id="time">5</span>秒后自动跳转，立即<a href="php/logout.php">跳转</a></p>'
		});
		var time = 5;
		var timer = setInterval(function () {
			if (time != 0) {
				time--;
			} else {
				clearInterval(timer);
				document.location.href = 'php/logout.php';
			}
			$("#time").text(time);
		}, 1000);
	})


	//给下载按钮绑定点击事件
	$(".download").on("click", function () {
		//定义全局变量接收excel文件名
		window.name = $("table h2").text();
		layer.msg('下载中...', {
			icon: 7
		});
		//执行excel处理函数
		tableToExcel();
		layer.msg('下载成功', {
			icon: 1
		});
	});


	//分页
	//给分页设置宽度，目的是为了居中
	$("#page").width($(".pagination").width() + 1);
	//当在第一页时不能再点击前一页
	if ($(".pagination a").eq(1).hasClass("active")) {
		$(".pagination li:first a").css({
			"pointer-events": "none",
			"cursor": "no-drop",
		});
		console.log("当前是第一页")
	}
	$(".pagination a").on("click", function () {
		$(this).addClass("active").parent().siblings().children().removeClass("active");
	});


	//多个删除
	//给删除按钮绑定点击事件
	$(".many_del").on("click", function () {
		//判断数组是否有数据，将数组中的id删除
		if (arr.length != 0) {
			//询问是否删除
			layer.confirm('确认删除?', {
				icon: 3,
				title: '提示'
			}, function (index) {
				//执行加载动画
				layer.msg('处理中', {
					icon: 16,
					shade: 0.01
				});
				//Ajax提交
				$.ajax({
					url: 'php/many_del.php?ids=' + arr,
					type: 'GET',
					datatype: 'text',
					error: function (result) {
						layer.msg(result, {
							icon: 5
						});
					},
					success: function (result) {
						if (result == '0') {
							layer.msg('删除失败', {
								icon: 5
							});
						} else if (result == '1') {
							layer.msg('已删除' + arr.length + '条', {
								icon: 1
							});
							setInterval(function () {
								window.location.href = window.top.location.href;
							}, 1000);
						} else {
							layer.msg('未知错误', {
								icon: 5
							});
						}
					}
				});
			});
		} else {
			//未选择数据
			layer.msg('请先选择数据', {
				icon: 2
			});
		}

	});

	//向Array原型对象添加remove方法
	Array.prototype.remove = function (val) {
		//indexOf() 方法可返回某个指定的字符串值在字符串中首次出现的位置。
		var index = this.indexOf(val);
		if (index > -1) {
			this.splice(index, 1);
		}
	};

	//定义空数组，存放勾选数据
	var arr = [];
	//给复选框绑定点击事件
	$(".checkbox").siblings("div").on("click", function () {
		//获取勾选状态
		var flag = $(this).hasClass("layui-form-checked"),
			//获取每条数据在数据库中对应的ID
			id = $(this).parents("td").siblings(".id").text();
		if (flag) {
			//将选中的数据添加到数组		
			arr.push(id);
		} else {
			arr.remove(id);
		}
	});


	//单个删除
	//给每条数据的删除绑定点击事件
	$(".single_del").click(function () {
		//获取每条数据在数据库中对应的ID
		var id = $(this).parent().siblings(".id").text();
		//询问是否删除
		layer.confirm('确认删除?', {
			icon: 3,
			title: '提示'
		}, function (index) {
			//执行加载动画
			layer.msg('加载中', {
				icon: 16,
				shade: 0.01
			});
			//Ajax提交
			$.ajax({
				url: 'php/del.php?id=' + id + '',
				type: 'POST',
				datatype: 'text',
				error: function (result) {
					layer.msg(result, {
						icon: 5
					});
				},
				success: function (result) {
					if (result == '1') {
						layer.msg('删除失败', {
							icon: 5
						});
					} else if (result == '2') {
						layer.msg('删除成功', {
							icon: 6
						});
						//1秒后刷新
						setInterval(function () {
							window.location.replace("./");
						}, 1000);
					}
				}
			});
		});
	});
});


//table转化excel处理函数
var tableToExcel = (function () {
	var uri = 'data:application/vnd.ms-excel;base64,',
		template = '<html xmlns:o="urn:schemas-microsoft-com:office:office" xmlns:x="urn:schemas-microsoft-com:office:excel" xmlns="http://www.w3.org/TR/REC-html40"><head><meta charset="UTF-8"><!--[if gte mso 9]><xml><x:ExcelWorkbook><x:ExcelWorksheets><x:ExcelWorksheet><x:Name>{worksheet}</x:Name><x:WorksheetOptions><x:DisplayGridlines/></x:WorksheetOptions></x:ExcelWorksheet></x:ExcelWorksheets></x:ExcelWorkbook></xml><![endif]--></head><body><table>{table}</table></body></html>',
		base64 = function (s) {
			return window.btoa(unescape(encodeURIComponent(s)))
		},
		format = function (s, c) {
			return s.replace(/{(\w+)}/g, function (m, p) {
				return c[p];
			})
		}
	return function () {
		//根据ID获取table表格HTML
		var table = document.getElementById("tableExcel");
		var ctx = {
			worksheet: 'Worksheet',
			table: table.innerHTML
		};
		//获取a标签导出按钮
		document.getElementById("export").href = uri + base64(format(template, ctx));
		document.getElementById("export").download = window.name + '.xls';
	}
})();