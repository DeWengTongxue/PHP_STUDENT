layui.use(['layer','form'], function(){
    var $ = layui.$, //jQuery
    layer = layui.layer,
    form = layui.form;
  //监听提交
    form.on('submit(login)', function(data){
      return false; //阻止提交
      random($("#captcha_img")); 
    });
  
  //绑定点击事件
    $("#login_submit").on("click",function(){
        var user = $("#user").val();
        var pwd = $("#pwd").val();
        var captcha = $("#captcha").val();
		var administrator = $("#identity").val();
		console.log(administrator);
		if($("#login_submit").val() == "注册"){
			$.ajax({
			    url: "php/add.php", //提交地址（url）
				//提交的数据
			    type: "post",
			    dataType: "text",
				data: {
					name:null,
				    userid: user,
				    password: pwd,
				    captcha: captcha,
					administrator: administrator
				},
			    success: function(result) {
			        //接收后台的返回值进行判断
			        if (result == "1") {
			            layer.msg('注册成功', {icon: 6});
			            setInterval(function(){
			                window.location.href = "../stuinfo/add.php";
			            },2000);   
			        } else if (result == "0") {
			            layer.msg('注册失败', {icon: 5});
			        } else {
			            layer.msg('不知错误', {icon: 5});
			        }
			    },
			    error: function() {
					console.log(result);
			        layer.msg('数据请求失败', {icon: 5});
			    }
			});
		}else{
			if(user == '' || user == null){
			  layer.msg('账号不能为空', {icon: 5});
			  random($("#captcha_img")); 
			}else if(pwd == '' || pwd == null){
			  layer.msg('密码不能为空', {icon: 5});
			  random($("#captcha_img")); 
			}else if(administrator == "" || administrator == null){
				layer.msg('身份不能为空', {icon: 5});
				random($("#captcha_img")); 
			}else{
			  //使用Ajax提交
			    $.ajax({
			      url: "php/login.php", //提交地址（url）
				  //提交的数据
			      data: {
			          name: user,
			          password: pwd,
			          captcha:captcha,
					  administrator:administrator
			      },
			      type: "post",
			      dataType: "text",
			      success: function(data) {
			          //接收后台的返回值进行判断
			          if (data == "4") {
			              layer.msg('登录成功', {icon: 6});
			              setInterval(function(){
			                  window.location.href = "./";
			              },2000);   
			          }else if(data == "3"){
						  layer.msg('登录成功', {icon: 6});
						  setInterval(function(){
						      window.location.href = "./personal.php";
						  },2000); 
					  } else if (data == "0") {
			              layer.msg('用户不存在', {icon: 5});
			          } else if (data == '6'){
						  $("#captcha_img").attr("src","php/captcha.php");
						  $("#captcha").val("");
			              layer.msg('验证码错误', {icon: 5});
			          } else if (data == "5") {
			              layer.msg('密码错误', {icon: 5});
			          }else if(data == '7'){
						  layer.msg('身份选择错误', {icon: 5});
					  } else {
			              layer.msg('未知错误', {icon: 5});
			          }
			      },
			      error: function() {
			          layer.msg('数据请求失败', {icon: 5});
			      }
			  });
			}
		}
        
	}); 
	$("#change").on("click",function(){
		$(".login").addClass("flip");
		
		setTimeout(function(){
		$(".login").removeClass("flip");
		$(".login").removeClass("layui-anim-up");
		},1000)
		
		if($("#login_submit").val() == "注册"){
			$("#login_submit").val("登录");
			$("#captcha_img").attr("src","php/captcha.php");
			$("#captcha").val("");
		}else{
			$("#login_submit").val("注册");
			$("#change").text("已有账号？点击登录")
			$("#captcha_img").attr("src","php/captcha.php");
			$("#captcha").val("");
		}
	})
	
  
});