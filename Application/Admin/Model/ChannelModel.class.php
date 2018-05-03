<?php
namespace Admin\Model;
use Think\Model;
class ChannelModel extends Model{
/************************************************ 渠道管理模块 ****************************************/
	
	public function get_channel_city(){
		$map['parent'] = $_POST['id'];
		$data = M("province")->where($map)->select();
		echo json_encode($data);
	}

	public function get_channel_area(){
		$map['parent'] = $_POST['id'];
		$data = M("province")->where($map)->select();
		echo json_encode($data);
	}

	public function get_channel_add_save(){
		$channel = M("channel");
		$arr["channel_wechat"] = $_POST['channel_wechat'];
		$arr['channel_name'] = $_POST['channel_name'];
		$arr['channel_fans'] = $_POST['channel_fans'];
		$arr["type_id"] = $_POST['type_id'];
		$arr['price_first'] = $_POST['price_first'];
		prices($arr['price_first'],"价格只能为数字");
		$arr['price_end'] = $_POST['price_end'];
		$arr["province_id"] = $_POST['province'];
		$arr['province'] = M("province")->where("id='{$_POST['province']}'")->getField("province");
		$arr['city_id'] = $_POST['city'];
		$arr['city'] = M("province")->where("id='{$_POST['city']}'")->getField("city");
		$arr['area_id'] = $_POST['district'];
		$arr['area'] = M("province")->where("id='{$_POST['district']}'")->getField("district");
		$arr['channel_read_first'] = $_POST['channel_read_first'];
		$arr['channel_read_end'] = $_POST['channel_read_end'];
		$arr["channel_descr"] = $_POST['channel_descr'];
		json($arr["channel_name"], "渠道名称不能为空");
		json($arr["channel_fans"], "渠道名称不能为空");
		json($arr["price_first"], "头条价格不能为空");
		json($arr["price_end"], "次条价格不能为空");
		json($_POST['province'], "省不能为空");
		json($arr["channel_read_first"], "头条阅读量不能为空");
		json($arr["channel_read_end"], "次条阅读量不能为空");
		json($arr["channel_descr"], "渠道描述不能为空");
		$arr['channel_time'] = time();
		$arr["member_id"] = $_SESSION['admin']['member']['member_id'];
		$arr["channel_sort"] = $_POST['channel_sort'];
		$flag = $channel->add($arr);
		logs("添加渠道");
		add($flag,"添加成功","添加失败");
	}

	public function get_channel_list(){
		$model = M();
		$str1 = search_like("c.channel_name","channel_name");
		$str2 = search_like("c.channel_wechat","channel_wechat");
		$time = search_time("c.channel_time","from","to");
		$key1 = search_key("c.type_id","type_id");
		if($_POST['province'] != -1){
			$key2 = search_key("province_id","province");
		}
		if($_POST['city'] != -1){
			$key3 = search_key("city_id","city");
		}
		if($_POST['district'] != -1){
			$key4 = search_key("area_id","district");
		}
		$count = $model
        ->table("zhiyan_channel c, zhiyan_channel_type t")
        ->where("c.channel_del=1 and c.type_id=t.type_id".$str1['str'].$str2['str'].$time['str'].$key1['str'].$key2['str'].$key3['str'].$key4['str'])
        ->count();
        $pageSize = 24;
        $page = page($count,$pageSize);
        $data = $model
        ->field("c.*,t.type_name")
        ->limit($page['first'].",".$page['list'])
        ->table("zhiyan_channel c, zhiyan_channel_type t")
        ->order("c.channel_sort desc, c.channel_id desc")
        ->where("c.channel_del=1 and c.type_id=t.type_id".$str1['str'].$str2['str'].$time['str'].$key1['str'].$key2['str'].$key3['str'].$key4['str'])
        ->select();
        foreach($data as $k=>$v){
        	$data[$k]['member_name'] = M("member")->where("member_id='{$v['member_id']}'")->getField("member_name");
        	$data[$k]['channel_time'] = date("Y-m-d",$v['channel_time']);
        }
        $arr["total"] = $count;
        $arr["channel"] = $data;
        $arr["link"] = $page['link'];
        $arr['channel_name'] = $str1['key'];
        $arr['channel_wechat'] = $str2['key'];
        $arr['type_id'] = $key1['key'];
        $arr['province_id'] = $key2['key'];
        $arr['city_id'] = $key3['key'];
        $arr['area_id'] = $key4['key'];
        $arr['from'] = $time['from'];
        $arr['to'] = $time['to'];
        return $arr;
	}

	public function get_channel_mod(){
		$channel = M("channel");
		$map["channel_id"] = $_GET['channel_id'];
		$data = $channel->where($map)->find();
		return $data;
	}

	public function get_channel_mod_save(){
		$channel = M("channel");
		$arr["channel_wechat"] = $_POST['channel_wechat'];
		$arr['channel_name'] = $_POST['channel_name'];
		$arr['channel_fans'] = $_POST['channel_fans'];
		$arr["type_id"] = $_POST['type_id'];
		$arr['price_first'] = $_POST['price_first'];
		$arr['price_end'] = $_POST['price_end'];
		$arr["province_id"] = $_POST['province'];
		$arr['province'] = M("province")->where("id='{$_POST['province']}'")->getField("province");
		$arr['city_id'] = $_POST['city'];
		$arr['city'] = M("province")->where("id='{$_POST['city']}'")->getField("city");
		$arr['area_id'] = $_POST['district'];
		$arr['area'] = M("province")->where("id='{$_POST['district']}'")->getField("district");
		$arr['channel_read_first'] = $_POST['channel_read_first'];
		$arr['channel_read_end'] = $_POST['channel_read_end'];
		$arr["channel_descr"] = $_POST['channel_descr'];
		$arr["member_id"] = $_SESSION['admin']['member']['member_id'];
		$arr["channel_sort"] = $_POST['channel_sort'];
		$map["channel_id"] = $_POST['channel_id'];
		json($arr["channel_name"], "渠道名称不能为空");
		json($arr["channel_fans"], "渠道名称不能为空");
		json($arr["price_first"], "头条价格不能为空");
		prices($arr['price_first'],"价格只能为数字");
		json($arr["price_end"], "次条价格不能为空");
		prices($arr['price_end'],"价格只能为数字");
		json($_POST['province'], "省不能为空");
		json($arr["channel_read_first"], "头条阅读量不能为空");
		json($arr["channel_read_end"], "次条阅读量不能为空");
		json($arr["channel_descr"], "渠道描述不能为空");
		$flag = $channel->where($map)->save($arr);
		logs("编辑渠道");
		editor($flag, "编辑成功", "编辑失败");
	}

	public function get_channel_del(){
		$id = $_POST['id'];
		$channel = M("channel");
		$arr['channel_redel'] = 2;
		$flag = $channel->where("channel_id in ($id)")->save($arr);
		logs("审核删除渠道");
		del($flag,"审核成功","审核失败");
	}

	public function get_channel_redel(){
		$id = $_POST['id'];
		$channel = M("channel");
		$arr['channel_redel'] = 1;
		$flag = $channel->where("channel_id in ($id)")->save($arr);
		logs("撤消删除渠道");
		del($flag,"撤消成功","撤消失败");
	}



/************************************************ 渠道类型模块 ****************************************/
	public function get_type_add_save(){
		$type = M("channelType");
		$arr["type_name"] = $_POST['type_name'];
		$arr['type_time'] = time();
		$arr["member_id"] = $_SESSION['admin']['member']['member_id'];
		$arr["type_sort"] = $_POST['type_sort'];
		json($arr["type_name"], "类型名称不能为空");
		$flag = $type->add($arr);
		logs("添加渠道类型");
		add($flag, "添加成功", "添加失败");
	}

	public function get_type_list(){
		$model = M();
		$str = "";
		$str1 = search_like("type_name","type_name");
		$time = search_time("type_time","from","to");
		$count = $model
        ->table("zhiyan_channel_type")
        ->where("type_del=1".$str1['str'].$time['str'])
        ->count();
        $pageSize = 24;
        $page = page($count,$pageSize);
        $data = $model
        ->field("*")
        ->limit($page['first'].",".$page['list'])
        ->order("type_sort desc, type_id desc")
        ->table("zhiyan_channel_type")
        ->where("type_del=1".$str1['str'].$time['str'])
        ->select();
        foreach($data as $k=>$v){
        	$data[$k]['member_name'] = M("member")
        	->where("member_id='{$v['member_id']}'")
        	->getField("member_user");
        	$data[$k]['type_time'] = date("Y-m-d",$v['type_time']);
        }
        $arr["total"] = $count;
        $arr["type"] = $data;
        $arr["link"] = $page['link'];
        $arr['type_name'] = $str1['key'];
        $arr['from'] = $time['from'];
        $arr['to'] = $time['to'];
        return $arr;
	}

	public function get_type_mod(){
		$type = M("channelType");
		$map["type_id"] = $_GET['type_id'];
		$data = $type->where($map)->find();
		return $data;
	}

	public function get_type_mod_save(){
		$type = M("channelType");
		$arr["type_name"] = $_POST['type_name'];
		$arr["member_id"] = $_SESSION['admin']['member']['member_id'];
		$arr["type_sort"] = $_POST['type_sort'];
		$map["type_id"] = $_POST['type_id'];
		json($arr["type_name"], "类型名称不能为空");
		$flag = $type->where($map)->save($arr);
		logs("编辑渠道类型");
		editor($flag,"编辑成功","编辑失败");
	}

	public function get_type_del(){
		$type_id = $_POST['id'];
		$type = M("channelType");
		$arr['type_del'] = 2;
		$flag = $type->where("type_id in ($type_id)")->save($arr);
		logs("删除渠道类型");
		del($flag,"删除成功","删除失败");
	}


}
