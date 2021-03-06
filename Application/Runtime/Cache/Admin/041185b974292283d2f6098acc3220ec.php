<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
    <title>知妍文化传播</title>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="renderer" content="webkit">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
</head>

<link rel="stylesheet" href="/zhiyan/business_admin/Public/static/css/login/bootstrap.min.css" />
<link rel="stylesheet" href="/zhiyan/business_admin/Public/static/css/login/bootstrap-responsive.min.css" />
<link rel="stylesheet" href="/zhiyan/business_admin/Public/static/css/login/unicorn.login.css" />
<link rel="stylesheet"  href="/zhiyan/business_admin/Public/static/h-ui/css/H-ui.min.css" />
<link rel="stylesheet"  href="/zhiyan/business_admin/Public/static/h-ui/css/H-ui.admin.css" />
<link rel="stylesheet"  href="/zhiyan/business_admin/Public/static/h-ui/skin/default/skin.css" id="skin" />
<link rel="stylesheet"  href="/zhiyan/business_admin/Public/static/h-ui/css/style.css" />
<link rel="stylesheet"  href="/zhiyan/business_admin/Public/lib/Hui-iconfont/1.0.7/iconfont.css" />
<link rel="stylesheet"  href="/zhiyan/business_admin/Public/lib/icheck/icheck.css" />

<body>
    <div id="logo">
        <h2 style="color:#FFFFFF">知妍文化传播</h2>
    </div>
    <div id="loginbox" style="height:310px;">
        <form class="form form-vertical" id="form_btn" method="post">
            <p style="text-align:left;margin-left:54px;">管理员登录</p>
            <!-- text -->
            <div class="control-group">
                <div class="controls">
                    <div class="input-prepend">
                        <span class="add-on"><i class="icon-user"></i></span>
                        <input type="text" id="admin_name" name="admin_name" placeholder="用户名" />
                    </div>
                </div>
            </div>
            <!-- password -->
            <div class="control-group">
                <div class="controls">
                    <div class="input-prepend">
                        <span class="add-on"><i class="icon-lock"></i></span>
                        <input type="password" name="admin_pass" placeholder="密码" />
                    </div>
                </div>
            </div>
            <!-- text -->
            <div class="control-group">
                <div class="controls">
                    <div class="input-prepend">
                        <span class="add-on"><i class="icon-lock"></i></span>
                        <input type="text" name="admin_code" placeholder="验证码" />
                    </div>
                </div>
            </div>
            <!-- image -->
            <div class="control-group">
                <div class="controls">
                <img name="pic" id="code" src="<?php echo U('Index/verify');?>" style="cursor:pointer" />
                <a href="javascript:code();" style="text-decoration:none;">换一张</a>
                </div>
            </div>
            <!-- button -->
            <div class="form-actions">
                <span class="pull-right">
                <input type="button" class="btn btn-success" value="登录" />
                </span>
            </div>
        </form>
    </div>
</body>
</html>

<script src="/zhiyan/business_admin/Public/lib/jquery/1.9.1/jquery.min.js"></script> 
<script src="/zhiyan/business_admin/Public/lib/jquery.form/jquery.form.js"></script> 
<script src="/zhiyan/business_admin/Public/lib/layer/2.1/layer.js"></script> 
<script src="/zhiyan/business_admin/Public/lib/icheck/jquery.icheck.min.js"></script> 

<script>
/*
*  获取焦点
*  xiami  
*  2018-03-27
*/
$("#admin_name").focus();
 
/*
*  刷新验证码
*  xiami  
*  2018-03-27
*/
var img = document.getElementsByName('pic')[0];
img.onclick = function(){
  this.src = '<?php echo U('verify','','');?>/'+Math.random();
}

/*
*  刷新验证码
*  xiami  
*  2018-03-27
*/
function code(){
  $("#code").attr("src","/zhiyan/business_admin/index.php?s=/Admin/Index/verify.html/&t="+Math.random());
}

/*
*  执行登录
*  xiami  
*  2018-03-27
*/
var is_submit = 0;
$(".btn-success").on("click", function(){
    if(is_submit == 1) return;
    is_submit = 1;
    $("#form_btn").ajaxSubmit({
        url: "/zhiyan/business_admin/index.php?s=/Admin/Index/login_save.html",
        type: "POST",
        dataType: "json",
        error: function(){
            layer.alert("服务器超时，请稍后再试",{icon:2,time:1000});
            is_submit=0;
        },
        success: function(data){
          if(data.ok == 200){
              layer.alert(data.info,{icon:1,time:1000});
              setInterval(function(){ location.href='/zhiyan/business_admin/index.php?s=/Admin/Index/index.html'; },1000);
          }else{
              layer.alert(data.info,{icon:2,time:1000});
          }
          is_submit = 0;
        }
    })
})
</script>