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
	<span class="c-gray en">&gt;</span> 渠道管理 
	<span class="c-gray en">&gt;</span> 渠道列表 
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
		<form action="<?php echo U('Channel/channel_list');?>" method="post">
		<!-- text -->
		<input type="text" class="input-text" value="<?php echo ($channel["channel_name"]); ?>"
		style="width:120px" name="channel_name" placeholder="渠道名称" />
		<!-- text -->
		<input type="text" class="input-text" value="<?php echo ($channel["channel_wechat"]); ?>"
		style="width:120px" name="channel_wechat" placeholder="渠道微信号" />
		<!-- select -->
		<span class="select-box" style="width:120px;">
			<select name="province" id="province" onchange="getcity()" class="form-control select">
                <option value="-1">请选择省份</option>
                <?php if(is_array($provice)): foreach($provice as $key=>$value): ?><option value="<?php echo ($value["id"]); ?>" <?php if(($value["id"]) == $channel["province_id"]): ?>selected<?php endif; ?>>
                        <?php echo ($value["province"]); ?>
                    </option><?php endforeach; endif; ?>
            </select>
		</span> 
		<!-- select -->
		<span class="select-box" style="width:120px;">
			 <select name="city" id="city" onchange="getblock()" 
            class="form-control select">
            </select>
		</span> 
		<!-- select -->
		<span class="select-box" style="width:120px;">
			 <select name="district" id="district" 
             class="form-control select">
            </select>
		</span> 
		<!-- select -->
		<span class="select-box" style="width:120px;">
			<select name="type_id" class="select">
				<option value="">请选择类型</option>
				<?php if(is_array($type)): foreach($type as $key=>$v): ?><option value="<?php echo ($v["type_id"]); ?>" 
				<?php if(($v["type_id"]) == $channel["type_id"]): ?>selected<?php endif; ?>>
				<?php echo ($v["type_name"]); ?></option><?php endforeach; endif; ?>
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
			<a href="javascript:;" onclick="datadel()" class="btn btn-success more_coupon">
			选择添加渠道</a>
		</span> 
		<!-- total -->
		<span class="r" style="line-height:30px;">
			共有数据&nbsp;&nbsp;
			<strong><?php echo ($channel["total"]); ?></strong>&nbsp;&nbsp;条
		</span> 
	</div>
	<div class="mt-20" style="margin-top:10px;">
	<table class="table table-border table-bordered table-hover table-bg table-sort">
		<thead>
			<tr class="text-c">
				<th width="60"><!-- <input type="radio" name="" value=""> -->单选按钮</th>
				<th>ID</th>
				<th>渠道名称</th>
				<th>渠道微信号</th>
				<th>粉丝数量</th>
				<th>省市区</th>
			</tr>
		</thead> 
		<tbody id="ks_user">
			<?php if(is_array($channel["channel"])): foreach($channel["channel"] as $key=>$v): ?><tr class="text-c">
				<td>
					<input type="radio" value="<?php echo ($v["channel_id"]); ?>" name="dataid" 
					id="dataid" _id="<?php echo ($v["channel_id"]); ?>">
				</td>
				<td><?php echo ($v["channel_id"]); ?></td>
				<td><?php echo ($v["channel_name"]); ?></td>
				<td><?php echo ($v["channel_wechat"]); ?></td>
				<td><?php echo ($v["channel_fans"]); ?></td>
				<td><?php echo ($v["province"]); ?> <?php echo ($v["city"]); ?> <?php echo ($v["area"]); ?></td>
			</tr><?php endforeach; endif; ?>
			<tr><td colspan=15 style="text-align:center;"><?php echo ($channel["link"]); ?></td></tr>
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
/* delete more */
function datadel(){
	var arr = [];
	$("input[name=dataid]:checked").each(function(){
		arr.push($(this).attr("_id"));
	});
	if(arr.length == 0){
		layer.alert("请选择要添加的渠道",{time:1000,icon:2});return false;
	}
	var id = arr.join(",");
	window.location.href="/zhiyan/business_admin/index.php?s=/Admin/Business/business_add.html/&id=" + id;
}

/* 省市区 */
window.onload = function(){
    var city = <?php echo ($city); ?>;
    var block = <?php echo ($block); ?>;
    getcity();
    getblock();
}

/* 省市区 */
function getcity(){
    var citys = <?php echo ($city); ?>;
    var province = $('#province').val();
    var city = $('#province').find("option:selected").text();
    $("#city").html("");
    $("#district").html("")
    $("#city").append("<option value='"+'-1'+"'>"+'请选择城市'+"</option>");
     $("#district").append("<option value='"+'-1'+"'>"+'请选择区域'+"</option>");
    $.post(
        "<?php echo U('Channel/getcity');?>", { province:province },
        function (res){
          res = JSON.parse(res);
          for (var i = 0; i <= res.length-1; i++) {
              if (res[i]['province'] != res[i]['city']){
                  if (res[i]['id'] == citys){
                    $("#city").append("<option value='"+res[i]['id']+"' selected='selected'>"
                      +res[i]['city']+"</option>");
                  }else{
                    $("#city").append("<option value='"+res[i]['id']+"'>"
                      +res[i]['city']+"</option>");
                  }
              }else{
                  if(province == citys){
                      $("#city").append("<option value='"+province+"' selected='selected'>"+city+"</option>");
                  }else{
                      $("#city").append("<option value='"+province+"'>"+city+"</option>");
                  }
                  break;
              }
          }
        }
    );
    return true;
}

/* 省市区 */
function getblock(){
    var block = <?php echo ($block); ?>;
    var citys = <?php echo ($city); ?>;
    if (citys != '-1'){
        if ($("#city").val() != '-1'){
            city = $("#city").val();
        }else{
            var city = citys;
        }
    }else{
        var city = $('#city').val();
    }
    $("#district").html("");
    $("#district").append("<option value='"+'-1'+"'>"+'请选择区域'+"</option>");
    $.post(
        "<?php echo U('Channel/getblock');?>",
        { city:city },
        function (res){
            res = JSON.parse(res);
            for (var j = 0; j <= res.length-1; j++) {
                if (res[j]['id'] == block){
                    $("#district").append("<option value='"+res[j]['id']
                      +"' selected='selected'>"+res[j]['district']+"</option>");
                }else{
                $("#district").append("<option value='"+res[j]['id']+"'>"+res[j]['district']+"</option>");
                }
            }
        }
    );
}
</script>