function show(title,url,w,h,full=false){
    if (title == null || title == '') {
        title=false;
    };
    if (url == null || url == '') {
        url="404.html";
    };
    if (w == null || w == '') {
        w=(window.innerWidth*0.5);
    };
    if (h == null || h == '') {
        h=(window.innerHeight - 250);
    };
    layui.use("layer",function(){
		//（若想要加载多个组件，如：时间，表单可用[]  layui.use(['layer','laydate','form'],function(){})）
		var layer = layui.layer;  //layer初始化
	    var index = layer.open({
	        type: 2,
	        area: [w+'px', h +'px'],
	        fix: false, //不固定
	        maxmin: true,
	        shadeClose: true,
	        shade:0.4,
	        title: title,
	        content: url,
	        success: function(){
	          //窗口加载成功刷新frame
	          // location.replace(location.href);
	        },
	        cancel:function(){
	          //关闭窗口之后刷新frame
//	           location.replace(location.href);
	        },
	        end:function(){
	          //窗口销毁之后刷新frame
//	           location.replace(location.href);
	        }
	    });
   	});
    if(full){
       layer.full(index); 
    }
}