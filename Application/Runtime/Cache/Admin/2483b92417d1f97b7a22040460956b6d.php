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

<!-- content -->
<div class="page-container">
	<form method="post" class="form form-horizontal" action="#" 
    id="form-article-add" enctype="multipart/form-data">

      <!-- text -->
  		<div class="row cl">
  			<label class="form-label col-xs-4 col-sm-2" style="width:160px;">款项金额</label>
  			<div class="formControls col-xs-8 col-sm-9">
  				<input type="text" class="input-text" value="" placeholder="请输入申请项目款项金额" 
  				id="price_total" name="price_total" style="width:480px;">
  				<input type="hidden" name="business_id" value="<?php echo ($id); ?>">
  			</div>
  		</div>

      <div class="row cl s1">
            <label class="form-label col-xs-4 col-sm-2" style="width:160px;">收款方式</label>
            <div class="formControls col-xs-8 col-sm-9"> 
                <span class="select-box ssss" style="width:480px;">
                    <select name="pay_id" id="pay_id" class="select">
                    <?php if(is_array($pay)): $i = 0; $__LIST__ = $pay;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v1): $mod = ($i % 2 );++$i;?><option value="<?php echo ($v1["pay_id"]); ?>"><?php echo ($v1["pay_name"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
                    </select>
                </span> 
            </div>
        </div>

      <!-- button -->
       <div class="row cl">
          <label class="form-label col-xs-4 col-sm-2" style="width:160px;"></label>
          <div class="formControls col-xs-8 col-sm-9">
          <button class="btn btn-primary radius btn_submit" type="button">
              <i class="Hui-iconfont">&#xe632;</i> 保存并提交
          </button>
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




</body>
</html>

<script src="/zhiyan/business_admin/Public/zhiyan/js/open.js"></script>
<script src="/zhiyan/business_admin/Public/lib/My97DatePicker/WdatePicker.js"></script> 

<script>
var page_url = {
    'save_url' : "<?php echo U('Business/business_price_save');?>",
    'list_url' : "<?php echo U('Business/business_list');?>",
}
</script>