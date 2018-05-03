<?php
namespace Admin\Model;
use Think\Model;
class PositionModel extends Model{
/************************************************ 职位管理模块 ****************************************/
	public function get_position_add_save(){
		$position = M("position");
		$arr["position_name"] = $_POST['position_name'];
		$arr['position_time'] = time();
		$arr["member_id"] = $_SESSION['admin']['member']['member_id'];
		$arr["position_sort"] = $_POST['position_sort'];
		json($arr["position_name"], "职位名称不能为空");
		$flag = $position->add($arr);
		logs("添加职位");
		add($flag,"添加成功","添加失败");
	}

	public function get_position_list(){
		$model = M();
		$str = "";
		$str1 = search_like("position_name","position_name");
		$time = search_time("position_time","from","to");
		$count = $model
        ->table("zhiyan_position p")
        ->where("p.position_del=1".$str1['str'].$time['str'])
        ->count();
        $pageSize = 24;
        $page = page($count,$pageSize);
        $data = $model
        ->field("p.*")
        ->limit($page['first'].",".$page['list'])
        ->order("p.position_sort desc, p.position_id")
        ->table("zhiyan_position p")
        ->where("p.position_del=1".$str1['str'].$time['str'])
        ->select();
        foreach($data as $k=>$v){
        	$data[$k]['member_name'] = M("member")
        	->where("member_id='{$v['member_id']}'")
        	->getField("member_user");
        	$data[$k]['position_time'] = date("Y-m-d",$v['position_time']);
        }
        $arr["total"] = $count;
        $arr["position"] = $data;
        $arr["link"] = $page['link'];
        $arr['position_name'] = $str1['key'];
        $arr['from'] = $time['from'];
        $arr['to'] = $time['to'];
        return $arr;
	}

	public function get_position_mod(){
		$position = M("position");
		$map["position_id"] = $_GET['position_id'];
		$data = $position->where($map)->find();
		return $data;
	}

	public function get_position_mod_save(){
		$position = M("position");
		$arr["position_name"] = $_POST['position_name'];
		$arr["member_id"] = $_SESSION['admin']['member']['member_id'];
		$arr["position_sort"] = $_POST['position_sort'];
		$map["position_id"] = $_POST['position_id'];
		json($arr["position_name"], "职位名称不能为空");
		$flag = $position->where($map)->save($arr);
		logs("编辑职位");
		editor($flag,"编辑成功", "编辑失败");
	}

	public function get_position_del(){
		$position_id = $_POST['id'];
		$position = M("position");
		$arr['position_del'] = 2;
		$flag = $position->where("position_id in ($position_id)")->save($arr);
		logs("删除职位");
		del($flag,"删除成功", "删除失败");
	}


}
