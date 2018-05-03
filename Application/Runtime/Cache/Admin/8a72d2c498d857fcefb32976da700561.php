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
	<span class="c-gray en">&gt;</span> 权限管理 
	<span class="c-gray en">&gt;</span> 角色列表 
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
		<form action="<?php echo U('Node/node_list');?>" method="post">
		<!-- text -->
		<input type="text" class="input-text" style="width:240px" value="<?php echo ($node["node_name"]); ?>"
		placeholder="&nbsp;输入节点名称" name="node_name">
		<!-- date -->
		<input type="text" value="<?php echo ($node["from"]); ?>" 
		onfocus="WdatePicker({dateFmt:'yyyy-MM-dd HH:mm:ss',Date:'#F<?php echo ($dp["$D('datemin') or '%y-%M-%d'"]); ?>'})" 
		id="datemin" class="input-text Wdate" 
		style="width:180px;" name="from" placeholder="&nbsp;请选择添加时间"> 
		-
	    <input type="text" value="<?php echo ($node["to"]); ?>" 
	    onfocus="WdatePicker({dateFmt:'yyyy-MM-dd HH:mm:ss',Date:'#F<?php echo ($dp["$D('datemin') or '%y-%M-%d'"]); ?>'})" 
	    id="datemin" class="input-text Wdate" 
	    style="width:180px;" name="to" placeholder="&nbsp;请选择添加时间">
	    <!-- button -->
		<button type="submit" class="btn btn-success radius" id="search_key">搜节点</button>
		</form>
	</div>
	<div class="cl pd-5 bg-1 bk-gray mt-20" style="margin-top:5px;"> 
		<span class="l">
			<!-- delete -->
			<a href="javascript:;" onclick="datadel()" class="btn btn-danger radius">
			<i class="Hui-iconfont">&#xe6e2;</i> 批量删除</a> 
			<!-- add -->
			<a class="btn btn-success radius" href="<?php echo U('Node/node_add');?>">添加节点</a>
		</span> 
		<!-- total -->
		<span class="r" style="line-height:28px;">
			共有数据&nbsp;&nbsp;
			<strong><?php echo ($node["count"]); ?></strong>&nbsp;&nbsp;条
		</span> 
	</div>
	<div class="mt-20" style="margin-top:10px;">
		<table class="table table-border table-bordered table-bg table-hover table-sort">
			<thead>
				<tr class="text-c">
					<th width="40"><input type="checkbox" name="" value=""></th>
					<th>ID</th>
					<th>节点名称</th>
					<th>节点描述</th>
					<th>排序</th>
					<th>添加时间</th>
					<th width="120">操作</th>
				</tr>
			</thead>
			<tbody>
			<?php if(is_array($node["node"])): foreach($node["node"] as $key=>$v1): ?><tr class="text-c">
					<td>
						<input type="checkbox" value="<?php echo ($v1["node_id"]); ?>" name="dataid" 
						id="dataid" _id="<?php echo ($v1["node_id"]); ?>">
					</td>
					<td><?php echo ($v1["node_id"]); ?></td>
					<td style="color:red;font-weight:700" class="text-l"><?php echo ($v1["node_name"]); ?>Action</td>
					<td style="padding-left:12px;color:red;font-weight:500;" class="text-l"><?php echo ($v1["node_descr"]); ?></td>
					<td><?php echo ($v1["node_sort"]); ?></td>
					<td><?php echo ($v1["node_time"]); ?></td>
					<td class="f-14 td-manage">
						<!-- edit -->
						<a style="text-decoration:none" class="ml-5" 
						href="<?php echo U('Node/node_mod',array('node_id'=>$v1['node_id']));?>" title="编辑">
						<i class="Hui-iconfont">&#xe6df;</i></a> 
						<!-- delete -->
						<a style="text-decoration:none" class="ml-5" 
						onClick="del(this,<?php echo ($v1['node_id']); ?>)" href="javascript:;" title="删除">
						<i class="Hui-iconfont">&#xe6e2;</i></a>
					</td>
				</tr>
					<?php if(is_array($v1['actions'])): foreach($v1['actions'] as $key=>$v2): ?><tr class="text-c">
							<td>
								<input type="checkbox" value="<?php echo ($v2["node_id"]); ?>" name="dataid" 
								id="dataid" _id="<?php echo ($v2["node_id"]); ?>">
							</td>
							<td><?php echo ($v2["node_id"]); ?></td>
							<td style="padding-left:48px;" class="text-l"><?php echo ($v2["node_name"]); ?></td>
							<td style="padding-left:48px;" class="text-l"><?php echo ($v2["node_descr"]); ?></td>
							<td><?php echo ($v2["node_sort"]); ?></td>
							<td><?php echo ($v2["node_time"]); ?></td>
							<td class="f-14 td-manage">
								<!-- edit -->
								<a style="text-decoration:none" class="ml-5" 
								href="<?php echo U('Node/node_mod',array('node_id'=>$v2['node_id']));?>" title="编辑">
								<i class="Hui-iconfont">&#xe6df;</i></a> 
								<!-- delete -->
								<a style="text-decoration:none" class="ml-5" 
								onClick="del(this,<?php echo ($v2['node_id']); ?>)" href="javascript:;" title="删除">
								<i class="Hui-iconfont">&#xe6e2;</i></a>
							</td>
						</tr><?php endforeach; endif; endforeach; endif; ?>
					<tr><td colspan="8" class="text-c"><?php echo ($node["link"]); ?></td></tr>
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
<script type="text/javascript" src="/zhiyan/business_admin/Public/lib/My97DatePicker/WdatePicker.js"></script> 

<script>
var page_url = {
    'save_del' : "<?php echo U('Node/node_del');?>",
    'list_url' : "<?php echo U('Node/node_list');?>",
}
</script>