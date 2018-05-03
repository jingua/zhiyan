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
		<!-- select -->
		<span class="select-box" style="width:280px;">
			<select name="type_id" class="select">
				<option value="">收款审核</option>
				<option value="">业务审核</option>
				<option value="">渠道审核</option>
				<option value="">收款记录</option>
			</select>
		</span> 
		<!-- date -->
		<input type="text" 
		onfocus="WdatePicker({dateFmt:'yyyy-MM-dd HH:mm:ss',Date:'#F<?php echo ($dp["$D('datemin') or '%y-%M-%d'"]); ?>'})" 
		id="datemin" class="input-text Wdate" placeholder="请选择添加时间" name="from" 
		style="width:200px;" value="<?php echo ($channel["from"]); ?>"> 
		-
		<input type="text" 
		onfocus="WdatePicker({dateFmt:'yyyy-MM-dd HH:mm:ss',Date:'#F<?php echo ($dp["$D('datemin') or '%y-%M-%d'"]); ?>'})" 
		id="datemin" class="input-text Wdate" placeholder="请选择添加时间" value="<?php echo ($channel["to"]); ?>" 
		style="width:200px;" name="to">
		<!-- button -->
		<button type="submit" class="btn btn-success radius" id="sousuo_user">
		<i class="Hui-iconfont">&#xe665;</i> 搜规渠道</button>
		</form>
	</div>
	<div class="cl pd-5 bg-1 bk-gray mt-20" style="margin-top:6px;"> 
		<span class="l">
			<!-- delete -->
			<!-- <a href="javascript:;" onclick="datadel()" class="btn btn-danger radius">
			<i class="Hui-iconfont">&#xe6e2;</i> 批量删除</a> -->
			<!-- add -->
			<a href="<?php echo U('Property/property_list');?>" class="btn btn-success more_coupon">收款审核</a>
			<a href="<?php echo U('Property/property_list_remember');?>" class="btn btn-success more_coupon">收款记录</a>
			<a href="<?php echo U('Property/business_list');?>" class="btn btn-danger radius">业务审核</a>
			<a href="<?php echo U('Property/channel_list');?>" class="btn btn-success more_coupon">渠道审核</a>
			<a href="<?php echo U('Property/pay_list');?>" class="btn btn-success more_coupon">支出审核</a>
			<a href="<?php echo U('Property/pay_relist');?>" class="btn btn-success">支出记录</a>
			<a href="<?php echo U('Property/contract_list');?>" class="btn btn-success">合同审核</a>
			<a href="<?php echo U('Property/contract_relist');?>" class="btn btn-success">合同记录</a>
		</span> 
		<!-- total -->
		<span class="r" style="line-height:30px;">
			共有数据&nbsp;&nbsp;
			<strong><?php echo ($business["total"]); ?></strong>&nbsp;&nbsp;条
		</span> 
	</div>
	<div class="mt-20" style="margin-top:10px;">
	<table class="table table-border table-bordered table-hover table-bg table-sort">
		<thead>
			<tr class="text-c">
				<!-- <th width="40"><input type="checkbox" name="" value=""></th> -->
				<th>ID</th>
				<th>项目名称</th>
				<th>客户名称</th>
				<th>项目总款</th>
				<th>申请付款项</th>
				<th>投放情况</th>
				<th>创建日期</th>
				<th>更新时间</th>
				<th>提醒时间</th>
				<th>成员名称</th>
				<th>操作</th>
			</tr>
		</thead> 
		<tbody id="ks_user">
			<?php if(is_array($business["business"])): foreach($business["business"] as $key=>$v): ?><tr class="text-c">
				<!-- <td>
					<input type="checkbox" value="<?php echo ($v["member_id"]); ?>" name="dataid" 
					id="dataid" _id="<?php echo ($v["customer_id"]); ?>">
				</td> -->
				<td><?php echo ($v["business_id"]); ?></td>
				<td><?php echo ($v["business_name"]); ?></td>
				<td><?php echo ($v["customer_name"]); ?></td>
				<td><?php echo ($v["business_total"]); ?></td>
				<td>
					<?php if(empty($v["business_fkx"])): ?>无
					<?php else: ?> 
						有<span style="color:red;font-weight:bold"> <?php echo ($v["business_fkx"]); ?>元 </span>申请收款<?php endif; ?> 
				</td>
				<td><a href="<?php echo U('Business/Business_time',array('business_id'=>$v['business_id']));?>">查看投放情况</a></td>
				<td><?php echo ($v["create_time"]); ?></td>
				<td><?php echo ($v["update_time"]); ?></td>
				<td><?php echo ($v["remind_time"]); ?></td>
				<td><?php echo ($v["member_name"]); ?></td>
				<td class="td-manage">
					<!-- delete -->
					<a style="text-decoration:none" class="btn btn-danger radius"
						onClick="redel(this,<?php echo ($v['business_id']); ?>)" href="javascript:;" title="同意申请删除">
						<i class="Hui-iconfont">同意申请删除</i>
					</a>
				</td>
			</tr><?php endforeach; endif; ?>
			<tr><td colspan=24 style="text-align:center;"><?php echo ($business["link"]); ?></td></tr>
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

<script src="/zhiyan/business_admin/Public/lib/My97DatePicker/WdatePicker.js"></script> 

<script>

/* delete one */
function redel(obj,id){
  layer.confirm("您确定要申请删除吗",function(index){
	$.ajax({
		type: "post",
		url: "<?php echo U('Property/business_del');?>",
		data: {"id":id},
		dataType: "json",
		success:function(data){
			if(data.ok==200){
				layer.alert(data.info,{icon:1,time:1000});
				setInterval(function(){ location.href="<?php echo U('Property/business_list');?>"; },1000);
			}else{
				layer.alert(data.info,{icon:2,time:1000});
			}
		}
	})
  })
}


/*var page_url = {
    'save_redel' : "<?php echo U('Business/business_redel');?>",
    'list_url' : "<?php echo U('Customer/customer_list');?>",
}
*/
/*
 * 申请收款
 * xiami
 * 2018-03-27
*/
function business_price(title,url,w,h){
	layer_show(title,url,w,h);
}

/*
 * 支出管理
 * xiami
 * 2018-03-27
*/
function business_pay(title,url,w,h){
	layer_show(title,url,w,h);
}

/*
 * 上传合同
 * xiami
 * 2018-03-27
*/
function business_contract(title,url,w,h){
	layer_show(title,url,w,h);
}

/*
 * 申请删除
 * xiami
 * 2018-03-27
*/
function business_del(title,url,w,h){
	layer_show(title,url,w,h);
}


function business_show(title,url,w,h){
	layer_show(title,url,w,h);
}

</script>