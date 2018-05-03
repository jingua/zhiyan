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
	<span class="c-gray en">&gt;</span> 分配权限 
	<!-- 刷新 -->
	<a class="btn btn-success radius r" 
		style="line-height:1.6em;margin-top:3px" 
		href="javascript:location.replace(location.href);" title="刷新" >
		<i class="Hui-iconfont">&#xe68f;</i>
	</a>
</nav>
<!-- content -->
<div class="page-container">
	<form class="form form-horizontal" id="form-article-add" method="post" enctype="multipart/form-data">
		<!-- text -->
		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-2" style="width:150px;">角色名称</label>
			<div class="formControls col-xs-8 col-sm-9">
				<input type="text" class="input-text" value="<?php echo ($role["role_name"]); ?>" placeholder="" 
				id="role_name" name="role_name" disabled="disabled">
				<input type="hidden" name="role_id" value="<?php echo ($role["role_id"]); ?>">
			</div>
		</div>
		<!-- checkbox -->
		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-3" style="width:150px;">分配权限</label>
			<div class="formControls col-xs-8 col-sm-9">
				<?php if(is_array($actions["node"])): foreach($actions["node"] as $key=>$vo): ?><dl class="permission-list">
					<dt>
					<?php if(in_array($vo['node_id'],$node)): ?><label>
							<input type="checkbox" value="<?php echo ($vo["node_id"]); ?>" name="node_id[]"  id="user-Character-0" 
							checked="checked" class="node_role">
							<?php echo ($vo["node_descr"]); ?>
						</label>
					<?php else: ?>
						<label>
							<input type="checkbox" value="<?php echo ($vo["node_id"]); ?>" name="node_id[]" id="user-Character-0" 
							class="node_role">
							<?php echo ($vo["node_descr"]); ?>
						</label><?php endif; ?>		
					</dt>
					<dd>
					<dl>	
					<?php if(is_array($vo['actions'])): foreach($vo['actions'] as $key=>$v): if(in_array($v['node_id'],$node)): ?><label class="role_node_check">
								<input type="checkbox" class="node_role_item" value="<?php echo ($v["node_id"]); ?>" name="node_id[]" 
								id="user-Character-0-0-0" checked="checked">
								<?php echo ($v["node_descr"]); ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
							</label>
						<?php else: ?>
							<label class="role_node_check">
								<input type="checkbox" class="node_role_item" value="<?php echo ($v["node_id"]); ?>" name="node_id[]" 
								id="user-Character-0-0-0">
								<?php echo ($v["node_descr"]); ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
							</label><?php endif; endforeach; endif; ?>		
					</dl>
					</dd>
				</dl><?php endforeach; endif; ?>
			</div>
		</div>
		<!-- button -->
        <div class="row cl">
            <label class="form-label col-xs-4 col-sm-2" style="width:160px;"></label>
            <div class="formControls col-xs-8 col-sm-9">
                <button class="btn btn-primary radius btn_submit" type="button">
                <i class="Hui-iconfont">&#xe632;</i> 保存并提交</button>
                <button onClick="history.go(-1);" class="btn btn-default radius" type="button">&nbsp;返回&nbsp;</button>
            </div>
        </div>
	</form>
</article>
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

<script>

/**
 * 单选复选按钮选择验证
 * xiami
 * 2018-03-27
*/
$(document).on("click",".node_role",function(){
    if($(this).is(':checked')){
        $(this).closest(".permission-list").find(".node_role_item").each(function(index,ele){
            ele.checked = true;
        })
    }else{
        $(this).closest(".permission-list").find(".node_role_item").each(function(index,ele){
            ele.checked = false;
        })  
    }
})


$("select").focus();
var page_url = {
    'save_url' : "<?php echo U('Node/role_node_save');?>",
    'list_url' : "<?php echo U('Node/node_user',array('role_id'=>$role['role_id']));?>",
}
</script>