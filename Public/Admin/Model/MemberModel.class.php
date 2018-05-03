<?php
namespace Admin\Model;
use Think\Model;
class MemberModel extends Model{
/************************************************ 成员管理模块 ****************************************/
	public function get_member_add_save(){
		$member = M("Member");
		$arr["member_name"] = $_POST['member_name'];
		$arr['member_tel'] = $_POST['member_tel'];
		$arr["member_user"] = $_POST['member_user'];
		$arr["member_name"] = $_POST['member_name'];
		$arr['member_pass'] = $_POST['member_pass'];
		$arr["repass"] = $_POST['repass'];
		$arr["member_wachat"] = $_POST['member_wachat'];
		$arr["member_email"] = $_POST['member_email'];
		json($arr["member_name"], "成员名称不能为空");
		json($arr['member_tel'], "手机不能为空");
		mobile($arr["member_tel"], "手机格式不正确");
		json($arr['member_user'], "帐号不能为空");
		json($arr['member_name'], "姓名不能为空");
		json($arr['member_pass'], "密码不能为空");
		json($arr['repass'], "确认密码不能为空");
		repass($arr['member_pass'], $arr['repass'], "密码两次不一致");
		$arr['member_pass'] = md5(md5($arr["member_pass"]));
		$arr["position_id"] = $_POST['position_id'];
		$arr["member_sex"] = $_POST['member_sex'];
		$arr['member_time'] = time();
		$arr['pid'] = $_SESSION['admin']['member']['member_id'];
		$map1['admin_id'] = $_SESSION['admin']['member']['member_id'];
		$role = M("role")->where($map1)->find();
		$flag = $member->add($arr);
		if($role['role_name'] == '总监'){
			$res1['member_id'] = $flag;
			$res1['pid'] = $map1['admin_id'];
			$res1['create_time'] = time();
			M("role")->add($res1);
		}
		logs("添加成员");
		add($flag,"添加成功","添加失败");
	}

	public function get_member_list(){
		$model = M();
		$str = "";
		$str1 = search_like("member_user","member_user");
		$time = search_time("member_time","from","to");
		$count = $model
        ->table("zhiyan_member m")
        ->where("m.member_del=1".$str1['str'].$time['str'].$str2['str'])
        ->count();
        $pageSize = 24;
        $page = page($count,$pageSize);
        $data = $model
        ->field("m.*")
        ->limit($page['first'].",".$page['list'])
        ->order("m.member_id desc")
        ->table("zhiyan_member m")
        ->where("m.member_del=1".$str1['str'].$time['str'].$str2['str'])
        ->select();
        foreach($data as $k=>$v){
        	$data[$k]['member_time'] = date("Y-m-d",$v['member_time']);
        	$data[$k]['role_name'] = M("role")->where("role_id='{$v['role_id']}'")->getField("role_name");
        }
        $arr["total"] = $count;
        $arr["member"] = $data;
        $arr["link"] = $page['link'];
        $arr['member_user'] = $str1['key'];
        $arr['from'] = $time['from'];
        $arr['to'] = $time['to'];
        return $arr;
	}

	public function get_member_mod(){
		$member = M("member");
		$map["member_id"] = $_GET['member_id'];
		$data = $member->where($map)->find();
		return $data;
	}

	public function get_member_mod_save(){
		$member = M("member");
		$arr["member_name"] = $_POST['member_name'];
		$arr['member_tel'] = $_POST['member_tel'];
		$arr["member_user"] = $_POST['member_user'];
		$arr["member_name"] = $_POST['member_name'];
		$arr["member_wachat"] = $_POST['member_wachat'];
		$arr["member_email"] = $_POST['member_email'];
		$arr["position_id"] = $_POST['position_id'];
		$arr["member_sex"] = $_POST['member_sex'];
		json($arr["member_name"], "成员名称不能为空");
		json($arr['member_tel'], "手机不能为空");
		mobile($arr["member_tel"], "手机格式不正确");
		json($arr['member_user'], "帐号不能为空");
		json($arr['member_name'], "姓名不能为空");
		if(!empty($_POST['member_pass'])){
			$arr['member_pass'] = $_POST['member_pass'];
			$arr["repass"] = $_POST['repass'];
			json($arr['member_pass'], "密码不能为空");
			json($arr['repass'], "确认密码不能为空");
			repass($arr['member_pass'], $arr['repass'], "密码两次不一致");
			$arr['member_pass'] = md5(md5($arr["member_pass"]));
		}
		$map["member_id"] = $_POST['member_id'];
		$flag = $member->where($map)->save($arr);
		logs("编辑成员");
		editor($flag,"编辑成功","编辑失败");
	}

	public function get_member_del(){
		$member_id = $_POST['id'];
		$member = M("member");
		$arr['member_del'] = 2;
		$flag = $member->where("member_id in ($member_id)")->save($arr);
		logs("删除职位");
		del($flag,"删除成功","删除失败");
	}

	public function get_member_pass_save(){
		$member = M("member");
		$res = $_POST['old_pass'];
		$arr['new_pass'] = $_POST['new_pass'];
		$arr["repass"] = $_POST['repass'];
		$map["member_id"] = $_SESSION['admin']['member']['member_id'];
		json($res, "旧密码不能为空");
		$data = M("member")->where($map)->find();
		$res1 = md5(md5($res));
		repass($data['member_pass'], $res1, "旧密码不正确");
		json($arr['new_pass'], "新密码不能为空");
		json($arr['repass'], "确认密码不能为空");
		repass($arr['new_pass'], $arr['repass'], "密码两次不一致");
		$res3['member_pass'] = md5(md5($arr["new_pass"]));
		$flag = $member->where($map)->save($res3);
		logs("修改密码");
		editor($flag,"密码修改成功","密码修改失败");
	}

	public function get_chief_add_save(){
		$member = M("Member");
		$arr["member_name"] = $_POST['member_name'];
		$arr['member_tel'] = $_POST['member_tel'];
		$arr["member_user"] = $_POST['member_user'];
		$arr["member_name"] = $_POST['member_name'];
		$arr['member_pass'] = $_POST['member_pass'];
		$arr["repass"] = $_POST['repass'];
		$arr["member_wachat"] = $_POST['member_wachat'];
		$arr["member_email"] = $_POST['member_email'];
		json($arr["member_name"], "成员名称不能为空");
		json($arr['member_tel'], "手机不能为空");
		mobile($arr["member_tel"], "手机格式不正确");
		json($arr['member_user'], "帐号不能为空");
		json($arr['member_name'], "姓名不能为空");
		json($arr['member_pass'], "密码不能为空");
		json($arr['repass'], "确认密码不能为空");
		repass($arr['member_pass'], $arr['repass'], "密码两次不一致");
		$arr['member_pass'] = md5(md5($arr["member_pass"]));
		$arr["role_id"] = $_POST['role_id'];
		$arr["member_sex"] = $_POST['member_sex'];
		$arr['member_time'] = time();
		$arr['pid'] = $_SESSION['admin']['member']['member_id'];
		$flag = $member->add($arr);
		logs("总监添加成员");
		add($flag,"添加成功","添加失败");
	}

	public function get_member_parent_save(){
		$member = M("member");
		$arr['parent_id'] = $_POST['parent_id'];
		$arr['parent_name'] = $_POST['parent_name'];
		$map['member_id'] = $_POST['member_id'];
		$flag = $member->where($map)->save($arr);
		logs("绑定关系");
		add($flag,"绑定成功","绑定失败");
	}


}
