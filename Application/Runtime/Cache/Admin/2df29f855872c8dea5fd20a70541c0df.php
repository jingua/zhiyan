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
    <span class="c-gray en">&gt;</span> 公司盈利 
    <span class="c-gray en">&gt;</span> 公司盈利统计 
    <a class="btn btn-success radius r" style="line-height:1.6em;margin-top:3px" 
    href="javascript:location.replace(location.href);" title="刷新" >
    <i class="Hui-iconfont">&#xe68f;</i></a>
</nav>
<!-- content -->
<div class="page-container" style="margin:0px 40px;">

<h1 style="font-size:15px;">月份绩效</h1>
<div id="graph" style="width:1200px;"></div>
<div id="code" class="prettyprint linenums"></div>  

<h1 style="font-size:15px;"><?php echo ($month); ?>月份支出和利润比例</h1>
<div id="morris-donut-chart" style="width:1200px;"></div>
<div style="width:1200px;height:2px;background-color:#ccc;margin-top:30px;"></div>

<h1 style="font-size:15px;">年度利润支出走势</h1>
<div id="graphs" style="width:1200px;"></div>
<div id="codes" class="prettyprint linenums"></div>     

</div>

  <script src="/zhiyan/business_admin/Public/lib/jquery/1.9.1/jquery.min.js"></script> 
  <script src="/zhiyan/business_admin/Public/lib/morris/raphael-2.1.0.min.js"></script>
  <script src="/zhiyan/business_admin/Public/lib/morris/morris.js"></script>
  <link rel="stylesheet" href="/zhiyan/business_admin/Public/lib/morris/morris.css">


<script>

Morris.Bar({
  element: 'graph',
  data: [
    <?php
 for($i = 1;$i <= 12;$i++){ $total = $data[$i]['total']; $come = $data[$i]['come']; if($total == ''){ $total = '0'; } if($come == ''){ $come = '0'; } echo "{x:'$i'+'月份',y:'$total',z:'$come'},"; } ?>
  ],
  xkey: 'x',
  ykeys: ['y', 'z'],
  labels: ['总收入', '未收款'],
  barColors: [
    '#A6A6A6','#F09B22',
    '#A8E9DC' 
  ],
    hideHover: 'auto',
    resize: true
});


 Morris.Donut({
    element: 'morris-donut-chart',
    data: [{
        label: "支出\n<?php echo ($intos); ?>%",
        value: "<?php echo ($into); ?>"
    }, {
        label: "利润\n<?php echo ($comes); ?>%",
        value: "<?php echo ($pro2); ?>"
    }],
    colors: [
        '#A6A6A6','#F09B22',
        '#A8E9DC' 
    ],
    resize: true
});


Morris.Bar({
  element: 'graphs',
  data: [
    <?php
 for($i = 1;$i <= 12;$i++){ $total = $data[$i]['total']; $totals = $arr2[$i]['totals']; $arr = $total-$totals; if($totals == ''){ $totals = '0'; } if($arr == ''){ $arr = '0'; } echo "{x:'$i'+'月份',y:'$arr',z:'$totals'},"; } ?>
  ],
  xkey: 'x',
  ykeys: ['y', 'z'],
  labels: ['利润', '支出'],
  barColors: [
    '#A6A6A6','#F09B22',
    '#A8E9DC' 
  ],
    hideHover: 'auto',
    resize: true
});

</script>
</body>
</html>