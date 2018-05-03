<?php
namespace Admin\Model;
use Think\Model;
class BusinessModel extends Model{
/************************************************ 成员管理模块 ****************************************/
    /* 事务在项目中的应用 */
	public function get_business_add_save(){
		$business = M("business");
		$business->startTrans();
		$arr['business_name'] = $_POST['business_name'];
		json($arr['business_name'],"项目名称不能为空");
		$arr['business_total'] = $_POST['business_total'];
		json($arr['business_total'],"价格不能为空");
		prices($_POST['business_total'],"价格只能为数字");
		$arr['business_wfk'] = $_POST['business_total'];
		//$map1['customer_company'] = $_POST['customer'];
		$arr["customer_id"] = $_POST['customer_id'];
		//$arr["customer_name"] = $_POST['customer'];
		//json($arr['customer_name'],"客户名称不能为空");
		$arr["remind_time"] = strtotime($_POST['remind_time']);
		json($arr['remind_time'],"提醒时间不能为空");
		$arr['create_time'] = time();
		$arr1 = $_POST["channel_id"];
		$arr["channel_id"] = implode(",", $arr1);
		$arr["member_id"] = $_SESSION['admin']['member']['member_id'];
		$result = $business->add($arr);
		foreach($arr1 as $k => $v){
			$time = $_POST["business_time{$v}"];
			$text = $_POST["time_text{$v}"];
			$price = $_POST["time_price{$v}"];
			$invoice = $_POST["invoice_price{$v}"];
			$num = count($price); 
			for($i=0; $i<$num; $i++){
				$res2["channel_id"] = $v;
				$res2["business_id"] = $result;
				$res2["time_time"] = strtotime($time[$i]);
				$res2["time_text"] = $text[$i];
				$res2["time_price"] = $price[$i];
				$res2["invoice_price"] = $invoice[$i];
				$res2["create_time"] = time();
				if($res2['time_time']){
					$flag = M("businessTime")->add($res2);
				}
			}
		}
		if($result && $flag){
			$business->commit();
			logs("添加业务");
			$data['ok'] = 200;
			$data['info'] = "添加成功";
			echo json_encode($data); 
		}else{
			$business->rollback();
			$data['ok'] = 301;
			$data['info'] = "添加失败";
			echo json_encode($data); 
		}
	}

	public function get_business_pay_save(){
		$name = $_POST['pay_name'];
		$price = $_POST['pay_price'];
		$id = $_POST['pay_id'];
		for($i=0; $i<(count($name)); $i++){
			if(empty($id[$i])){
				$arr['pay_name'] = $name[$i];
				$arr['pay_price'] = $price[$i];
				$arr['member_id'] = $_SESSION['admin']['member']['member_id'];
				$arr["business_id"] = $_POST['business_id'];
				$arr['create_time'] = time();
				$flag = M("pay")->add($arr);
				//continue;
			}
		}
		logs("添加支出");
		add($flag, "添加成功", "添加失败");
	}

	//显示客户列表
	public function get_customer(){
		//权限判断 begin
		$key = '';
		$key2 = '';
		$member_id = $_SESSION['admin']['member']['member_id'];
		$member = M("member")->where("member_id='{$member_id}'")->find();
		if($member['role_id'] == 3){
			$key .= " and member_id='{$member_id}'";
		}else if($member['role_id'] == 4){
			$key1 = M("member")->where("member_del=1 and parent_id='{$member['member_id']}'")->find();
			if(!empty($key1)){
				$key11 = $key1['member_id'].",".$member['member_id'];
				$key2 = " and member_id in ($key11)";
			}else{
				$key2 = " and member_id='{$member['member_id']}'";
			}
		}
		//权限判断 end
		$customer = M("customer")->where("customer_del=1".$key.$key2)->select();
		return $customer;
	}

	/* 需要使用事务 */
	public function get_business_price_save(){
		$property = M("property");
		$price = $_POST['price_total'];
		json($price, "收款金额不能为空");
		prices($price,"价格只能为数字");
		$map["business_id"] = $_POST['business_id'];
		/* 查询项目金额 */
		$data = M("business")->where($map)->find();
		$arr["pay_id"] = $_POST['pay_id'];
		$arr["property_total"] = $price;
		$arr['property_come'] = $data['business_wfk']-$price;
		$arr["business_id"] = $_POST['business_id'];
		$arr["member_id"] = $_SESSION['admin']['member']['member_id'];
		$arr["create_time"] = time();
		/* 添加收款金额与未付款金额 */
		$flag = $property->add($arr);
		$arr1['business_fkx'] = $price;
		$arr1['business_wfk'] = $data['business_wfk']-$price;
		$arr1['update_time'] = time();
		$arr1['pay_id'] = $_POST['pay_id'];
		/* 添加付款项 */
		$flag2 = M("business")->where($map)->save($arr1);
		logs("添加申请收款");
		add($flag,"添加成功","添加失败");
	}

	public function get_business_upload_save(){
		$contract = M("contract");
		$map1['business_id'] = $_POST['business_id'];
		$business = M("business")->where($map1)->find();
		$map2["customer_id"] = $business['customer_id'];
		$customer = M("customer")->where($map2)->find();
		$arr["contract_name"] = $customer['customer_company'];
		$arr["contract_tel"] = $customer['customer_tel'];
		$arr["business_id"] = $_POST['business_id'];
		$arr["member_id"] = $_SESSION['admin']['member']['member_id'];
		$arr["contract_create"] = time();
		if(array_filter($_FILES['contract_dir'])){
			$arr['contract_dir'] = upload_one($_FILES['contract_dir'],"zhiyan/upload/contract");
			$dir = M('contract')->where($map)->getField("contract_dir");
			if($dir){
				unlink("./Public/zhiyan/upload/contract/{$dir}");
			}
		}
		$flag1 = $contract->add($arr);
		$res1["contract_id"] = $flag1;
		$flag2 = M("business")->where($map1)->save($res1);
		logs("上传合同");
		add($flag2,"上传成功","上传失败");
	}

	public function get_business_reupload_save(){
		$contract = M("contract");
		$map1['business_id'] = $_POST['business_id'];
		$business = M("business")->where($map1)->find();
		$map2["contract_id"] = $business['contract_id'];
		$arr["member_id"] = $_SESSION['admin']['member']['member_id'];
		if(array_filter($_FILES['contract_dir'])){
			$arr['contract_dir'] = upload_one($_FILES['contract_dir'],"zhiyan/upload/contract");
			$dir = M('contract')->where($map)->getField("contract_dir");
			if($dir){
				unlink("{$dir}");
			}
		}
		$flag1 = $contract->where($map2)->save($arr);
		logs("重新上传合同");
		add($flag1,"上传成功","上传失败");
	}

	public function get_business_time(){
		$map['business_id'] = $_REQUEST['business_id'];
		$data = M("businessTime")->where($map)->select();
		foreach($data as $k => $v){
			$data[$k]['time_time'] = date("Y-m-d",$v['time_time']);
			$data[$k]['channel_name'] = M("channel")->where("channel_id='{$v['channel_id']}'")->getField("channel_name");
			$price = M("channel")->field("price_first,price_end")->where("channel_id='{$v['channel_id']}'")->find();
			switch($v['time_text']) {
				case "none" :
					$data[$k]['price'] = 0;
					break;
				case "first" :
					$data[$k]['price'] = $price['price_first'];
					break;
				case "end" :
					$data[$k]['price'] = $price['price_end'];
					break;
				default :
					break;
			}
		}
		return $data;
	}

	public function get_time_start(){
		$map['time_id'] = $_REQUEST['id'];
		$data['time_status'] = 1;
		$flag = M("businessTime")->where($map)->save($data);
		logs("已结算设置");
		editor($flag, "设置成功", "设置失败");
	}
	
	public function get_time_stop(){
		$map['time_id'] = $_REQUEST['id'];
		$id = $_REQUEST['business_id'];
		$data['time_status'] = 2;
		$flag = M("businessTime")->where($map)->save($data);
		if($flag){
			logs("未结算设置");
			$res["ok"] = 200;
			$res["business_id"] = $id;
			$res["info"] = "设置成功";
			echo json_encode($res);
		}else{
			$res["ok"] = 301;
			$res["business_id"] = $id;
			$res["info"] = "设置失败";
			echo json_encode($res);
		}
	}


	public function get_business_list(){
		$model = M();
		$str = "";
		$str1 = search_like("customer_brand","customer_brand");
		$time = search_time("customer_time","from","to");
		//权限判断 begin
		$key = '';
		$key2 = '';
		$member_id = $_SESSION['admin']['member']['member_id'];
		$member = M("member")->where("member_id='{$member_id}'")->find();
		if($member['role_id'] == 3){
			$key .= " and b.member_id='{$member_id}'";
		}else if($member['role_id'] == 4){
			$key1 = M("member")->where("member_del=1 and parent_id='{$member['member_id']}'")->find();
			if(!empty($key1)){
				$key11 = $key1['member_id'].",".$member['member_id'];
				$key2 = " and b.member_id in ($key11)";
			}else{
				$key2 = " and b.member_id='{$member['member_id']}'";
			}
		}
		//权限判断 end
		$count = $model
        ->table("zhiyan_business b")
        ->where("b.business_del=1 {$key} {$key2}".$str1['str'].$time['str'])
        ->count();
        $pageSize = 24;
        $page = page($count,$pageSize);
        $data = $model
        ->field("b.*")
        ->limit($page['first'].",".$page['list'])
        ->order("b.business_id desc")
        ->table("zhiyan_business b")
        ->where("b.business_del=1 {$key} {$key2}".$str1['str'].$time['str'])
        ->select();
        foreach($data as $k=>$v){
        	$data[$k]['contract_dir'] = M("contract")
        	->where("contract_id='{$v['contract_id']}'")
        	->getField("contract_dir");
        	$data[$k]['member_name'] = M("member")
        	->where("member_id='{$v['member_id']}'")
        	->getField("member_name");
        	$data[$k]['customer_name'] = M("customer")
        	->where("customer_id='{$v['customer_id']}'")
        	->getField("customer_name");
        	$data[$k]['customer_company'] = M("customer")
        	->where("customer_id='{$v['customer_id']}'")
        	->getField("customer_company");
        	$data[$k]['create_time'] = date("Y-m-d",$v['create_time']);
        	$data[$k]['remind_time'] = date("Y-m-d",$v['remind_time']);
        	if(!empty($v['update_time'])){
        		$data[$k]['update_time'] = date("Y-m-d",$v['update_time']);
        	}else{
        		$data[$k]['update_time'] = "无";
        	}
        }
        $arr["total"] = $count;
        $arr["business"] = $data;
        $arr["link"] = $page['link'];
        $arr['customer_brand'] = $str1['key'];
        $arr['from'] = $time['from'];
        $arr['to'] = $time['to'];
        return $arr;
	}

	public function get_business_mod(){
		$business = M("business");
		$map["business_id"] = $_GET['business_id'];
		$data = $business->where($map)->find();
		/*$data['kehu'] = M("customer")
			->where("customer_id='{$data['customer_id']}'")
			->getField("customer_company");*/
		$data['remind_time'] = date("Y-m-d",$data['remind_time']);
		return $data;
	}

	public function get_business_time_mod(){
		$business = M("businessTime");
		$map["business_id"] = $_GET['business_id'];
		$data = $business->where($map)->select();
		foreach($data as $k=>$v){
			$data[$k]["time_time"] = date("Y-m-d",$v['time_time']);
			$data[$k]['channel_name'] = M("channel")
				->where("channel_id='{$v['channel_id']}'")
				->getField("channel_name");
		}
		return $data;
	}

	public function get_business_mod_save(){
		$business = M("business");
		$arr['business_name'] = $_POST['business_name'];
		json($arr['business_name'],"项目名称不能为空");
		$arr['business_total'] = $_POST['business_total'];
		json($arr['business_total'],"价格不能为空");
		prices($_POST['business_total'],"价格只能为数字");
		//$map1['customer_company'] = $_POST['customer'];
		$arr["customer_id"] = $_POST['customer_id'];
		$arr["remind_time"] = strtotime($_POST['remind_time']);
		json($arr['remind_time'],"提醒时间不能为空");
		$arr["member_id"] = $_SESSION['admin']['member']['member_id'];
		$time_id = $_POST["time_id"];
		$time = $_POST["time_time"];
		$text = $_POST["time_text"];
		$price = $_POST["time_price"];
		$invoice = $_POST["invoice_price"];
		$num = count($time_id);
		for($i=0; $i<$num; $i++){
			$map2["time_id"] = $time_id[$i];
			$res2["time_time"] = strtotime($time[$i]);
			$res2["time_text"] = $text[$i];
			$res2["time_price"] = $price[$i];
			$res2["invoice_price"] = $invoice[$i];
			$flag = M("businessTime")->where($map2)->save($res2);
		}
		$map["business_id"] = $_POST['business_id'];
		$flag = $business->where($map)->save($arr);
		logs("编辑业务");
		editor($flag,"编辑成功","编辑失败");
	}

	public function get_business_redel(){
		$id = $_POST['id'];
		$business = M("Business");
		$arr['business_redel'] = 2;
		$flag = $business->where("business_id in ($id)")->save($arr);
		logs("申请删除客户");
		add($flag,"申请成功","申请失败");
	}

	public function get_sign_add_save(){
		$sign = M("sign");
		$arr['sign_name'] = $_POST['sign_name'];
		$arr['sign_text'] = $_POST['sign_text'];
		$map1['customer_company'] = $_POST['customer'];
		$arr["customer_id"] = M("customer")->where($map1)->getField("customer_id");
		$arr["sign_start_time"] = strtotime($_POST['start_time']);
		$arr["sign_end_time"] = strtotime($_POST['end_time']);
		$arr['create_time'] = time();
		if(array_filter($_FILES['sign_pic'])){
			$arr['sign_pic'] = upload_one($_FILES['sign_pic'],"zhiyan/upload/sign_pic");
		}
		$arr["member_id"] = $_SESSION['admin']['member']['member_id'];
		$result = $sign->add($arr);
		logs("添加签约");
		add($result,"添加成功","添加失败");
	}

	public function get_sign_list(){
		$model = M();
		$str = "";
		$str1 = search_like("customer_brand","customer_brand");
		$time = search_time("customer_time","from","to");
		//权限判断 begin
		$key = '';
		$key2 = '';
		$member_id = $_SESSION['admin']['member']['member_id'];
		$member = M("member")->where("member_id='{$member_id}'")->find();
		if($member['role_id'] == 3){
			$key .= " and b.member_id='{$member_id}'";
		}else if($member['role_id'] == 4){
			$key1 = M("member")->where("member_del=1 and parent_id='{$member['member_id']}'")->find();
			if(!empty($key1)){
				$key11 = $key1['member_id'].",".$member['member_id'];
				$key2 = " and b.member_id in ($key11)";
			}else{
				$key2 = " and b.member_id='{$member['member_id']}'";
			}
		}
		//权限判断 end
		$count = $model
        ->table("zhiyan_sign b")
        ->where("b.sign_del=1 {$key} {$key2}".$str1['str'].$time['str'])
        ->count();
        $pageSize = 24;
        $page = page($count,$pageSize);
        $data = $model
        ->limit($page['first'].",".$page['list'])
        ->order("b.sign_id desc")
        ->table("zhiyan_sign b")
        ->where("b.sign_del=1 {$key} {$key2}".$str1['str'].$time['str'])
        ->select();
        foreach($data as $k=>$v){
        	$data[$k]['sign_start_time'] = date("Y-m-d",$v['sign_start_time']);
        	$data[$k]['sign_end_time'] = date("Y-m-d",$v['sign_end_time']);
        	$data[$k]['create_time'] = date("Y-m-d",$v['create_time']);
        	$data[$k]['customer_name'] = M("customer")
        		->where("customer_id='{$v['customer_id']}'")
        		->getField("customer_name");
        }
        $arr["total"] = $count;
        $arr["sign"] = $data;
        $arr["link"] = $page['link'];
        $arr['customer_brand'] = $str1['key'];
        $arr['from'] = $time['from'];
        $arr['to'] = $time['to'];
        return $arr;
	}

	public function get_sign_mod_save(){
		$sign = M("sign");
		$arr['sign_name'] = $_POST['sign_name'];
		$arr['sign_text'] = $_POST['sign_text'];
		$map1['customer_company'] = $_POST['customer'];
		$arr["customer_id"] = M("customer")->where($map1)->getField("customer_id");
		$arr["sign_start_time"] = strtotime($_POST['start_time']);
		$arr["sign_end_time"] = strtotime($_POST['end_time']);
		$arr["member_id"] = $_SESSION['admin']['member']['member_id'];
		$map['sign_id'] = $_POST['sign_id'];
		if(array_filter($_FILES['sign_pic'])){
			$arr['sign_pic'] = upload_one($_FILES['sign_pic'],"zhiyan/upload/sign_pic");
			$dir = M('sign')->where($map)->getField("sign_pic");
			if($dir){
				unlink("{$dir}");
			}
		}
		$result = $sign->where($map)->save($arr);
		logs("编辑签约");
		add($result,"编辑成功","编辑失败");
	}

	public function get_sign_del(){
		$id = $_POST['id'];
		$sign = M("sign");
		$arr['sign_del'] = 2;
		$flag = $sign->where("sign_id in ($id)")->save($arr);
		logs("删除签约");
		add($flag,"删除成功","删除失败");
	}


}
