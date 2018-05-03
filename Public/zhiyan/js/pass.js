
/*查看工作内容*/
function plan_show(title,url,w,h){
    layer_show(title,url,w,h);
}

/*查看工作内容*/
	function study_show(title,url,w,h){
		layer_show(title,url,w,h);
	}


/* 执行数据添加 */
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
          //window.parent.frames.location.href="{:U('Index/login')}"; 
          window.open("{:U('Index/login')}");top.close();
        }else{
          //window.parent.frames.location.href="{:U('Index/login')}";
          window.open("{:U('Index/login')}");
        }
        is_submit=0;
      }
    });
});

/* delete one */
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

/* delete more */
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
