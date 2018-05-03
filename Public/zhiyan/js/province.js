
/* 选择省给市赋值 */
$("[name='province_id']").change(function(){
    var province_id = $("[name='province_id']").val();
    $.ajax({
        url : page_url.save_city,
        data : "id=" + province_id,
        type : 'post',
        success:function(re){
            var res=JSON.parse(re);
            var city = "";
            for(var i=0;i<res.length;i++){
               city += '<option value="'+ res[i].id+'">'+ res[i].city+'</option>';
            }
            $("[name='city_id']").html(city);
        }
    })
})

/* 选择省给市赋值 */
$("[name='city_id']").change(function(){
    var city_id = $("[name='city_id']").val();
    $.ajax({
        url : page_url.save_area,
        data : "id=" + city_id,
        type : 'post',
        success:function(re){
            var res=JSON.parse(re);
            var area = "";
            for(var i=0;i<res.length;i++){
               area += '<option value="'+ res[i].id+'">'+ res[i].area+'</option>';
            }
            $("[name='area_id']").html(area);
        }
    })
})

//执行数据添加
var is_submit=0;
$(".btn_submit").on("click", function(){

if(is_submit==1) return;
is_submit=1;
$("#form-article-add").ajaxSubmit({
      url:page_url.save_url,
      type:"POST",
      dataType:"json",
      beforeSend: function() {
      },
      error: function() {
        layer.alert("服务器超时，请稍后再试",{icon:2,time:1000});
        is_submit=0;
      },
      success:function(data){
        if(data.ok==200){
          layer.alert(data.info,{icon:1,time:1000});
          setInterval(function(){ location.href=page_url.list_url; },1000);
        }else{
          layer.alert(data.info,{icon:2,time:1000});
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

//屏蔽分类
function category_stop(obj,id){
  layer.confirm('确认要屏蔽吗？',function(index){
    $.ajax({
      type:"post",
      url:page_url.category_stop,
      data:{'id':id},
      dataType:"json",
      success:function(data){
        if(data.ok==200){
          layer.alert(data.info,{icon: 1,time:1000});
          setInterval(function(){ location.href=page_url.list_url; },1000);
        }else{
          layer.alert(data.info,{time:1000});
          setInterval(function(){ location.href=page_url.list_url; },1000);
        }
      },
      async:true
    });
  });
}

//回复正常
function category_start(obj,id){
  layer.confirm('确认要回复正常吗？',function(index){
    $.ajax({
      type:"post",
      url:page_url.category_start,
      data:{'id':id},
      dataType:"json",
      success:function(data){
        if(data.ok==200){
          layer.alert(data.info, {icon: 1,time:1000});
          setInterval(function(){ location.href=page_url.list_url; },1000);
        }else{
          layer.alert(data.info,{time:1000});
          setInterval(function(){ location.href=page_url.list_url; },1000);
        }
      },
      async:true
    });
    
  });
}

//动态修改排序
$(".category_sort input").blur(function(){
    var category_id = $(this).attr("attr-id");
    var category_sort = $(this).val();
    if(category_sort.length == 0){
        layer.alert("排序不能为空",{icon:2,time:1000});return;
    }
   $.ajax({
        type: "post",
        url: page_url.category_sort,
        data: {"category_id":category_id,"category_sort":category_sort},
        dataType:"json",
        success:function(data){
            if(data.ok==200){
               window.location.href=page_url.list_url;
            }else{
                window.location.href=page_url.list_url;
            }
        }
    })
})

//动态修改分类名称
$(".category_name input").blur(function(){
    var category_id = $(this).attr("attr-id");
    var category_name = $(this).val();
    if(category_name.length == 0){
        layer.alert("排序不能为空",{icon:2,time:1000});return;
    }
   $.ajax({
        type: "post",
        url: page_url.category_name,
        data: {"category_id":category_id,"category_name":category_name},
        dataType:"json",
        success:function(data){
            if(data.ok==200){
                window.location.href=page_url.list_url;
            }else{
                window.location.href=page_url.list_url;
            }
        }
    })
})


