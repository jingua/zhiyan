/**
 * 添加数据
 * xiami
 * 2018-03-30
*/
var is_submit = 0;
$(".btn_submit").on("click", function(){
if(is_submit == 1) return;
is_submit = 1;
$("#form-article-add").ajaxSubmit({
      url: page_url.save_url,
      type: "POST",
      dataType: "json",
      beforeSend: function() {
      },
      error: function() {
        layer.alert("服务器超时，请稍后再试",{icon:2,time:1000});
        is_submit = 0;
      },
      success:function(data){
        if(data.ok == 200){
          layer.alert(data.info,{icon:1,time:1000});
          setInterval(function(){ location.href = page_url.list_url; },1000);
        }else{
          layer.alert(data.info,{icon:2,time:1000});
        }
        is_submit=0;
      }
    });
});

/**
 * 添加数据
 * xiami
 * 2018-03-30
*/
function del(obj,id){
  layer.confirm("您确定要删除吗",function(index){
	$.ajax({
		type: "post",
		url: page_url.save_del,
		data: {"id":id},
		dataType: "json",
		success:function(data){
			if(data.ok==200){
				layer.alert(data.info,{icon:1,time:1000});
				setInterval(function(){ location.href=page_url.list_url; },1000);
			}else{
				layer.alert(data.info,{icon:2,time:1000});
			}
		}
	})
  })
}

/**
 * 添加数据
 * xiami
 * 2018-03-30
*/
function datadel(){
    layer.confirm("您确定要删除吗？？？",function(index){
	var arr = [];
	$("input[name=dataid]:checked").each(function(){
		arr.push($(this).attr("_id"));
	});
	if(arr.length == 0){
		layer.alert("请选择要删除的内容？？？",{time:1000,icon:2});return false;
	}
	$.ajax({
		type: "post",
		url: page_url.save_del,
		data: {"id":arr.join(",")},
		dataType:"json",
		success:function(data){
            if(data.ok==200){
                layer.alert(data.info,{icon:1,time:1000});
                setInterval(function(){ location.href=page_url.list_url; },1000);
            }else{
                layer.alert(data.info,{icon:2,time:1000});
            }
        },
		async:true
	});
	});
}

/**
 * 打开窗口
 * xiami
 * 2018-03-27
*/
function give_coupon_one(title,url,w,h){
   layer_show(title,url,w,h);
}


/**
 * 打开窗口查看信息
 * xiami
 * 2018-03-27
*/
function show(title,url,id,w,h){
	layer_show(title,url + "&more_id=" + id,w,h);
}



