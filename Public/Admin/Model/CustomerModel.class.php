<?php
namespace Admin\Model;
use Think\Model;
class CustomerModel extends Model{
/************************************************ 客户管理模块 ****************************************/
	public function get_customer_add_save(){
		$customer = M("customer");
		$arr["customer_name"] = $_POST['customer_name'];
		$arr["customer_company"] = $_POST['customer_company'];
		$arr["customer_tel"] = $_POST['customer_tel'];
		$arr["customer_qq"] = $_POST['customer_qq'];
		$arr["customer_wechat"] = $_POST['customer_wechat'];
		$arr["customer_position"] = $_POST['customer_position'];
		$arr["customer_email"] = $_POST['customer_email'];
		$arr["customer_address"] = $_POST['customer_address'];
		$arr["customer_situation"] = $_POST['customer_situation'];
		$arr["customer_brand"] = $_POST['customer_brand'];
		$arr["customer_mark"] = $_POST['customer_mark'];
		$arr['customer_time'] = time();
		$arr["member_id"] = $_SESSION['admin']['member']['member_id'];
		$flag = $customer->add($arr);
		logs("添加客户");
		add($flag,"添加成功","添加失败");
	}

	public function get_customer_list(){
		$model = M();
		$str = "";
		$str1 = search_like("customer_brand","customer_brand");
		$time = search_time("customer_time","from","to");
		$count = $model
        ->table("zhiyan_customer c")
        ->where("c.customer_del=1".$str1['str'].$time['str'])
        ->count();
        $pageSize = 24;
        $page = page($count,$pageSize);
        $data = $model
        ->field("c.*")
        ->limit($page['first'].",".$page['list'])
        ->order("c.customer_id desc")
        ->table("zhiyan_customer c")
        ->where("c.customer_del=1".$str1['str'].$time['str'])
        ->select();
        foreach($data as $k=>$v){
        	$data[$k]['member_name'] = M("member")
        	->where("member_id='{$v['member_id']}'")
        	->getField("member_name");
        	$data[$k]['customer_time'] = date("Y-m-d",$v['customer_time']);
        }
        $arr["total"] = $count;
        $arr["customer"] = $data;
        $arr["link"] = $page['link'];
        $arr['customer_brand'] = $str1['key'];
        $arr['from'] = $time['from'];
        $arr['to'] = $time['to'];
        return $arr;
	}

	public function get_customer_mod(){
		$customer = M("customer");
		$map["customer_id"] = $_GET['customer_id'];
		$data = $customer->where($map)->find();
		return $data;
	}

	public function get_customer_mod_save(){
		$customer = M("customer");
		$arr["customer_name"] = $_POST['customer_name'];
		$arr["customer_company"] = $_POST['customer_company'];
		$arr["customer_tel"] = $_POST['customer_tel'];
		$arr["customer_qq"] = $_POST['customer_qq'];
		$arr["customer_wechat"] = $_POST['customer_wechat'];
		$arr["customer_position"] = $_POST['customer_position'];
		$arr["customer_email"] = $_POST['customer_email'];
		$arr["customer_address"] = $_POST['customer_address'];
		$arr["customer_situation"] = $_POST['customer_situation'];
		$arr["customer_brand"] = $_POST['customer_brand'];
		$arr["customer_mark"] = $_POST['customer_mark'];
		$arr["member_id"] = $_SESSION['admin']['member']['member_id'];
		$map["customer_id"] = $_POST['customer_id'];
		$flag = $customer->where($map)->save($arr);
		logs("编辑客户");
		editor($flag,"编辑成功","编辑失败");
	}

	public function get_customer_del(){
		$id = $_POST['id'];
		$customer = M("Customer");
		$arr['customer_del'] = 2;
		$flag = $customer->where("customer_id in ($id)")->save($arr);
		logs("删除客户");
		del($flag,"删除成功","删除失败");
	}


}
