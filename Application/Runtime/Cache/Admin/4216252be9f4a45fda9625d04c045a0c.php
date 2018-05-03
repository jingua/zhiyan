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
<nav class="breadcrumb">
	<i class="Hui-iconfont">&#xe67f;</i> 首页 
	<span class="c-gray en">&gt;</span> 审核管理 
	<span class="c-gray en">&gt;</span> 审核列表 
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
		<form action="<?php echo U('Channel/channel_list');?>" method="post">
		
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
			<a href="<?php echo U('Property/property_list');?>" class="btn btn-success">收款审核</a>
			<a href="<?php echo U('Property/property_list_remember');?>" class="btn btn-success more_coupon">收款记录</a>
			<a href="<?php echo U('Property/business_list');?>" class="btn btn-success more_coupon">业务审核</a>
			<a href="<?php echo U('Property/channel_list');?>" class="btn btn-success more_coupon">渠道审核</a>
			<a href="<?php echo U('Property/pay_list');?>" class="btn btn-success more_coupon">支出审核</a>
			<a href="<?php echo U('Property/pay_relist');?>" class="btn btn-danger radius">支出记录</a>
			<a href="<?php echo U('Property/contract_list');?>" class="btn btn-success">合同审核</a>
			<a href="<?php echo U('Property/contract_relist');?>" class="btn btn-success">合同记录</a>
		</span> 
		<!-- total -->
		<span class="r" style="line-height:30px;">
			共有数据&nbsp;&nbsp;
			<strong><?php echo ($pay["total"]); ?></strong>&nbsp;&nbsp;条
		</span> 
	</div>
	<div class="mt-20" style="margin-top:10px;">
	<table class="table table-border table-bordered table-hover table-bg table-sort">
		<thead>
			<tr class="text-c">
				<!-- <th width="40"><input type="checkbox" name="" value=""></th> -->
				<th>ID</th>
				<th>项目名称</th>
				<th>支出金额</th>
				<th>业务负责人</th>
				<th>支出说明</th>
				<th>支出时间</th>
				<th>操作</th>
			</tr>
		</thead> 
		<tbody id="ks_user">
			<?php if(is_array($pay["pay"])): foreach($pay["pay"] as $key=>$v): ?><tr class="text-c">
				<!-- <td>
					<input type="checkbox" value="<?php echo ($v["channel_id"]); ?>" name="dataid" 
					id="dataid" _id="<?php echo ($v["channel_id"]); ?>">
				</td> -->
				<td><?php echo ($v["pay_id"]); ?></td>
				<td><?php echo ($v["business_name"]); ?></td>
				<td><?php echo ($v["pay_price"]); ?></td>
				<td><?php echo ($v["member_name"]); ?></td>
				<td><?php echo ($v["pay_name"]); ?></td>
				<td><?php echo ($v["create_time"]); ?></td>
				<td class="td-manage">
					<?php if(($v["pay_status"]) == "2"): ?><a style="text-decoration:none" class="btn btn-success"
						<i class="Hui-iconfont">通过</i>
					</a>
					<?php else: ?>
						<a style="text-decoration:none" class="btn btn-success"
						<i class="Hui-iconfont">未通过</i><?php endif; ?>
				</td>
			</tr><?php endforeach; endif; ?>
			<tr><td colspan=15 style="text-align:center;"><?php echo ($channel["link"]); ?></td></tr>
		</tbody>
	</table>
	</div>
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
    'save_del' : "<?php echo U('Property/pay_del');?>",
    'list_url' : "<?php echo U('Property/pay_list');?>",
}
</script>