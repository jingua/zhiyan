
/**
 * 添加数据
 * xiami
 * 2018-03-30
*/
function del(obj,id){
  layer.confirm(page_url.str1,function(index){
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

function redel(obj,id){
  layer.confirm(page_url.str2,function(index){
	$.ajax({
		type: "post",
		url: page_url.save_redel,
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



