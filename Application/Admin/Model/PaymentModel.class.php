<?php
namespace Admin\Model;
use Think\Model;
class PaymentModel extends Model{
/************************************************ 支付方式管理模块 ****************************************/
	public function get_pay_add_save(){
		$pay = M("payment");
		$arr["pay_name"] = $_POST['pay_name'];
		$arr['create_time'] = time();
		$arr["member_id"] = $_SESSION['admin']['member']['member_id'];
		json($arr["pay_name"], "支付方式不能为空");
		$flag = $pay->add($arr);
		logs("添加支付方式");
		add($flag,"添加成功","添加失败");
	}

	public function get_pay_list(){
		$model = M();
		$str = "";
		$str1 = search_like("pay_name","pay_name");
		$time = search_time("create_time","from","to");
		$count = $model
        ->table("zhiyan_payment p")
        ->where("p.pay_del=1".$str1['str'].$time['str'])
        ->count();
        $pageSize = 24;
        $page = page($count,$pageSize);
        $data = $model
        ->field("p.*")
        ->limit($page['first'].",".$page['list'])
        ->order("p.pay_id")
        ->table("zhiyan_payment p")
        ->where("p.pay_del=1".$str1['str'].$time['str'])
        ->select();
        foreach($data as $k=>$v){
        	$data[$k]['member_name'] = M("member")
        	->where("member_id='{$v['member_id']}'")
        	->getField("member_user");
        	$data[$k]['create_time'] = date("Y-m-d",$v['create_time']);
        }
        $arr["total"] = $count;
        $arr["pay"] = $data;
        $arr["link"] = $page['link'];
        $arr['pay_name'] = $str1['key'];
        $arr['from'] = $time['from'];
        $arr['to'] = $time['to'];
        return $arr;
	}

	public function get_pay_mod(){
		$pay = M("payment");
		$map["pay_id"] = $_GET['pay_id'];
		$data = $pay->where($map)->find();
		return $data;
	}

	public function get_pay_mod_save(){
		$pay = M("payment");
		$arr["pay_name"] = $_POST['pay_name'];
		$arr["member_id"] = $_SESSION['admin']['member']['member_id'];
		$arr['update_time'] = time();
		$map["pay_id"] = $_POST['pay_id'];
		json($arr["pay_name"], "支付方式不能为空");
		$flag = $pay->where($map)->save($arr);
		logs("编辑支付方式");
		editor($flag,"编辑成功", "编辑失败");
	}

	public function get_pay_del(){
		$pay_id = $_POST['id'];
		$pay = M("payment");
		$arr['pay_del'] = 2;
		$arr['update_time'] = time();
		$flag = $pay->where("pay_id in ($pay_id)")->save($arr);
		logs("删除支付方式");
		del($flag,"删除成功", "删除失败");
	}


}
