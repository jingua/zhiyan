<?php
namespace Admin\Model;
use Think\Model;
class NodeModel extends Model{
/************************************** 角色管理模块 *******************************************/
	public function get_role_add(){
		$role = D("Role");
		$arr["role_name"] = $_REQUEST["role_name"];
		json($arr['role_name'], "角色名称不能为空");
		$arr["role_time"] = time();
		$arr['admin_id'] = $_SESSION['admin']['member']['member_id'];
		$arr['role_sort'] = $_REQUEST['role_sort'];
		$flag = $role->add($arr);
		add($flag, "添加成功", "添加失败");
	}

	public function get_role_list(){
		$role = D("role");
		$str = '';
		$str = search_like("role_name","role_name");
		$time = search_time("role_time",'from',"to");
		$count = $role->where("1=1".$str['str'].$time['str'])->count();
		$page = page($count,24);
		$data=$role
		->where("1=1".$str['str'].$time['str'])
		->limit($page['first'].",".$page['list'])
		->order("role_sort desc, role_id desc")
		->select();
		foreach($data as $k=>$v){
			$data[$k]['role_time'] = date("Y-m-d",$v['role_time']);
		}
		$arr['link'] = $page['link'];
		$arr['count'] = $count;
		$arr["role"] = $data;
		$arr['role_name'] = $str['key'];
		$arr['from'] = $time['from'];
		$arr['to'] = $time['to'];
		return $arr;
	}

	public function get_role_mod(){
		$role = D("Role");
		$map['role_id'] = intval($_REQUEST['role_id']);
		$data = $role->where($map)->find();
		return $data;
	}

	public function get_role_edit(){
		$role = D("Role");
		$arr["role_name"] = $_REQUEST["role_name"];
		json($arr['role_name'],"角色名称不能为空");
		$arr["role_time"] = time();
		$arr['admin_id'] = $_SESSION['admin']['member']['member_id'];
		$map['role_id'] = $_REQUEST["role_id"];
		$arr['role_sort'] = $_REQUEST['role_sort'];
		$flag = $role->where($map)->save($arr);
		editor($flag,"编辑成功","编辑失败");
	}

	public function get_role_del(){
		$role_id = $_REQUEST['id'];
		$role = D("Role");
		$flag = $role->where("role_id in ({$role_id})")->delete();
		del($flag,"删除成功","删除失败");
	}

	public function get_user_field(){
		$admin_id = intval($_GET['admin_id']);
		$admin = D("Member");
		$arr = $admin->where("member_id='%d'",$admin_id)->find();
		return $arr;
	}

	public function get_role_user_save(){
		$ur = D("UserRole");
		$admin_id = $_REQUEST['admin_id'];
		$role_id = $_REQUEST['role_id'];
		$ur->where("admin_id='{$admin_id}'")->delete();
		foreach($role_id as $v){
			$arr[] = array(
				'admin_id' => $admin_id,
				'role_id' => $v
			);
			$res1['role_id'] = $v;
		}
		if($ur->addAll($arr)){
			$map1['member_id'] = $_REQUEST['admin_id'];
			$member = M("member")->where($map1)->save($res1);
			$data['ok'] = 200;
			$data["info"] = "添加成功";
			$data['admin_id'] = $admin_id;
			echo json_encode($data);exit;
		}else{
			$data['ok'] = 301;
			$data["info"] = "添加失败";
			echo json_encode($data);exit;
		}
	}

	public function get_user_role_all(){
		$admin_id = $_GET['admin_id'];
		$ur = D("UserRole");
		$arr = $ur->where("admin_id='%d'",$admin_id)->select();
		foreach($arr as $v){
			$role_id[] = $v['role_id'];
		}
		return $role_id;
	}

	public function get_node_save(){
		$node = D("Node");
		$arr["node_name"] = $_REQUEST["node_name"];
		$arr["node_descr"] = $_REQUEST["node_descr"];
		json($arr['node_name'],"节点名称不能为空");
		json($arr['node_descr'],"节点描述不能为空");
		$arr["node_pid"] = $_REQUEST["node_pid"];
		if($arr['node_pid']== 0){
			$arr['node_level'] = 1;
		}else{
			$arr["node_level"] = 2;
		}
		$arr["node_time"] = time();
		$arr['admin_id'] = $_SESSION['admin']['member']['member_id'];
		$arr["node_sort"] = $_REQUEST["node_sort"];
		$flag = $node->add($arr);
		add($flag,"添加成功","添加失败");
	}

	public function get_actions(){
		$node = D("Node");
		$arr = $node->where("node_level=1")->select();
		return $arr;
	}

	public function get_node_all(){
		$node = D("Node");
		$str = '';
		$str = search_like("node_name","node_name");
		$str = search_time("node_time","from","to");
		$count = $node->where("node_level=1".$str['str'].$time['str'])->count();
		$page = page($count,24);
		$data = $node
		->where("node_level=1".$str['str'],$time['str'])
		->limit($page['first'].",".$page['list'])
		->order("node_sort desc,node_id desc")
		->select();
		/*foreach($data as &$v){
			$v['actions'] = $node->where("node_pid='%d'",$v['node_id'])->select();
		}*/
		foreach($data as $k=>$v){
			$data[$k]['node_time'] = date("Y-m-d",$v['node_time']);
			$data[$k]['actions'] = $node->where("node_pid='{$v['node_id']}' and node_level!=1")->select();
			foreach($data[$k]['actions'] as $k1=>$v1){
				$data[$k]['actions'][$k1]['node_time'] = date("Y-m-d",$v1['node_time']);
			}
		}
		$arr['count'] = $count;
		$arr['link'] = $page['link'];
		$arr['node'] = $data;
		$arr['node_name'] = $str['key'];
		$arr['from'] = $time['from'];
		$arr['to'] = $time['to'];
		return $arr;
	}

	public function get_node_mod(){
		$map['node_id'] = intval($_REQUEST['node_id']);
		$node = D("Node");
		$arr = $node->where($map)->find();
		return $arr;
	}

	public function get_node_edit(){
		$node = D("Node");
		$arr["node_name"] = $_REQUEST["node_name"];
		json($arr['node_name'],"节点名称不能为空");
		$arr["node_descr"] = $_REQUEST["node_descr"];
		json($arr['node_descr'],"节点描述不能为空");
		$arr["node_pid"] = $_REQUEST["node_pid"];
		$arr["node_time"] = time();
		$arr['admin_id'] = $_SESSION['admin']['member']['member_id'];
		$map['node_id'] = $_REQUEST['node_id'];
		$arr["node_sort"] = $_REQUEST["node_sort"];
		$flag = $node->where($map)->save($arr);
		editor($flag,"编辑成功","编辑失败");
	}

	public function get_node_del(){
		$id = intval($_REQUEST['id']);
		$node = D("Node");
		$pid = $node->where("node_pid in ({$id})")->select();
		if($pid){
			$data['ok'] = 301;
			$data["info"] = "您不能删除，请先删除下级分类之后在删除";
			echo json_encode($data);exit;
		}else{
			if($node->where("node_id in ({$id})")->delete()){
				$data['ok'] = 200;
				$data["info"] = "删除成功";
				echo json_encode($data);exit;
			}else{
				$data['ok'] = 301;
				$data["info"] = "删除失败";
				echo json_encode($data);exit;
			}
		}
	}

	public function get_role_node_save(){
		$rn = D("RoleNode");
		$role_id = $_REQUEST["role_id"];
		$node_id = $_REQUEST["node_id"];
		$rn->where("role_id='{$role_id}'")->delete();
		$arr = array();
		foreach($node_id as $node_id){
			$arr[] = array(
				"role_id" => $role_id,
				"node_id" =>$node_id,
				"admin_id" => $_SESSION['admin']['member']['member_id']
			);
		}
		if($rn->addAll($arr)){
			$data['ok'] = 200;
			$data['info'] = "添加成功";
			$data["role_id"] = $role_id;
			echo json_encode($data);exit;
		}else{
			$data['ok'] = 301;
			$data['info'] = "添加失败";
			echo json_encode($data);exit;
		}
	}

	public function get_role_user(){
		$rn = D("RoleNode");
		$role_id = intval($_REQUEST['role_id']);
		$data = $rn->where("role_id='%d'",$role_id)->select();
		foreach($data as $role){
			$node_id[]=$role['node_id'];
		}
		return $node_id;
	}


}