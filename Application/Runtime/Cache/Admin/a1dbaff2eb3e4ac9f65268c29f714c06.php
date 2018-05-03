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
	<span class="c-gray en">&gt;</span> 合同管理 
	<span class="c-gray en">&gt;</span> 合同列表 
	<!-- 刷新 -->
	<a class="btn btn-success radius r" 
		style="line-height:1.6em;margin-top:3px" 
		href="javascript:location.replace(location.href);" title="刷新" >
		<i class="Hui-iconfont">&#xe68f;</i>
	</a>
</nav>
<!-- content -->
<div class="page-container" style="margin-top:-30px;">
	<div class="cl pd-5 bg-1 bk-gray mt-20" style="margin-top:20px;"> 
		<span class="l">
			<a href="javascript:;" class="btn btn-success more_coupon">合同列表</a>
		</span> 
		<span class="r" style="line-height:30px;">
			共有数据&nbsp;&nbsp;
			<strong><?php echo ($contract["total"]); ?></strong>&nbsp;&nbsp;条
		</span> 
	</div>
	<div class="mt-20" style="margin-top:10px;">
	<table class="table table-border table-bordered table-hover table-bg table-sort">
		<thead>
			<tr class="text-c">
				<th>ID</th>
				<th>合伙人</th>
				<th>联系电话</th>
				<th>日期</th>
				<th>查看合同</th>
				<th>重新上传</th>
				<th>操作</th>
			</tr>
		</thead> 
		<tbody id="ks_user">
			<?php if(is_array($contract["contract"])): foreach($contract["contract"] as $key=>$v): ?><tr class="text-c">
				<td><?php echo ($v["contract_id"]); ?></td>
				<td><?php echo ($v["contract_name"]); ?></td>
				<td><?php echo ($v["contract_tel"]); ?></td>
				<td><?php echo ($v["contract_create"]); ?></td>
				<td>
					<a href="<?php echo ($v['contract_dir']); ?>" target="_blank"><span class="label label-success radius">查看合同</span></a>
				</td>
				<td>
					<a href="javascript:;" onclick="business_recontract('重新上传合同','<?php echo U('Business/business_recontract',array('id'=>$v['business_id']));?>','','510')">
					 <span class="label label-success radius">重新上传合同</span></a>
				</td>
				<td class="td-manage">
					<!-- delete -->
					<a style="text-decoration:none" class="ml-5" 
						onClick="del(this,<?php echo ($v['contract_id']); ?>)" href="javascript:;" title="删除">
						<i class="Hui-iconfont">&#xe6e2;</i>
					</a>
				</td>
			</tr><?php endforeach; endif; ?>
			<tr><td colspan=16 style="text-align:center;"><?php echo ($contract["link"]); ?></td></tr>
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
    'save_del' : "<?php echo U('Contract/contract_del');?>",
    'list_url' : "<?php echo U('Contract/contract_list');?>",
}

/*
 * 重新上传合同
 * xiami
 * 2018-03-29
*/
function business_recontract(title,url,w,h){
	layer_show(title,url,w,h);
}

</script>