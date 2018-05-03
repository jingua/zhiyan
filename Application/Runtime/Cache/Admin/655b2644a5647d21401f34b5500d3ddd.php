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

<link rel="stylesheet" href="/zhiyan/business_admin/Public/lib/select1/bootstrap-select.css">    
<link href="/zhiyan/business_admin/Public/lib/select1/bootstrap.min.css" rel="stylesheet">  

<!-- <link rel="stylesheet" href="/zhiyan/business_admin/Public/lib/select2/common/plugins/bootstrap/dist/css/bootstrap.min.css" />
<link rel="stylesheet" href="/zhiyan/business_admin/Public/lib/select2/common/common.css" />
<link rel="stylesheet" href="/zhiyan/business_admin/Public/lib/select2/css/index.css" />
<link rel="stylesheet" href="/zhiyan/business_admin/Public/lib/select2/common/plugins/select2/select2.css" />
<link rel="stylesheet" href="/zhiyan/business_admin/Public/lib/select2/common/plugins/select2/select2-bootstrap.css" /> -->

<script src="/zhiyan/business_admin/Public/lib/select1/jquery.js"></script>  
<script src="/zhiyan/business_admin/Public/lib/layer/2.1/layer.js"></script>
<script src="/zhiyan/business_admin/Public/lib/icheck/jquery.icheck.min.js"></script>
<script src="/zhiyan/business_admin/Public/lib/jquery.validation/1.14.0/jquery.validate.min.js"></script> 
<script src="/zhiyan/business_admin/Public/lib/jquery.validation/1.14.0/validate-methods.js"></script> 
<script src="/zhiyan/business_admin/Public/lib/jquery.validation/1.14.0/messages_zh.min.js"></script> 
<!-- <script src="/zhiyan/business_admin/Public/static/h-ui/js/H-ui.js"></script>
<script src="/zhiyan/business_admin/Public/static/h-ui/js/H-ui.admin.js"></script> -->
<script src="/zhiyan/business_admin/Public/lib/jquery.form/jquery.form.js"></script>

</head>
<body>
<!-- menu -->
<nav class="breadcrumb"><i class="Hui-iconfont">&#xe67f;</i> 首页 
  	<span class="c-gray en">&gt;</span> 业务管理
  	<span class="c-gray en">&gt;</span> 编辑业务
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
    id="form-article-add" enctype="multipart/form-data" role="form">

      <!-- text -->
  		<div class="row cl">
  			<label class="form-label col-xs-4 col-sm-2" style="width:160px;">项目名称</label>
  			<div class="formControls col-xs-8 col-sm-9">
  				<input type="text" class="input-text" value="<?php echo ($business["business_name"]); ?>" placeholder="请输入项目名称" 
  				id="business_name" name="business_name">
          <input type="hidden" name="business_id" value="<?php echo ($business["business_id"]); ?>">
  			</div>
  		</div>

      <!-- text -->
      <div class="row cl">
        <label class="form-label col-xs-4 col-sm-2" style="width:160px;">项目总款</label>
        <div class="formControls col-xs-8 col-sm-9">
          <input type="text" class="input-text" value="<?php echo ($business["business_total"]); ?>" placeholder="请输入项目总款" 
          id="business_total" name="business_total">
        </div>
      </div>

      <!-- select -->
     <!--  <div class="row cl" onClick="cus1()">
           <label class="form-label col-xs-4 col-sm-2" style="width:160px;">选择客户</label>
           <div class="formControls col-xs-8 col-sm-9 s11"> 
               <input type="text" class="input-text" value="<?php echo ($business["kehu"]); ?>" placeholder="请选择客户名称" 
         id="customer" name="customer">
           </div>
       </div> -->

         <!--select-->
      <!-- <div class="row cl">
          <label class="form-label col-xs-4 col-sm-2" style="width:160px;">选择客户</label>
          <div class="formControls col-xs-8 col-sm-9 s11"> 
            <select select2 ng-model="" class="form-control" name="customer_id" placeholder="请选择客户">
              <?php if(is_array($customer)): $i = 0; $__LIST__ = $customer;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v1): $mod = ($i % 2 );++$i;?><option value="<?php echo ($v1["customer_id"]); ?>" <?php if(($v1["customer_id"]) == $business["customer_id"]): ?>selected<?php endif; ?>><?php echo ($v1["customer_company"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
            </select>
          </div>
      </div> -->

      <div class="row cl">
          <label class="form-label col-xs-4 col-sm-2" style="width:160px;">选择客户</label>
          <div class="formControls col-xs-8 col-sm-9 s11"> 
            <!-- <select select2 ng-model="" class="form-control" name="customer_id" placeholder="请选择客户">
              <?php if(is_array($customer)): $i = 0; $__LIST__ = $customer;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v1): $mod = ($i % 2 );++$i;?><option value="<?php echo ($v1["customer_id"]); ?>" <?php if(($v1["customer_id"]) == $business["customer_id"]): ?>selected<?php endif; ?>><?php echo ($v1["customer_company"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
            </select> -->
            <select id="bs3Select" class="selectpicker show-tick form-control" name="customer_id" data-live-search="true">
             <?php if(is_array($customer)): $i = 0; $__LIST__ = $customer;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v1): $mod = ($i % 2 );++$i;?><option value="<?php echo ($v1["customer_id"]); ?>" 
                  <?php if(($v1["customer_id"]) == $business["customer_id"]): ?>selected<?php endif; ?>><?php echo ($v1["customer_company"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?> 
            </select>
          </div>
      </div>


      <!-- text -->
      <div class="row cl">
        <label class="form-label col-xs-4 col-sm-2" style="width:160px;">提醒结款时间</label>
        <div class="formControls col-xs-8 col-sm-9">
         <input type="text" 
		onfocus="WdatePicker({dateFmt:'yyyy-MM-dd',Date:'#F<?php echo ($dp["$D('datemin') or '%y-%M-%d'"]); ?>'})" 
		id="datemin" class="input-text Wdate" placeholder="请选择添加时间" value="<?php echo ($business["remind_time"]); ?>" 
		style="width:280px;" name="remind_time">
        </div>
      </div>

       <!-- text -->
       <?php if(is_array($time)): $i = 0; $__LIST__ = $time;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;?><div class="row cl">
        <label class="form-label col-xs-4 col-sm-2" style="width:160px;">渠道名称</label>
        <div class="formControls col-xs-8 col-sm-9">
          <input type="text" class="input-text" value="<?php echo ($v["channel_name"]); ?>" id="channel_name" name="channel_name" disabled>
          <input type="hidden" name="time_id[]" id="time_id" value="<?php echo ($v["time_id"]); ?>">
        </div>
      </div>

      <div style="margin-left:160px;margin-top:12px;">
      	投放时间&nbsp;&nbsp;( 如果还没确定暂时可以不填 )&nbsp;&nbsp;
      	<input type="text" 
    		onfocus="WdatePicker({dateFmt:'yyyy-MM-dd',Date:'#F<?php echo ($dp["$D('datemin') or '%y-%M-%d'"]); ?>'})" 
    		id="datemin" class="input-text Wdate" placeholder="请选择添加时间" value="<?php echo ($v["time_time"]); ?>" 
    		style="width:180px;" name="time_time[]">
		    <span class="select-box" style="width:80px">
            <select name="time_text[]" id="time_text" class="select">
                 <option value="first" <?php if(($v["time_text"]) == "first"): ?>selected<?php endif; ?>>头条</option>
                 <option value="end" <?php if(($v["time_text"]) == "end"): ?>selected<?php endif; ?>>次条</option>
            </select>
        </span> 
        &nbsp;折扣&nbsp;
        <input type="text" class="input-text" value="<?php echo ($v["time_price"]); ?>"
          id="time_price" name="time_price[]" style="width:80px;">
        &nbsp;
        &nbsp;发票&nbsp;
        <input type="text" class="input-text" value="<?php echo ($v["invoice_price"]); ?>"
          id="invoice_price" name="invoice_price[]" placeholder="请输入发票金额" 
          style="width:120px;">
        &nbsp;
      </div><?php endforeach; endif; else: echo "" ;endif; ?>
      <div></div>

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

<script src="/zhiyan/business_admin/Public/lib/select1/bootstrap-select.js"></script>    
<script src="/zhiyan/business_admin/Public/lib/select1/bootstrap.min.js"></script>  

</body>
</html>

<!-- <script src="/zhiyan/business_admin/Public/lib/select2/common/plugins/angular/angular.min.js"></script>
<script src="/zhiyan/business_admin/Public/lib/select2/common/plugins/select2/select2.min.js"></script>
<script src="/zhiyan/business_admin/Public/lib/select2/js/index.js" type="text/javascript"></script> -->


<script src="/zhiyan/business_admin/Public/zhiyan/common/common.js"></script>
<script src="/zhiyan/business_admin/Public/lib/My97DatePicker/WdatePicker.js"></script> 



<script>  
    $(window).on('load', function () {  
        $('.selectpicker').selectpicker({  
            'selectedText': 'cat'  
        });  
    });  
</script> 

<script>
var page_url = {
    'save_url' : "<?php echo U('Business/business_mod_save');?>",
    'list_url' : "<?php echo U('Business/business_list');?>",
}

/* 搜索客户显示功能 */
function cus1(){
  $(".s1").show();
  $(".s2").show();
}

/* 追加时间表单 */
/*window.onload = function(){
   //给表单赋值
   $(".ssss").click(function(){
        var options = $("#test option:selected").text();
        $("#customer").val(options);
   });
}*/

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