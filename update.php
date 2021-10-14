<?php
	//开启SESSION
	session_start();
	//判断用户是否登入
	if(empty($_SESSION['name'])){
		header("refresh:0.1,url=./login.php");
		die();
	}
	//连接数据库
	include 'php/conn.php';
	//获取前端传来的参数
	$id  = $_GET['id'];
	$_SESSION['id'] = $id;
	//SQL语句  查询
	$sql = 'select * from stuinfo where id='.$id.'';
	//执行SQL语句
	$result = mysqli_query($link,$sql);
	//查询结果
	$arr = mysqli_fetch_assoc($result);
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<title>修改信息</title>
	<link rel="stylesheet" type="text/css" href="layui/css/layui.css"/>
	<style>
		.layui-form-radio>i:hover, .layui-form-radioed>i {
			color: #1E9FFF;
		}
		.layui-btn {
			background-color: #1E9FFF;
		}
	</style>
</head>
<body>
	<form class="layui-form" action="" style="width: 500px;margin-top: 30px;">
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
  	
  	<!-- 引入layui.js框架 -->
  	<script src="layui/layui.js"></script>
	<!-- 引入verification.js -->
  	<script src="js/verification.js"></script>
	<!-- 引入update.js -->
  	<script src="js/update.js"></script>
</body>
</html>
