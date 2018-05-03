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
		<form action="<?php echo U('Node/role_list');?>" method="post">
		<!-- text -->
		<input type="text" class="input-text" style="width:240px" value="<?php echo ($role["role_name"]); ?>"
		placeholder="&nbsp;输入角色名称" name="role_name">
		<!-- date -->
		<input type="text" value="<?php echo ($role["from"]); ?>" 
		onfocus="WdatePicker({dateFmt:'yyyy-MM-dd HH:mm:ss',Date:'#F<?php echo ($dp["$D('datemin') or '%y-%M-%d'"]); ?>'})" 
		id="datemin" class="input-text Wdate" 
		style="width:180px;" name="from" placeholder="&nbsp;请选择添加时间"> 
		-
	    <input type="text" value="<?php echo ($role["to"]); ?>" 
	    onfocus="WdatePicker({dateFmt:'yyyy-MM-dd HH:mm:ss',Date:'#F<?php echo ($dp["$D('datemin') or '%y-%M-%d'"]); ?>'})" 
	    id="datemin" class="input-text Wdate" 
	    style="width:180px;" name="to" placeholder="&nbsp;请选择添加时间">
	    <!-- button -->
		<button type="submit" class="btn btn-success radius" id="search_key">搜角色</button>
		</form>
	</div>
	<div class="cl pd-5 bg-1 bk-gray mt-20" style="margin-top:5px;"> 
		<span class="l">
			<!-- delete -->
			<a href="javascript:;" onclick="datadel()" class="btn btn-danger radius">
			<i class="Hui-iconfont">&#xe6e2;</i> 批量删除</a> 
			<!-- add -->
			<a class="btn btn-success radius" href="<?php echo U('Node/role_add');?>">添加角色</a>
		</span> 
		<!-- total -->
		<span class="r" style="line-height:28px;">
			共有数据&nbsp;&nbsp;
			<strong><?php echo ($role["count"]); ?></strong>&nbsp;&nbsp;条
		</span> 
	</div>
	<div class="mt-20" style="margin-top:10px;">
		<table class="table table-border table-bordered table-bg table-hover table-sort">
			<thead>
				<tr class="text-c">
					<th width="25"><input type="checkbox" name="" value=""></th>
					<th width="80">ID</th>
					<th>角色名称</th>
					<th>排序</th>
					<th>添加时间</th>
					<th>分配权限</th>
					<th>操作</th>
				</tr>
			</thead>
			<tbody>
			<?php if(is_array($role['role'])): foreach($role['role'] as $key=>$v): ?><tr class="text-c">
					<td>
						<input type="checkbox" value="<?php echo ($v["role_id"]); ?>" name="dataid" 
						id="dataid" _id="<?php echo ($v["role_id"]); ?>">
					</td>
					<td><?php echo ($v["role_id"]); ?></td>
					<td><?php echo ($v["role_name"]); ?></td>
					<td><?php echo ($v["role_sort"]); ?></td>
					<td><?php echo ($v["role_time"]); ?></td>
					<td>
						<!-- 编辑 -->
						<a style="text-decoration:none" class="ml-5" 
						href="<?php echo U('Node/node_user',array('role_id'=>$v['role_id']));?>" title="分配权限">
						<i class="Hui-iconfont">&#xe665;</i></a> 
					</td>
					<td class="f-14 td-manage">
						<!-- edit -->
						<a style="text-decoration:none" class="ml-5" 
						href="<?php echo U('Node/role_mod',array('role_id'=>$v['role_id']));?>" title="编辑">
						<i class="Hui-iconfont">&#xe6df;</i></a> 
						<!-- delete -->
						<a style="text-decoration:none" class="ml-5" 
						onClick="del(this,<?php echo ($v['role_id']); ?>)" href="javascript:;" title="删除">
						<i class="Hui-iconfont">&#xe6e2;</i></a>
					</td>
				</tr><?php endforeach; endif; ?>
				<tr><td colspan="7" class="text-c"><?php echo ($role['link']); ?></td></tr>
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
    'save_del' : "<?php echo U('Node/role_del');?>",
    'list_url' : "<?php echo U('Node/role_list');?>",
}
</script>