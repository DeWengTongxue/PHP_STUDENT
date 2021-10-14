<!doctype html>
<html  class="x-admin-sm">
<head>
	<meta charset="UTF-8">
	<title>登入</title>
	<meta name="renderer" content="webkit|ie-comp|ie-stand">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <!-- 引入lyaui.css框架 -->
	<link rel="stylesheet" type="text/css" href="layui/css/layui.css"/>
    <!-- 引入login.css-->
	<link rel="stylesheet" type="text/css" href="css/login.css"/>
</head>
<body class="login-bg">
    <div class="login layui-anim layui-anim-up" >
        <div class="message">学生信息管理系统</div>
        <div id="darkbannerwrap"></div>
        <form method="post" class="layui-form" >
            <input name="user" id="user" placeholder="账号" type="text" lay-verify="required" class="layui-input" autocomplete="off">
            <hr class="hr15">
            <input name="pwd" id="pwd" lay-verify="required" placeholder="密码" type="password" class="layui-input">
            <hr class="hr15">
            <input name="captcha" id="captcha" type="text" lay-verify="required" placeholder="验证码" maxlength='4' class="layui-input">
            <img src="php/captcha.php" id="captcha_img" class="captcha_img" onclick="this.src='./php/captcha.php?'+ Math.random()"/>
            <hr class="hr15">
			<select name="user" lay-verify="required" id="identity">
			    <option value=""></option>
			    <option value="0">普通用户</option>
			    <option value="1">管理员</option>
			</select>
			<hr class="hr15">
            <input value="登录" id="login_submit" lay-submit lay-filter="login" style="width:100%;" type="button">
		</form>
		<p style="text-align: center; margin-top: 10px;" id="change" >没有账号？点击注册</p>
    </div>
	
	
	<!-- 引入layui.js框架 -->
	<script src="layui/layui.js"></script>
    <!-- 引入login.js -->
    <script src="js/login.js"></script>
</body>
</html>