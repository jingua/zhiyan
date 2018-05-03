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
<header class="navbar-wrapper">
	<div class="navbar navbar-fixed-top">
		<div class="container-fluid cl"> 
		<a class="logo navbar-logo f-l mr-10 hidden-xs" href="javascript:;">管理后台--知妍文化传播</a> 
		<a aria-hidden="false" class="nav-toggle Hui-iconfont visible-xs" href="javascript:;">&#xe667;</a>
			<nav id="Hui-userbar" class="nav navbar-nav navbar-userbar hidden-xs">
				<ul class="cl">
					<li>管理员</li>
					<li class="dropDown dropDown_hover"> 
					<a href="#" class="dropDown_A"> <?php echo ($_SESSION['admin']['member_name']); ?>
					<i class="Hui-iconfont">&#xe6d5;</i></a>
						<ul class="dropDown-menu menu radius box-shadow">
							<li><a href="<?php echo U('Index/logout');?>">退出</a></li>
						</ul>
					</li>
					<li id="Hui-msg"> <a href="#" title="消息">
					<i class="Hui-iconfont" style="font-size:18px">&#xe68a;</i></a> </li>
					<li id="Hui-skin" class="dropDown right dropDown_hover"> 
					<a href="javascript:;" class="dropDown_A" title="换肤">
					<i class="Hui-iconfont" style="font-size:18px">&#xe62a;</i></a>
					<ul class="dropDown-menu menu radius box-shadow">
						<li><a href="javascript:;" data-val="default" title="默认（黑色）">默认（黑色）</a></li>
						<li><a href="javascript:;" data-val="blue" title="蓝色">蓝色</a></li>
						<li><a href="javascript:;" data-val="green" title="绿色">绿色</a></li>
						<li><a href="javascript:;" data-val="red" title="红色">红色</a></li>
						<li><a href="javascript:;" data-val="yellow" title="黄色">黄色</a></li>
						<li><a href="javascript:;" data-val="orange" title="绿色">橙色</a></li>
					</ul>
					</li>
				</ul>
			</nav>
		</div>
	</div>
</header>
<aside class="Hui-aside">
	<input runat="server" id="divScrollValue" type="hidden" value="" />
	<div class="menu_dropdown bk_2">

		<dl id="menu-tongji">
			<dt>
				<i class="Hui-iconfont">&#xe613;</i> 个人管理
				<i class="Hui-iconfont menu_dropdown-arrow">&#xe6d5;</i>
			</dt>
			<dd>
				<ul>
					<li><a _href="<?php echo U('Member/member_pass');?>" data-title="个人设置" 
					href="javascript:void(0)">个人设置</a></li>
				</ul>
			</dd>
		</dl>

		<dl id="menu-tongji">
			<dt>
				<i class="Hui-iconfont">&#xe613;</i> 成员列表
				<i class="Hui-iconfont menu_dropdown-arrow">&#xe6d5;</i>
			</dt>
			<dd>
				<ul>
					<li><a _href="<?php echo U('Member/member_list');?>" data-title="成员列表" 
					href="javascript:void(0)">成员列表</a></li>
					<li><a _href="<?php echo U('Member/chief_add');?>" data-title="总监管理" 
					href="javascript:void(0)">总监管理</a></li>

				</ul>
			</dd>
		</dl>

		<dl id="menu-tongji">
			<dt>
				<i class="Hui-iconfont">&#xe622;</i> 业绩考核
				<i class="Hui-iconfont menu_dropdown-arrow">&#xe6d5;</i>
			</dt>
			<dd>
				<ul>
					<li><a _href="<?php echo U('Member/business_member');?>" data-title="业绩考核" 
					href="javascript:void(0)">业绩考核</a></li>
				</ul>
			</dd>
		</dl>

		<dl id="menu-tongji">
			<dt>
				<i class="Hui-iconfont">&#xe613;</i> 渠道管理
				<i class="Hui-iconfont menu_dropdown-arrow">&#xe6d5;</i>
			</dt>
			<dd>
				<ul>
					<li><a _href="<?php echo U('Channel/channel_list');?>" data-title="渠道列表" 
					href="javascript:void(0)">渠道列表</a></li>
					<li><a _href="<?php echo U('Channel/type_list');?>" data-title="类型列表" 
					href="javascript:void(0)">类型列表</a></li>
				</ul>
			</dd>
		</dl>

		<dl id="menu-tongji">
			<dt>
				<i class="Hui-iconfont">&#xe61a;</i> 客户管理
				<i class="Hui-iconfont menu_dropdown-arrow">&#xe6d5;</i>
			</dt>
			<dd>
				<ul>
					<li><a _href="<?php echo U('Customer/customer_list');?>" data-title="客户列表" 
					href="javascript:void(0)">客户列表</a></li>

				</ul>
			</dd>
		</dl>

		<dl id="menu-system">
			<dt>
			<i class="Hui-iconfont">&#xe62e;</i> 业务管理
			<i class="Hui-iconfont menu_dropdown-arrow">&#xe6d5;</i>
			</dt>
			<dd>
				<ul>

					<li><a _href="<?php echo U('Business/business_list');?>" data-title="业务列表" 
					href="javascript:void(0)">业务列表</a></li>

					<li><a _href="<?php echo U('Business/sign_list');?>" data-title="签约列表" 
					href="javascript:void(0)">签约列表</a></li>
					
				</ul>
			</dd>
		</dl>

			<dl id="menu-tongji">
			<dt>
				<i class="Hui-iconfont">&#xe61a;</i> 合同管理
				<i class="Hui-iconfont menu_dropdown-arrow">&#xe6d5;</i>
			</dt>
			<dd>
				<ul>

					<li><a _href="<?php echo U('Contract/contract_list');?>" data-title="合同列表" 
					href="javascript:void(0)">合同列表</a></li>

				</ul>
			</dd>
		</dl>

		<dl id="menu-tongji">
			<dt>
				<i class="Hui-iconfont">&#xe61a;</i> 公司盈利
				<i class="Hui-iconfont menu_dropdown-arrow">&#xe6d5;</i>
			</dt>
			<dd>
				<ul>

					<li><a _href="<?php echo U('Property/property_money');?>" data-title="公司盈利" 
					href="javascript:void(0)">公司盈利</a></li>

				</ul>
			</dd>
		</dl>

		<dl id="menu-system">
			<dt>
			<i class="Hui-iconfont">&#xe62e;</i> 审核管理
			<i class="Hui-iconfont menu_dropdown-arrow">&#xe6d5;</i>
			</dt>
			<dd>
				<ul>

					<li><a _href="<?php echo U('Property/property_list');?>" data-title="审核列表" 
					href="javascript:void(0)">审核列表</a></li>
					
				</ul>
			</dd>
		</dl>

		<dl id="menu-article">
			<dt>
				<i class="Hui-iconfont">&#xe616;</i> 权限管理
				<i class="Hui-iconfont menu_dropdown-arrow">&#xe6d5;</i>
			</dt>
			<dd>
				<ul>

					<li><a _href="<?php echo U('Node/role_list');?>" data-title="角色列表" 
					href="javascript:void(0)">角色列表</a></li>

					<li><a _href="<?php echo U('Node/node_list');?>" data-title="节点列表" 
					href="javascript:void(0)">节点列表</a></li>

				</ul>
			</dd>
		</dl>

		<dl id="menu-system">
			<dt>
			<i class="Hui-iconfont">&#xe62e;</i> 系统设置
			<i class="Hui-iconfont menu_dropdown-arrow">&#xe6d5;</i>
			</dt>
			<dd>
				<ul>

					<li><a _href="<?php echo U('Log/set');?>" data-title="系统设置" 
					href="javascript:void(0)">系统设置</a></li>

					<!-- <li><a _href="<?php echo U('Position/position_list');?>" data-title="职位列表" 
					href="javascript:void(0)">职位列表</a></li> -->

					<li><a _href="<?php echo U('Payment/pay_list');?>" data-title="支付方式列表" 
					href="javascript:void(0)">支付方式列表</a></li>

					<li><a _href="<?php echo U('Log/log_list');?>" data-title="系统日志" 
					href="javascript:void(0)">系统日志</a></li>

					<!-- <li><a _href="<?php echo U('Log/moban-01');?>" data-title="系统模板1" 
					href="javascript:void(0)">系统模板1</a></li>
					
					<li><a _href="<?php echo U('Log/moban-02');?>" data-title="系统模板2" 
					href="javascript:void(0)">系统模板2</a></li> -->
					
				</ul>
			</dd>
		</dl>

	</div>
</aside>
<div class="dislpayArrow hidden-xs"><a class="pngfix" href="javascript:void(0);" 
onClick="displaynavbar(this)"></a></div>
<section class="Hui-article-box">
	<div id="Hui-tabNav" class="Hui-tabNav hidden-xs">
		<div class="Hui-tabNav-wp">
			<ul id="min_title_list" class="acrossTab cl">
				<li class="active"><span title="我的桌面" data-href="welcome.html">我的桌面</span><em></em></li>
			</ul>
		</div>
		<div class="Hui-tabNav-more btn-group"><a id="js-tabNav-prev" class="btn radius btn-default size-S" href="javascript:;"><i class="Hui-iconfont">&#xe6d4;</i></a><a id="js-tabNav-next" class="btn radius btn-default size-S" href="javascript:;"><i class="Hui-iconfont">&#xe6d7;</i></a></div>
	</div>
	<div id="iframe_box" class="Hui-article">
		<div class="show_iframe">
			<div style="display:none" class="loading"></div>
			<iframe scrolling="yes" frameborder="0" src="<?php echo U('Index/welcome');?>"></iframe>
		</div>
	</div>
</section>
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