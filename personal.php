<?php
		session_start();
		//连接数据库
		include './php/conn.php';
		$user = $_SESSION['name'];
		$sql = 'select * from stuinfo where student_id = (select id from admin where user="'.$user.'")';
		$result = mysqli_query($link,$sql);
		if($result){
			$arr = mysqli_fetch_array($result);
		}
		if(is_null($arr)){
			$bool = true;
		}
?>
<!doctype html>
<html  class="x-admin-sm">
<head>
	<meta charset="UTF-8">
	<title>个人信息</title>
	<meta name="renderer" content="webkit|ie-comp|ie-stand">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <!-- 引入lyaui.css框架 -->
	<link rel="stylesheet" type="text/css" href="layui/css/layui.css"/>
    <!-- 引入login.css-->
	<link rel="stylesheet" type="text/css" href="css/login.css"/>
	<script src="layui/layui.js"></script>
	<!-- 引入login.js -->
	<script src="js/login.js"></script>
	<!-- 引入update.js -->
	<script src="js/update.js"></script>
	<!-- 引入verification.js -->
	<script src="js/verification.js"></script>
	<style type="text/css">
		.message{
			width: 780px;
			height: 500px;
			margin: 10px auto;
		}
	</style>
</head>
<body>
	<div class="message">
		<div style="margin: 0 280px 0 280px ;">
			<caption style="text-align:center;">
				<h2>学生信息管理平台</h2>欢迎您,&nbsp;&nbsp;&nbsp;<strong style="color: #0000FF;"><?php echo $_SESSION['name'];?></strong>&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;<a href="javascript:;" class="logout">退出登入</a>
			</caption>
		</div>
			
		<form class="layui-form" action="" style="width: 500px;margin-top: 30px;padding-left: 50px;">
			<div class="layui-form-item">
				<label class="layui-form-label">姓名</label>
				<div class="layui-input-block">
		  			<input type="text" id="name" value="<?php echo $arr['name'];?>" name="name" required  lay-verify="required" placeholder="请输入姓名" autocomplete="off" class="layui-input" disabled>
				</div>
			</div>
			<div class="layui-form-item">
				<label class="layui-form-label">性别</label>
				<div class="layui-input-block">
		      		<input type="radio" name="sex" value="男" title="男" <?php if($arr['sex'] == '男'){echo 'checked';} ?>>
		      		<input type="radio" name="sex" value="女" title="女" <?php if($arr['sex'] == '女'){echo 'checked';} ?>>
				</div>
			</div>
			<div class="layui-form-item">
				<label class="layui-form-label">年龄</label>
				<div class="layui-input-block">
		  			<input type="text" id="age" value="<?php echo $arr['age'];?>" name="age" required  lay-verify="required" placeholder="请输入年龄" autocomplete="off" class="layui-input">
				</div>
			</div>
			<div class="layui-form-item">
				<label class="layui-form-label">手机号码</label>
				<div class="layui-input-block">
		  			<input type="text" id="phone" value="<?php echo $arr['phone_number'];?>" name="number" required  lay-verify="required" placeholder="请输入手机号码" autocomplete="off" class="layui-input">
				</div>
			</div>
			<div class="layui-form-item">
				<label class="layui-form-label">生日</label>
				<div class="layui-input-block">
					 <input type="text" name="date" id="date" lay-verify="date"  autocomplete="off" class="layui-input" placeholder="选择日期" value=<?php echo $arr['birthday']; ?> >
				</div>
			</div>
			<div class="layui-form-item">
				<div class="layui-input-block">
		  			<button class="layui-btn" lay-submit lay-filter="formDemo" id="submit">立即修改</button>
				</div>
			</div>
		</form>
	</div>
	<!-- 引入layui.js框架 -->
	<script src="layui/layui.js"></script>
	<!-- 引入login.js -->
	<script src="js/login.js"></script>
	<!-- 引入update.js -->
	<script src="js/update.js"></script>
	<!-- 引入verification.js -->
	<script src="js/verification.js"></script>
	<script>
		layui.use(['table', 'util','form','laydate'], function(){
		  var table = layui.table,util = layui.util,form = layui.form,laydate = layui.laydate;
		  var $ = layui.$;
		  $(".logout").on("click", function () {
		  	layer.open({
		  		type: 1,
		  		title: '温馨提示',
		  		skin: 'layui-layer-demo', //样式类名
		  		closeBtn: 0, //不显示关闭按钮
		  		anim: 1,
		  		shadeClose: true, //开启遮罩关闭
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
		  }); 
		<?php
			 if(@$bool){
			  echo 'function fun() {
			   layer.open({
				type: 1,
				title: "温馨提示",
				skin: "layui-layer-demo", 
				closeBtn: 0, 
				anim: 1,
				shade : 1,
				shadeClose: true,
				content: "<p class=\"tips\">查无此人，请重新登录<span id=\"time\">5</span>秒后自动跳转，立即<a href=\"php\/logout.php\">跳转</a></p>"
			   });
			   var time = 5;
			   var timer = setInterval(function () {
				if (time != 0) {
				 time--;
				} else {
				 clearInterval(timer);
				 document.location.href = "php\/logout.php";
				}
				$("#time").text(time);
			   }, 1000);
			  }';
			//如果查询不到信息，就直接跳转回登录页面
			echo "fun();";
			 }
		?>
		 
		laydate.render({
		    elem: '#date' //指定元素
		  });
		});
	</script>
</body>
</html>