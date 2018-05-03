
//按钮皮肤设置
$(function(){
	$('.skin-minimal input').iCheck({
		checkboxClass: 'icheckbox-blank',
		radioClass: 'icheckbox-blank',
		increaseArea: '20%'
	});
	$.Huitab("#tab-system .tabBar span","#tab-system .tabCon","current","click","0");
});

//起床时间设置
$("#life1").click(function(){
   var s1_s_time = $("#s11_s_time").val();
   var s1_e_time = $("#s11_e_time").val();
   layer.confirm('确认要设置时间吗 ？？？',function(index){
    $.ajax({
        type: "post",
        url: page_url.save_url,
        data: {"s1_s_time":s1_s_time,"s1_e_time":s1_e_time},
        dataType:"json",
        success:function(data){
            if(data==200){
                layer.alert(data.info,{time:1000});
                setInterval(function(){ location.href=page_url.list_url; },1000);
            }else{
                layer.alert(data.info,{time:1000});
                setInterval(function(){ location.href=page_url.list_url; },1000);
            }
        }
    })
  })
})

//早饭时间设置
$("#life2").click(function(){
   var s2_s_time = $("#s22_s_time").val();
   var s2_e_time = $("#s22_e_time").val();
   layer.confirm('确认要设置时间吗 ？？？',function(index){
    $.ajax({
        type: "post",
        url: page_url.save_url,
        data: {"s2_s_time":s2_s_time,"s2_e_time":s2_e_time},
        dataType:"json",
        success:function(data){
            if(data==200){
                layer.alert(data.info,{time:1000});
                setInterval(function(){ location.href=page_url.list_url; },1000);
            }else{
                layer.alert(data.info,{time:1000});
                setInterval(function(){ location.href=page_url.list_url; },1000);
            }
        }
    })
  })
})

//午饭时间设置
$("#life3").click(function(){
   var s3_s_time = $("#s33_s_time").val();
   var s3_e_time = $("#s33_e_time").val();
   layer.confirm('确认要设置时间吗 ？？？',function(index){
    $.ajax({
        type: "post",
        url: page_url.save_url,
        data: {"s3_s_time":s3_s_time,"s3_e_time":s3_e_time},
        dataType:"json",
        success:function(data){
            if(data==200){
                layer.alert(data.info,{time:1000});
                setInterval(function(){ location.href=page_url.list_url; },1000);
            }else{
                layer.alert(data.info,{time:1000});
                setInterval(function(){ location.href=page_url.list_url; },1000);
            }
        }
    })
  })
})

//晚饭时间设置
$("#life4").click(function(){
   var s4_s_time = $("#s44_s_time").val();
   var s4_e_time = $("#s44_e_time").val();
   layer.confirm('确认要设置时间吗 ？？？',function(index){
    $.ajax({
        type: "post",
        url: page_url.save_url,
        data: {"s4_s_time":s4_s_time,"s4_e_time":s4_e_time},
        dataType:"json",
        success:function(data){
            if(data==200){
                layer.alert(data.info,{time:1000});
                setInterval(function(){ location.href=page_url.list_url; },1000);
            }else{
                layer.alert(data.info,{time:1000});
                setInterval(function(){ location.href=page_url.list_url; },1000);
            }
        }
    })
  })
})

//时间设置
$("#life5").click(function(){
   var s5_s_time = $("#s55_s_time").val();
   var s5_e_time = $("#s55_e_time").val();
   layer.confirm('确认要设置时间吗 ？？？',function(index){
    $.ajax({
        type: "post",
        url: page_url.save_url,
        data: {"s5_s_time":s5_s_time,"s5_e_time":s5_e_time},
        dataType:"json",
        success:function(data){
            if(data==200){
                layer.alert(data.info,{time:1000});
                setInterval(function(){ location.href=page_url.list_url; },1000);
            }else{
                layer.alert(data.info,{time:1000});
                setInterval(function(){ location.href=page_url.list_url; },1000);
            }
        }
    })
  })
})

  

//时间设置
$("#work1").click(function(){
   var s1_s_time = $("#s1_s_time").val();
   var s1_e_time = $("#s1_e_time").val();
   layer.confirm('确认要设置时间吗 ？？？',function(index){
    $.ajax({
        type: "post",
        url: page_url.save_work,
        data: {"s1_s_time":s1_s_time,"s1_e_time":s1_e_time},
        dataType:"json",
        success:function(data){
            if(data==200){
                layer.alert(data.info,{time:1000});
                setInterval(function(){ location.href=page_url.list_url; },1000);
            }else{
                layer.alert(data.info,{time:1000});
                setInterval(function(){ location.href=page_url.list_url; },1000);
            }
        }
    })
  })
})

//时间设置
$("#work2").click(function(){
   var s2_s_time = $("#s2_s_time").val();
   var s2_e_time = $("#s2_e_time").val();
   layer.confirm('确认要设置时间吗 ？？？',function(index){
    $.ajax({
        type: "post",
        url: page_url.save_work,
        data: {"s2_s_time":s2_s_time,"s2_e_time":s2_e_time},
        dataType:"json",
        success:function(data){
            if(data==200){
                layer.alert(data.info,{time:1000});
                setInterval(function(){ location.href=page_url.list_url; },1000);
            }else{
                layer.alert(data.info,{time:1000});
                setInterval(function(){ location.href=page_url.list_url; },1000);
            }
        }
    })
  })
})

//时间设置
$("#work3").click(function(){
   var s3_s_time = $("#s3_s_time").val();
   var s3_e_time = $("#s3_e_time").val();
   layer.confirm('确认要设置时间吗 ？？？',function(index){
    $.ajax({
        type: "post",
        url: page_url.save_work,
        data: {"s3_s_time":s3_s_time,"s3_e_time":s3_e_time},
        dataType:"json",
        success:function(data){
            if(data==200){
                layer.alert(data.info,{time:1000});
                setInterval(function(){ location.href=page_url.list_url; },1000);
            }else{
                layer.alert(data.info,{time:1000});
                setInterval(function(){ location.href=page_url.list_url; },1000);
            }
        }
    })
  })
})

//时间设置
$("#work4").click(function(){
   var s4_s_time = $("#s4_s_time").val();
   var s4_e_time = $("#s4_e_time").val();
   layer.confirm('确认要设置时间吗 ？？？',function(index){
    $.ajax({
        type: "post",
        url: page_url.save_work,
        data: {"s4_s_time":s4_s_time,"s4_e_time":s4_e_time},
        dataType:"json",
        success:function(data){
            if(data==200){
                layer.alert(data.info,{time:1000});
                setInterval(function(){ location.href=page_url.list_url; },1000);
            }else{
                layer.alert(data.info,{time:1000});
                setInterval(function(){ location.href=page_url.list_url; },1000);
            }
        }
    })
  })
})

