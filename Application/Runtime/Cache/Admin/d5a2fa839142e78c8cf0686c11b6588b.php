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
<!-- menu -->
<nav class="breadcrumb"><i class="Hui-iconfont">&#xe67f;</i> 首页 
  	<span class="c-gray en">&gt;</span> 业务管理
  	<span class="c-gray en">&gt;</span> 添加业务
    <!-- 返回 -->
    <span class="c-gray en" 
        onClick="history.go(-1);" style="cursor:pointer;">&gt;&nbsp;&nbsp;返回
    </span>
    <!-- 刷新 -->
  	<a class="btn btn-success radius r" style="line-height:1.6em;margin-top:3px" 
  	href="javascript:location.replace(location.href);" title="刷新" >
  	<i class="Hui-iconfont">&#xe68f;</i></a>
</nav>
<!-- content -->
<div class="page-container">
	<form method="post" class="form form-horizontal" action="#" 
    id="form-article-add" enctype="multipart/form-data">

      <!-- text -->
  		<div class="row cl">
  			<label class="form-label col-xs-4 col-sm-2" style="width:160px;">合同名称</label>
  			<div class="formControls col-xs-8 col-sm-9">
  				<input type="text" class="input-text" value="<?php echo ($sign["sign_name"]); ?>" placeholder="请输入合同名称" 
  				id="sign_name" name="sign_name">
          <input type="hidden" name="sign_id" value="<?php echo ($sign["sign_id"]); ?>">
  			</div>
  		</div>

       <!-- text -->
      <div class="row cl">
        <label class="form-label col-xs-4 col-sm-2" style="width:160px;">合同说明</label>
        <div class="formControls col-xs-8 col-sm-9">
          <input type="text" class="input-text" value="<?php echo ($sign["sign_text"]); ?>" placeholder="请输入合同说明" 
          id="sign_text" name="sign_text">
        </div>
      </div>

     <!-- text -->
      <div class="row cl">
        <label class="form-label col-xs-4 col-sm-2" style="width:160px;">上传合同</label>
        <div class="formControls col-xs-8 col-sm-9">
          <input type="file" name="sign_pic[]" id="sign_pic[]">
        </div>
      </div>

      <!-- select -->
      <div class="row cl" onClick="cus1()">
            <label class="form-label col-xs-4 col-sm-2" style="width:160px;">选择客户</label>
            <div class="formControls col-xs-8 col-sm-9 s11"> 
                <input type="text" class="input-text" value="<?php echo ($sign["customer_name"]); ?>" placeholder="请选择客户名称"
          id="customer" name="customer">
            </div>
        </div>

      <!-- text -->
      <div class="row cl s2" style="display:none">
        <label class="form-label col-xs-4 col-sm-2" style="width:160px;">&nbsp;</label>
        <div class="formControls col-xs-8 col-sm-9">
          <input type="text" class="input-text" value="" placeholder="请输入要搜索的客户" 
          id="kehu" name="kehu">
        </div>
      </div>

        <div class="row cl s1" style="display:none;">
            <label class="form-label col-xs-4 col-sm-2" style="width:160px;">&nbsp;</label>
            <div class="formControls col-xs-8 col-sm-9"> 
                <span class="select-box ssss">
                    <select name="customer_id" id="test" class="select">
                    <?php if(is_array($customer)): $i = 0; $__LIST__ = $customer;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v1): $mod = ($i % 2 );++$i;?><option value="<?php echo ($v1["customer_id"]); ?>"><?php echo ($v1["customer_company"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
                    </select>
                </span> 
            </div>
        </div>

      <!-- text -->
      <div class="row cl">
        <label class="form-label col-xs-4 col-sm-2" style="width:160px;">签约时间</label>
        <div class="formControls col-xs-8 col-sm-9">
         <input type="text" 
		onfocus="WdatePicker({dateFmt:'yyyy-MM-dd',Date:'#F<?php echo ($dp["$D('datemin') or '%y-%M-%d'"]); ?>'})" 
		id="datemin" class="input-text Wdate" placeholder="请选择签约开始时间" value="<?php echo date('Y-m-d',$sign['sign_start_time']);?>" 
		style="width:280px;" name="start_time">
    --
    <input type="text" 
    onfocus="WdatePicker({dateFmt:'yyyy-MM-dd',Date:'#F<?php echo ($dp["$D('datemin') or '%y-%M-%d'"]); ?>'})" 
    id="datemin" class="input-text Wdate" placeholder="请选择签约结束时间" value="<?php echo date('Y-m-d',$sign['sign_end_time']);?>" 
    style="width:280px;" name="end_time">
        </div>
      </div>


      <!-- button -->
       <div class="row cl">
          <label class="form-label col-xs-4 col-sm-2" style="width:160px;"></label>
          <div class="formControls col-xs-8 col-sm-9">
          <button class="btn btn-primary radius btn_submit" type="button">
              <i class="Hui-iconfont">&#xe632;</i> 保存并提交
          </button>
          <button 
              onClick="history.go(-1);" class="btn btn-default radius" type="button">&nbsp;返回&nbsp;
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

<script src="/zhiyan/tp32/Public/zhiyan/common/common.js"></script>
<script src="/zhiyan/tp32/Public/lib/My97DatePicker/WdatePicker.js"></script> 

<script>
var page_url = {
    'save_url' : "<?php echo U('Business/sign_mod_save');?>",
    'list_url' : "<?php echo U('Business/sign_list');?>",
}

/* 搜索客户显示功能 */
function cus1(){
  $(".s1").show();
  $(".s2").show();
}

/* 追加时间表单 */
window.onload = function(){
   /* 给表单赋值 */
   $(".ssss").click(function(){
        var options = $("#test option:selected").text();
        $("#customer").val(options);
   });
}

/* 动态给客户赋值 */
$("[name='kehu']").change(function(){
    var kehu = $("#kehu").val();
    $.ajax({
        url:"<?php echo U('Business/search_business');?>",
        data:"kehu="+kehu,
        type:'post',
        success:function(re){
            var res=JSON.parse(re);
            var key="";
            for(var i=0;i<res.length;i++){
               key+='<option value="'+ res[i].customer_id+'">'+ res[i].customer_company+'</option>';
            }
            $("[name='customer_id']").html(key);
        }
    })
})

/* 删除追加表单 */
function del(val){
  $("#"+val).remove();
}

</script>