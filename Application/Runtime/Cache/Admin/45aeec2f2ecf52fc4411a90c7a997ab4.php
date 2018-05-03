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
<link rel="stylesheet" href="/zhiyan/tp32/Public/static/h-ui/css/H-ui.min.css" />
<link rel="stylesheet" href="/zhiyan/tp32/Public/static/h-ui/css/H-ui.admin.css" />
<link rel="stylesheet" href="/zhiyan/tp32/Public/lib/Hui-iconfont/1.0.7/iconfont.css" />
<link rel="stylesheet" href="/zhiyan/tp32/Public/lib/icheck/icheck.css" />
<link rel="stylesheet" href="/zhiyan/tp32/Public/static/h-ui/skin/default/skin.css" id="skin" />
<link rel="stylesheet" href="/zhiyan/tp32/Public/static/h-ui/css/style.css" />
<title>知妍文化传播</title>
<meta name="keywords" content="">
<meta name="description" content="">
</head>
<body>
<!-- content -->
<div class="page-container">
	<form method="post" class="form form-horizontal" action="#" 
    id="form-article-add" enctype="multipart/form-data">

     <!-- text -->
      <div class="row cl">
        <label class="form-label col-xs-4 col-sm-2" style="width:100px;">添加支出</label>
        <div class="formControls col-xs-8 col-sm-9" style="line-height:28px;">
          <span style="cursor:pointer;" id="add">添加</span>
        </div>
      </div>

		<?php if(is_array($pay)): $i = 0; $__LIST__ = $pay;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;?><div class="row cl">
			<div class="formControls col-xs-8 col-sm-9">
        <label class="form-label col-xs-4 col-sm-2" style="width:100px;"></label>
				<input type="text" class="input-text" value="<?php echo ($v["pay_name"]); ?>" placeholder="请输入支出项目" 
				name="pay_name[]" style="width:180px;">
				<input type="text" class="input-text" value="<?php echo ($v["pay_price"]); ?>" placeholder="请输入支出款项" 
				name="pay_price[]" style="width:150px;">&nbsp;
        <input type="hidden" name="pay_id[]" value="<?php echo ($v["pay_id"]); ?>">

        <?php if($v["pay_status"] == 1): ?><a style="text-decoration:none" class="ml-5" 
            href="<?php echo U('Business/pay_del',array('id'=>$v['pay_id'],'business_id'=>$v['business_id']));?>">删除</a>
            &nbsp;&nbsp;
            <span style="color:red;">审核中</span>
        <?php elseif($v["pay_status"] == 2): ?>
            <span style="color:green;">审核通过</span>
        <?php else: ?> 
            <a style="text-decoration:none" class="ml-5" 
            href="<?php echo U('Business/pay_del',array('id'=>$v['pay_id'],'business_id'=>$v['business_id']));?>">删除</a>
            &nbsp;&nbsp;
            <span style="color:red;">审核未通过</span><?php endif; ?>
			</div>
		</div><?php endforeach; endif; else: echo "" ;endif; ?>
		 <div id="n"></div>

     <!-- button -->
       <div class="row cl">
          <label class="form-label col-xs-4 col-sm-2" style="width:100px;"></label>
          <div class="formControls col-xs-8 col-sm-9">
          <input type="hidden" name="business_id" value="<?php echo ($id); ?>">
          <button class="btn btn-primary radius btn_submit" type="button">
              <i class="Hui-iconfont">&#xe632;</i> 保存并提交
          </button>
          </div>
      </div>

	</form>
</div>
<script src="/zhiyan/tp32/Public/lib/jquery/1.9.1/jquery.min.js"></script> 
<script src="/zhiyan/tp32/Public/lib/layer/2.1/layer.js"></script> 
<script src="/zhiyan/tp32/Public/lib/icheck/jquery.icheck.min.js"></script> 
<script src="/zhiyan/tp32/Public/lib/jquery.validation/1.14.0/jquery.validate.min.js"></script> 
<script src="/zhiyan/tp32/Public/lib/jquery.validation/1.14.0/validate-methods.js"></script> 
<script src="/zhiyan/tp32/Public/lib/jquery.validation/1.14.0/messages_zh.min.js"></script> 
<script src="/zhiyan/tp32/Public/static/h-ui/js/H-ui.js"></script> 
<script src="/zhiyan/tp32/Public/static/h-ui/js/H-ui.admin.js"></script> 
<script src="/zhiyan/tp32/Public/lib/jquery.form/jquery.form.js"></script> 




</body>
</html>

<script src="/zhiyan/tp32/Public/lib/My97DatePicker/WdatePicker.js"></script> 

<script>

/* 执行数据添加 */
var is_submit = 0;
$(".btn_submit").on("click", function(){
if(is_submit == 1) return;
is_submit = 1;
$("#form-article-add").ajaxSubmit({
      url: "<?php echo U('Business/business_pay_save');?>",
      type: "POST",
      dataType: "json",
      beforeSend: function() {
      },
      error: function() {
        layer.alert("服务器超时，请稍后再试",{icon:2,time:1000});
        is_submit = 0;
      },
      success:function(data){
        if(data.ok == 200){
          layer.alert(data.info,{icon:1,time:1000});
          setInterval(function(){ location.href = "<?php echo U('Business/business_pay',array('id'=>$id));?>"; },1000);
        }else{
          layer.alert(data.info,{icon:2,time:1000});
        }
        is_submit=0;
      }
    });
});


/*添加图片表单*/
$().ready(function(){
    var i = 0;
    $("#add").click(function(){
     	var str = '<div class="row cl" id='+i+'>'+
		'<label class="form-label col-xs-4 col-sm-2" style="width:100px;"></label>'+
		'<div class="formControls col-xs-8 col-sm-9">'+
		'<input type="text" class="input-text" value="" placeholder="请输入支出项目"'+
		'name="pay_name[]" style="width:180px;">&nbsp;'+
		'<input type="text" class="input-text" value="" placeholder="请输入支出款项"'+
		'name="pay_price[]" style="width:150px;">&nbsp;&nbsp;&nbsp;'+
		'<a onclick="del('+i+')" href="javascript:;">删除</a></div></div>'
    $("#n").before(str);
    i++;
    });
  });

/*删除图片表单*/
function del(val){
  $("#"+val).remove();
}
</script>