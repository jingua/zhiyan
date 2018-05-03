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
	<span class="c-gray en">&gt;</span> 成员管理 
	<span class="c-gray en">&gt;</span> 成员列表 
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
		<form action="<?php echo U('Member/member_list');?>" method="post">
		<!-- text -->
		<input type="text" class="input-text" value="<?php echo ($member["member_user"]); ?>"
		style="width:360px" name="member_user" placeholder="请输入帐号" />
		<!-- select -->
		<!-- <span class="select-box" style="width:160px;">
		 	<select name="position_id" class="select">
		 		<option value="">请选择类型</option>
		 		<?php if(is_array($position)): foreach($position as $key=>$v): ?><option value="<?php echo ($v["position_id"]); ?>" 
		 		<?php if(($v["position_id"]) == $member["position_id"]): ?>selected<?php endif; ?>>
		 		<?php echo ($v["position_name"]); ?></option><?php endforeach; endif; ?>
		 	</select>
		 </span> --> 
		<!-- date -->
		<input type="text" 
		onfocus="WdatePicker({dateFmt:'yyyy-MM-dd HH:mm:ss',Date:'#F<?php echo ($dp["$D('datemin') or '%y-%M-%d'"]); ?>'})" 
		id="datemin" class="input-text Wdate" placeholder="请选择添加时间" name="from" 
		style="width:200px;" value="<?php echo ($member["from"]); ?>"> 
		-
		<input type="text" 
		onfocus="WdatePicker({dateFmt:'yyyy-MM-dd HH:mm:ss',Date:'#F<?php echo ($dp["$D('datemin') or '%y-%M-%d'"]); ?>'})" 
		id="datemin" class="input-text Wdate" placeholder="请选择添加时间" value="<?php echo ($member["to"]); ?>" 
		style="width:200px;" name="to">
		<!-- button -->
		<button type="submit" class="btn btn-success radius" id="sousuo_user">
		<i class="Hui-iconfont">&#xe665;</i> 搜索成员</button>
		</form>
	</div>
	<div class="cl pd-5 bg-1 bk-gray mt-20" style="margin-top:6px;"> 
		<span class="l">
			<!-- delete -->
			<a href="javascript:;" onclick="datadel()" class="btn btn-danger radius">
			<i class="Hui-iconfont">&#xe6e2;</i> 批量删除</a>
			<!-- add -->
			<a href="<?php echo U('Member/member_add');?>" class="btn btn-success more_coupon">添加成员</a>
		</span> 
		<!-- total -->
		<span class="r" style="line-height:30px;">
			共有数据&nbsp;&nbsp;
			<strong><?php echo ($member["total"]); ?></strong>&nbsp;&nbsp;条
		</span> 
	</div>
	<div class="mt-20" style="margin-top:10px;">
	<table class="table table-border table-bordered table-hover table-bg table-sort">
		<thead>
			<tr class="text-c">
				<th width="40"><input type="checkbox" name="" value=""></th>
				<th>ID</th>
				<th>帐号</th>
				<th>联系电话</th>
				<th>名字</th>
				<th>邮箱</th>
				<th>微信</th>
				<th>登录次数</th>
				<!-- <th>分配角色</th> -->
				<th>角色名称</th>
				<th>添加时间</th>
				<th>操作</th>
			</tr>
		</thead> 
		<tbody id="ks_user">
			<?php if(is_array($member["member"])): foreach($member["member"] as $key=>$v): ?><tr class="text-c">
				<td>
					<input type="checkbox" value="<?php echo ($v["member_id"]); ?>" name="dataid" 
					id="dataid" _id="<?php echo ($v["member_id"]); ?>">
				</td>
				<td><?php echo ($v["member_id"]); ?></td>
				<td><?php echo ($v["member_user"]); ?></td>
				<td><?php echo ($v["member_tel"]); ?></td>
				<td><?php echo ($v["member_name"]); ?></td>
				<td><?php echo ($v["member_email"]); ?></td>
				<td><?php echo ($v["member_wachat"]); ?></td>
				<td><?php echo ($v["member_num"]); ?></td>
				<!-- <td>
					编辑
					<a style="text-decoration:none" class="ml-5" 
					href="<?php echo U('Node/role_user',array('admin_id'=>$v['member_id']));?>" title="分配角色">
					<i class="Hui-iconfont">&#xe665;</i></a> 
				</td> -->
				<td>
					<?php if(($v["role_name"]) == "商务助理"): ?><a href="javascript:;" 
							onclick="member_parent('绑定关系','<?php echo U('Member/member_parent',array('id'=>$v['member_id']));?>','','510')"><?php echo ($v["role_name"]); ?></a>
					<?php else: ?>
						<?php echo ($v["role_name"]); endif; ?>
				</td>
				<td><?php echo ($v["member_time"]); ?></td>
				<td class="td-manage">
					<!-- edit -->
					<a title="编辑" 
						href="<?php echo U('Member/member_mod',array('member_id'=>$v['member_id']));?>" 
						class="ml-5" style="text-decoration:none">
						<i class="Hui-iconfont">&#xe6df;</i>
					</a>&nbsp;&nbsp;
					<!-- delete -->
					<a style="text-decoration:none" class="ml-5" 
						onClick="del(this,<?php echo ($v['member_id']); ?>)" 
						href="javascript:;" title="删除">
						<i class="Hui-iconfont">&#xe6e2;</i>
					</a>
				</td>
			</tr><?php endforeach; endif; ?>
			<tr><td colspan=13 style="text-align:center;"><?php echo ($member["link"]); ?></td></tr>
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

<!-- common -->
<script src="/zhiyan/business_admin/Public/zhiyan/common/common.js"></script>
<script src="/zhiyan/business_admin/Public/lib/My97DatePicker/WdatePicker.js"></script> 

<script>
/*
 * 绑定关系
 * xiami
 * 2018-04-03
*/
function member_parent(title,url,w,h){
	layer_show(title,url,w,h);
}

var page_url = {
    'save_del' : "<?php echo U('Member/member_del');?>",
    'list_url' : "<?php echo U('Member/member_list');?>",
}
</script>