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
<nav class="breadcrumb"><i class="Hui-iconfont">&#xe67f;</i> 首页 
  	<span class="c-gray en">&gt;</span> 渠道管理
  	<span class="c-gray en">&gt;</span> 渠道添加
    <!-- 返回 -->
    <span class="c-gray en" 
        onClick="history.go(-1);" style="cursor:pointer;">&gt;&nbsp;&nbsp;返回
    </span>
    <!-- 刷新 -->
  	<a class="btn btn-success radius r" style="line-height:1.6em;margin-top:3px" 
  	href="javascript:location.replace(location.href);" title="刷新" >
  	<i class="Hui-iconfont">&#xe68f;</i></a>
</nav>
<!-- content -->
<div class="page-container">
	<form method="post" class="form form-horizontal" action="#" 
    id="form-article-add" enctype="multipart/form-data">

      <!-- text -->
  		<div class="row cl">
  			<label class="form-label col-xs-4 col-sm-2" style="width:160px;">渠道微信号</label>
  			<div class="formControls col-xs-8 col-sm-9">
  				<input type="text" class="input-text" value="<?php echo ($channel["channel_wechat"]); ?>" placeholder="请输入渠道微信号" 
  				id="channel_wechat" name="channel_wechat">
  			</div>
  		</div>

        <!-- text -->
      <div class="row cl">
        <label class="form-label col-xs-4 col-sm-2" style="width:160px;">渠道名称</label>
        <div class="formControls col-xs-8 col-sm-9">
          <input type="text" class="input-text" value="<?php echo ($channel["channel_name"]); ?>" placeholder="请输入渠道名称" 
          id="channel_name" name="channel_name">
        </div>
      </div>

      <!-- select -->
      <div class="row cl">
            <label class="form-label col-xs-4 col-sm-2" style="width:160px;">类型</label>
            <div class="formControls col-xs-8 col-sm-9"> 
                <span class="select-box">
                    <select name="type_id" id="type_id" class="select">
                        <?php if(is_array($type)): $i = 0; $__LIST__ = $type;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;?><option value="<?php echo ($v["type_id"]); ?>" <?php if(($v["type_id"]) == $channel["type_id"]): ?>selected<?php endif; ?>><?php echo ($v["type_name"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
                    </select>
                </span> 
            </div>
        </div>

      <!-- text -->
      <div class="row cl">
        <label class="form-label col-xs-4 col-sm-2" style="width:160px;">粉丝数量</label>
        <div class="formControls col-xs-8 col-sm-9">
          <input type="text" class="input-text" value="<?php echo ($channel["channel_fans"]); ?>" placeholder="请输入粉丝数量" 
          id="channel_fans" name="channel_fans">
        </div>
      </div>

      <!-- text -->
      <div class="row cl">
        <label class="form-label col-xs-4 col-sm-2" style="width:160px;">头条价格</label>
        <div class="formControls col-xs-8 col-sm-9">
          <input type="text" class="input-text" value="<?php echo ($channel["price_first"]); ?>" placeholder="请输入头条价格" 
          id="price_first" name="price_first">
        </div>
      </div>

      <!-- text -->
      <div class="row cl">
        <label class="form-label col-xs-4 col-sm-2" style="width:160px;">次条价格</label>
        <div class="formControls col-xs-8 col-sm-9">
          <input type="text" class="input-text" value="<?php echo ($channel["price_end"]); ?>" placeholder="请输入次条价格" 
          id="price_end" name="price_end">
        </div>
      </div>

      <!-- text -->
      <div class="row cl">
        <label class="form-label col-xs-4 col-sm-2" style="width:160px;">省市区</label>
        <div class="formControls col-xs-8 col-sm-9">
          <!-- select -->
          <span class="select-box" style="width:160px;">

            <select name="province" id="province" onchange="getcity()" class="form-control select">
                <option value="-1">请选择省份</option>
                <?php if(is_array($provice)): foreach($provice as $key=>$value): ?><option value="<?php echo ($value["id"]); ?>" <?php if(($value["id"]) == $channel["province_id"]): ?>selected<?php endif; ?>>
                        <?php echo ($value["province"]); ?>
                    </option><?php endforeach; endif; ?>
            </select>

          </span> 
          <!-- select -->
          <span class="select-box" style="width:160px;">
            <select name="city" id="city" onchange="getblock()" 
            class="form-control select">
            </select>
          </span>
          <!-- select -->
          <span class="select-box" style="width:160px;">
            <select name="district" id="district" 
             class="form-control select">
            </select>
          </span>
        </div>
      </div>

      <!-- text -->
      <div class="row cl">
        <label class="form-label col-xs-4 col-sm-2" style="width:160px;">头条阅读量</label>
        <div class="formControls col-xs-8 col-sm-9">
          <input type="text" class="input-text" value="<?php echo ($channel["channel_read_first"]); ?>" placeholder="请输入头条阅读量" 
          id="channel_read_first" name="channel_read_first">
        </div>
      </div>

      <!-- text -->
      <div class="row cl">
        <label class="form-label col-xs-4 col-sm-2" style="width:160px;">次条阅读量</label>
        <div class="formControls col-xs-8 col-sm-9">
          <input type="text" class="input-text" value="<?php echo ($channel["channel_read_end"]); ?>" placeholder="请输入次条阅读量" 
          id="channel_read_end" name="channel_read_end">
        </div>
      </div>

      <!--textarea-->
      <div class="row cl">
          <label class="form-label col-xs-4 col-sm-2" style="width:160px;">渠道描述</label>
          <div class="formControls col-xs-8 col-sm-9"> 
              <textarea name="channel_descr" id="channel_descr" style="height:280px;"><?php echo ($channel["channel_descr"]); ?></textarea>
              <input type="hidden" name="channel_id" value="<?php echo ($channel["channel_id"]); ?>">
          </div>
      </div>

      <!-- button -->
       <div class="row cl">
          <label class="form-label col-xs-4 col-sm-2" style="width:160px;"></label>
          <div class="formControls col-xs-8 col-sm-9">
          <button class="btn btn-primary radius btn_submit" type="button">
              <i class="Hui-iconfont">&#xe632;</i> 保存并提交
          </button>
          <button 
              onClick="history.go(-1);" class="btn btn-default radius" type="button">&nbsp;返回&nbsp;
          </button>
          </div>
      </div>
	</form>
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

<!-- common -->
<script src="/zhiyan/tp32/Public/zhiyan/common/common.js"></script>
<script src="/zhiyan/tp32/Public/lib/ue/ueditor.config.js"></script>
<script src="/zhiyan/tp32/Public/lib/ue/ueditor.all.min.js"></script>

<script>

var ue = UE.getEditor("channel_descr");

/* 省市区 */
window.onload = function(){
    var city = <?php echo ($city); ?>;
    var block = <?php echo ($block); ?>;
    getcity();
    getblock();
}

var page_url = {
    'save_url' : "<?php echo U('Channel/channel_mod_save');?>",
    'list_url' : "<?php echo U('Channel/channel_list');?>",
}

/* 省市区 */
function getcity(){
    var citys = <?php echo ($channel["city_id"]); ?>;
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
    var block = <?php echo ($channel["area_id"]); ?>;
    var citys = <?php echo ($channel["city_id"]); ?>;
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