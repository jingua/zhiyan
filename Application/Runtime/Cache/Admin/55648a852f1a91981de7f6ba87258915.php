<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE HTML>
<html>
<head>
<meta charset="utf-8">
<meta name="renderer" content="webkit|ie-comp|ie-stand">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="viewport" 
content="width=device-width,initial-scale=1,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no" />
<meta http-equiv="Cache-Control" content="no-siteapp" />
<LINK rel="Bookmark" href="/favicon.ico" >
<LINK rel="Shortcut Icon" href="/favicon.ico" />
<link rel="stylesheet" href="/zhiyan/business_admin/Public/static/h-ui/css/H-ui.min.css" />
<link rel="stylesheet" href="/zhiyan/business_admin/Public/static/h-ui/css/H-ui.admin.css" />
<link rel="stylesheet" href="/zhiyan/business_admin/Public/lib/Hui-iconfont/1.0.7/iconfont.css" />
<link rel="stylesheet" href="/zhiyan/business_admin/Public/lib/icheck/icheck.css" />
<link rel="stylesheet" href="/zhiyan/business_admin/Public/static/h-ui/skin/default/skin.css" id="skin" />
<link rel="stylesheet" href="/zhiyan/business_admin/Public/static/h-ui/css/style.css" />
<title>知妍文化传播</title>
<meta name="keywords" content="">
<meta name="description" content="">
</head>
<body>
<!-- menu -->
<nav class="breadcrumb">
	<i class="Hui-iconfont">&#xe67f;</i> 首页 
	<span class="c-gray en">&gt;</span> 系统配置 
	<span class="c-gray en">&gt;</span> 基本配置 
	<a class="btn btn-success radius r" style="line-height:1.6em;margin-top:3px" 
	href="javascript:location.replace(location.href);" title="刷新" >
	<i class="Hui-iconfont">&#xe68f;</i></a>
</nav>
<!-- content -->
<div class="page-container">
	<form class="form form-horizontal" id="form-article-add">
		<!-- 系统设置内容 -->
		<div id="tab-system" class="HuiTab">
			<div class="tabBar cl">
				<span>基本设置</span>
			</div>
			<!--  -->
			<div class="row cl">
				<label class="form-label col-xs-4 col-sm-2">&nbsp;</label>
				<div class="formControls col-xs-8 col-sm-9">
					个人指标设置&nbsp;&nbsp;默认值从&nbsp; 0 &nbsp;开始与对应绩效奖励金额
				</div>
			</div>
			<!--  -->
			<div class="row cl">
				<label class="form-label col-xs-4 col-sm-2">指标开始刚到结束个数值</label>
				<div class="formControls col-xs-8 col-sm-9">
					<input type="text" id="left1" name="left1" placeholder="" value="<?php echo ($one["left"]); ?>" class="input-text" style="width:180px;">&nbsp;
					<input type="text" id="left1_money" name="left1_money" placeholder="请输入绩效金额" value="<?php echo ($one["left_money"]); ?>" class="input-text" style="width:180px;">&nbsp;
					<button class="btn btn-default radius" type="button" id="one1">&nbsp;&nbsp;确定设置指标&nbsp;&nbsp;</button>
				</div>
			</div>
			<!--  -->
			<div class="row cl">
				<label class="form-label col-xs-4 col-sm-2">指标开始刚到结束个数值</label>
				<div class="formControls col-xs-8 col-sm-9">
					<input type="text" id="middle1" name="middle1" placeholder="" value="<?php echo ($one["middle"]); ?>" class="input-text" style="width:180px;">&nbsp;
					<input type="text" id="middle1_money" name="middle1_money" placeholder="请输入绩效金额" value="<?php echo ($one["middle_money"]); ?>" class="input-text" style="width:180px;">&nbsp;
					<button class="btn btn-default radius" type="button" id="one2">&nbsp;&nbsp;确定设置指标&nbsp;&nbsp;</button>
				</div>
			</div>
			<!--  -->
			<div class="row cl">
				<label class="form-label col-xs-4 col-sm-2">指标开始刚到结束个数值</label>
				<div class="formControls col-xs-8 col-sm-9">
					<input type="text" id="right1" name="right1" placeholder="" value="<?php echo ($one["right"]); ?>" class="input-text" style="width:180px;">&nbsp;
					<input type="text" id="right1_money" name="right1_money" placeholder="请输入绩效金额" value="<?php echo ($one["right_money"]); ?>" class="input-text" style="width:180px;">&nbsp;
					<button class="btn btn-default radius" type="button" id="one3">&nbsp;&nbsp;确定设置指标&nbsp;&nbsp;</button>
				</div>
			</div>
			<!--  -->
			<div class="row cl">
				<label class="form-label col-xs-4 col-sm-2">&nbsp;</label>
				<div class="formControls col-xs-8 col-sm-9">
					绑定关系指标设置&nbsp;&nbsp;默认值从&nbsp; 0 &nbsp;开始与对应绩效奖励金额
				</div>
			</div>
			<!--  -->
			<div class="row cl">
				<label class="form-label col-xs-4 col-sm-2">指标开始刚到结束个数值</label>
				<div class="formControls col-xs-8 col-sm-9">
					<input type="text" id="left2" name="left2" placeholder="" 
					value="<?php echo ($two["left"]); ?>" class="input-text" style="width:180px;">&nbsp;
					<input type="text" id="left2_money" name="left2_money" placeholder="请输入绩效金额" 
					value="<?php echo ($two["left_money"]); ?>" class="input-text" style="width:180px;">&nbsp;
					<button class="btn btn-default radius" type="button" id="two1">&nbsp;&nbsp;确定设置指标&nbsp;&nbsp;</button>
				</div>
			</div>
			<!--  -->
			<div class="row cl">
				<label class="form-label col-xs-4 col-sm-2">指标开始刚到结束个数值</label>
				<div class="formControls col-xs-8 col-sm-9">
					<input type="text" id="middle2" name="middle2" placeholder="" 
					value="<?php echo ($two["middle"]); ?>" class="input-text" style="width:180px;">&nbsp;
					<input type="text" id="middle2_money" name="middle2_money" placeholder="请输入绩效金额" 
					value="<?php echo ($two["middle_money"]); ?>" class="input-text" style="width:180px;">&nbsp;
					<button class="btn btn-default radius" type="button" id="two2">&nbsp;&nbsp;确定设置指标&nbsp;&nbsp;</button>
				</div>
			</div>
			<!--  -->
			<div class="row cl">
				<label class="form-label col-xs-4 col-sm-2">指标开始刚到结束个数值</label>
				<div class="formControls col-xs-8 col-sm-9">
					<input type="text" id="right2" name="right2" placeholder="" 
					value="<?php echo ($two["right"]); ?>" class="input-text" style="width:180px;">&nbsp;
					<input type="text" id="right2_money" name="right2_money" placeholder="请输入绩效金额" 
					value="<?php echo ($two["right_money"]); ?>" class="input-text" style="width:180px;">&nbsp;
					<button class="btn btn-default radius" type="button" id="two3">&nbsp;&nbsp;确定设置指标&nbsp;&nbsp;</button>
				</div>
			</div>

      <!--  -->
      <div class="row cl">
        <label class="form-label col-xs-4 col-sm-2">助理指标个数</label>
        <div class="formControls col-xs-8 col-sm-9">
          <input type="text" id="left3" name="left3" placeholder="" 
          value="<?php echo ($c["left"]); ?>" class="input-text" style="width:368px;">&nbsp;
          <button class="btn btn-default radius" type="button" id="c3">&nbsp;&nbsp;确定设置指标&nbsp;&nbsp;</button>
        </div>
      </div>

		</div>
	</form>
</div>
<script src="/zhiyan/business_admin/Public/lib/jquery/1.9.1/jquery.min.js"></script> 
<script src="/zhiyan/business_admin/Public/lib/layer/2.1/layer.js"></script> 
<script src="/zhiyan/business_admin/Public/lib/icheck/jquery.icheck.min.js"></script> 
<script src="/zhiyan/business_admin/Public/lib/jquery.validation/1.14.0/jquery.validate.min.js"></script> 
<script src="/zhiyan/business_admin/Public/lib/jquery.validation/1.14.0/validate-methods.js"></script> 
<script src="/zhiyan/business_admin/Public/lib/jquery.validation/1.14.0/messages_zh.min.js"></script> 
<script src="/zhiyan/business_admin/Public/static/h-ui/js/H-ui.js"></script> 
<script src="/zhiyan/business_admin/Public/static/h-ui/js/H-ui.admin.js"></script> 
<script src="/zhiyan/business_admin/Public/lib/jquery.form/jquery.form.js"></script> 




<script src="/zhiyan/business_admin/Public/zhiyan/common/set.js"></script>
</body>
</html>
<script>

$("#one1").click(function(){
   var left = $("#left1").val();
   var money = $("#left1_money").val();
   layer.confirm('确认要设置指标个数吗 ？',function(index){
    $.ajax({
        type: "post",
        url: "<?php echo U('Log/set_one');?>",
        data: {"left":left,"left_money":money},
        dataType:"json",
        success:function(data){
            if(data==200){
                layer.alert(data.info,{time:1000});
                setInterval(function(){ location.href="<?php echo U('Log/set');?>"; },1000);
            }else{
                layer.alert(data.info,{time:1000});
                setInterval(function(){ location.href="<?php echo U('Log/set');?>"; },1000);
            }
        }
    })
  })
})

$("#one2").click(function(){
   var middle = $("#middle1").val();
   var money = $("#middle1_money").val();
   layer.confirm('确认要设置指标个数吗 ？',function(index){
    $.ajax({
        type: "post",
        url: "<?php echo U('Log/set_one');?>",
        data: {"middle":middle,"middle_money":money},
        dataType:"json",
        success:function(data){
            if(data==200){
                layer.alert(data.info,{time:1000});
                setInterval(function(){ location.href="<?php echo U('Log/set');?>"; },1000);
            }else{
                layer.alert(data.info,{time:1000});
                setInterval(function(){ location.href="<?php echo U('Log/set');?>"; },1000);
            }
        }
    })
  })
})

$("#one3").click(function(){
   var right = $("#right1").val();
   var money = $("#right1_money").val();
   layer.confirm('确认要设置指标个数吗 ？',function(index){
    $.ajax({
        type: "post",
        url: "<?php echo U('Log/set_one');?>",
        data: {"right":right,"right_money":money},
        dataType:"json",
        success:function(data){
            if(data==200){
                layer.alert(data.info,{time:1000});
                setInterval(function(){ location.href="<?php echo U('Log/set');?>"; },1000);
            }else{
                layer.alert(data.info,{time:1000});
                setInterval(function(){ location.href="<?php echo U('Log/set');?>"; },1000);
            }
        }
    })
  })
})

$("#two1").click(function(){
   var left = $("#left2").val();
   var money = $("#left2_money").val();
   layer.confirm('确认要设置指标个数吗 ？',function(index){
    $.ajax({
        type: "post",
        url: "<?php echo U('Log/set_two');?>",
        data: {"left":left,"left_money":money},
        dataType:"json",
        success:function(data){
            if(data==200){
                layer.alert(data.info,{time:1000});
                setInterval(function(){ location.href="<?php echo U('Log/set');?>"; },1000);
            }else{
                layer.alert(data.info,{time:1000});
                setInterval(function(){ location.href="<?php echo U('Log/set');?>"; },1000);
            }
        }
    })
  })
})

$("#two2").click(function(){
   var middle = $("#middle2").val();
   var money = $("#middle2_money").val();
   layer.confirm('确认要设置指标个数吗 ？',function(index){
    $.ajax({
        type: "post",
        url: "<?php echo U('Log/set_two');?>",
        data: {"middle":middle,"middle_money":money},
        dataType:"json",
        success:function(data){
            if(data==200){
                layer.alert(data.info,{time:1000});
                setInterval(function(){ location.href="<?php echo U('Log/set');?>"; },1000);
            }else{
                layer.alert(data.info,{time:1000});
                setInterval(function(){ location.href="<?php echo U('Log/set');?>"; },1000);
            }
        }
    })
  })
})

$("#two3").click(function(){
   var right = $("#right2").val();
   var money = $("#right2_money").val();
   layer.confirm('确认要设置指标个数吗 ？',function(index){
    $.ajax({
        type: "post",
        url: "<?php echo U('Log/set_two');?>",
        data: {"right":right,"right_money":money},
        dataType:"json",
        success:function(data){
            if(data==200){
                layer.alert(data.info,{time:1000});
                setInterval(function(){ location.href="<?php echo U('Log/set');?>"; },1000);
            }else{
                layer.alert(data.info,{time:1000});
                setInterval(function(){ location.href="<?php echo U('Log/set');?>"; },1000);
            }
        }
    })
  })
})

$("#c3").click(function(){
   var left3 = $("#left3").val();
   layer.confirm('确认要设置指标个数吗 ？',function(index){
    $.ajax({
        type: "post",
        url: "<?php echo U('Log/set_three');?>",
        data: {"left3":left3},
        dataType:"json",
        success:function(data){
            if(data==200){
                layer.alert(data.info,{time:1000});
                setInterval(function(){ location.href="<?php echo U('Log/set');?>"; },1000);
            }else{
                layer.alert(data.info,{time:1000});
                setInterval(function(){ location.href="<?php echo U('Log/set');?>"; },1000);
            }
        }
    })
  })
})


var page_url = {
    "save_url1" : "<?php echo U('Log/set_one');?>",
    "save_url2" : "<?php echo U('Log/set_two');?>",
    "save_url3" : "<?php echo U('Log/set_three');?>",
    "list_url" : "<?php echo U('Log/set');?>",

}
</script>