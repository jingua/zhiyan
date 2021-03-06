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
	<span class="c-gray en">&gt;</span> 业务管理 
	<span class="c-gray en">&gt;</span> 业务列表 
	<!-- 返回 -->
    <span class="c-gray en" 
        onClick="history.go(-1);" style="cursor:pointer;">&gt;&nbsp;&nbsp;返回
    </span>
	<!-- 刷新 -->
	<a class="btn btn-success radius r" 
		style="line-height:1.6em;margin-top:3px" 
		href="javascript:location.replace(location.href);" title="刷新" >
		<i class="Hui-iconfont">&#xe68f;</i>
	</a>
</nav>
<!-- content -->
<div class="page-container" style="margin-top:-30px;">
	<div class="cl pd-5 mt-20">
		<form action="<?php echo U('Customer/customer_list');?>" method="post">
		<!-- text -->
		<input type="text" class="input-text" value="<?php echo ($customer["customer_brand"]); ?>"
		style="width:360px" name="customer_brand" placeholder="曾服务什么品牌" />
		<!-- date -->
		<input type="text" 
		onfocus="WdatePicker({dateFmt:'yyyy-MM-dd HH:mm:ss',Date:'#F<?php echo ($dp["$D('datemin') or '%y-%M-%d'"]); ?>'})" 
		id="datemin" class="input-text Wdate" placeholder="请选择添加时间" name="from" 
		style="width:200px;" value="<?php echo ($customer["from"]); ?>"> 
		-
		<input type="text" 
		onfocus="WdatePicker({dateFmt:'yyyy-MM-dd HH:mm:ss',Date:'#F<?php echo ($dp["$D('datemin') or '%y-%M-%d'"]); ?>'})" 
		id="datemin" class="input-text Wdate" placeholder="请选择添加时间" value="<?php echo ($customer["to"]); ?>" 
		style="width:200px;" name="to">
		<!-- button -->
		<button type="submit" class="btn btn-success radius" id="sousuo_user">
		<i class="Hui-iconfont">&#xe665;</i> 搜规客户</button>
		</form>
	</div>
	<div class="cl pd-5 bg-1 bk-gray mt-20" style="margin-top:6px;"> 
		<span class="l">
			<!-- add -->
			<a href="#" class="btn btn-success more_coupon">投放情况列表</a>
		</span> 
		<!-- total -->
		<span class="r" style="line-height:30px;">
			共有数据&nbsp;&nbsp;
			<strong><?php echo count($time); ?></strong>&nbsp;&nbsp;条
		</span> 
	</div>
	<div class="mt-20" style="margin-top:10px;">
	<table class="table table-border table-bordered table-hover table-bg table-sort">
		<thead>
			<tr class="text-c">
				<th>项目名称</th>
				<th>投放时间</th>
				<th>折扣</th>
				<th>发票金额</th>
				<th>投入位置</th>
				<th>价格</th>
			</tr>
		</thead> 
		<tbody id="ks_user">
			<?php if(is_array($time)): foreach($time as $key=>$v): ?><tr class="text-c">
				<td><?php echo ($v["channel_name"]); ?></td>
				<td><?php echo ($v["time_time"]); ?></td>
				<td><?php echo ($v["time_price"]); ?></td>
				<td><?php echo ($v["invoice_price"]); ?></td>
				<td>
					<?php if(($v["time_text"]) == "first"): ?>头条<?php endif; ?>
					<?php if(($v["time_text"]) == "end"): ?>次条<?php endif; ?>
				</td>
				<td><?php echo ($v["price"]); ?></td>
			</tr><?php endforeach; endif; ?>
			<tr><td colspan=16 style="text-align:center;"><?php echo ($business["link"]); ?></td></tr>
		</tbody>
	</table>
	</div>
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

<script src="/zhiyan/business_admin/Public/zhiyan/common/common.js"></script>
<script src="/zhiyan/business_admin/Public/lib/My97DatePicker/WdatePicker.js"></script> 

<script>

var page_url = {
    'save_del' : "<?php echo U('Customer/customer_del');?>",
    'list_url' : "<?php echo U('Customer/customer_list');?>",
}

//设置结算
function time_stop(obj,id,business_id){
	layer.confirm('确认要结算吗？',function(index){
		$.ajax({
			type:"post",
			url:"/zhiyan/business_admin/index.php?s=/Admin/Business/time_stop.html",
			data:{'id':id,"business_id":business_id},
			dataType:"json",
			success:function(data){
				if(data.ok==200){
				  layer.alert(data.info,{icon: 1,time:1000});
				  setInterval(function(){ location.href='<?php echo U("Business/business_list");?>'; },1000);
				}else{
					layer.alert(data.info,{time:1000});
					setInterval(function(){ location.href='<?php echo U("Business/business_list");?>'; },1000);
				}
			},
			async:true
		});
	});
}

//设置未结算
function time_start(obj,id,business_id){
	layer.confirm('确认要未结算吗？',function(index){
		$.ajax({
			type:"post",
			url:"/zhiyan/business_admin/index.php?s=/Admin/Business/time_start.html",
			data:{'id':id,'business_id':business_id},
			dataType:"json",
			success:function(data){
				if(data.ok==200){
					layer.alert(data.info, {icon: 1,time:1000});
					setInterval(function(){ location.href='<?php echo U("Business/business_list",array("business_id"=>'+data.business_id+'));?>'; },1000);
				}else{
					layer.alert(data.info,{time:1000});
					setInterval(function(){ location.href='<?php echo U("Business/business_list");?>'; },1000);
				}
			},
			async:true
		});
		
	});
}

</script>