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

	public function get_excel_down_xls(){
		$model = M();
		$from = $_POST['from'];
		$to = $_POST['to'];
		/* 绩效统计导出表格 begin */
		$member = M("member")->field("member_id,parent_id,member_name")->where("member_del=1")->select();
		foreach($member as $k1 => $v1){
			$member[$k1]['business'] = $model
				->field("t.*,b.remind_time,b.business_wfk,b.business_total,b.contract_id,b.member_id,customer_id,b.business_fkx,b.update_time,b.pay_id")
				->table("zhiyan_business b, zhiyan_business_time t")
				->where("b.business_del=1 and b.business_id=t.business_id and b.member_id='{$v1['member_id']}'")
				->select();
				foreach($member[$k1]['business']  as $k2 => $v2){
					$member[$k1]['business'][$k2]['remind_time'] = date("Y年m月",$v2['remind_time']);//尾款日期
					$member[$k1]['business'][$k2]['time_time'] = date("Y/m/d",$v2['time_time']);//投放时间
					$member[$k1]['business'][$k2]['update_time'] = date("Y/m/d",$v2['update_time']);//预付日期
					$member[$k1]['business'][$k2]['business_tfcs'] = 1; //投放次数
					$member[$k1]['business'][$k2]['business_cjje'] = $v2['business_total']-$v2['invoice_price'];//成交金额
					$member[$k1]['business'][$k2]['pay_name'] = M("payment")->where("pay_id='{$v2['pay_id']}'")->getField("pay_name");//支付方式
					$pay = M("pay")
						->where("pay_del=1 and pay_status=2 and business_id='{$v2['business_id']}'")
						->field("pay_price,sum(pay_price) as pay_total")
						->select();
					$member[$k1]['business'][$k2]['business_fandian'] = $pay['0']['pay_total'];//返点
					if($v2['business_total'] == $v2['business_wfk']){
						$member[$k1]['business'][$k2]['business_fkqk'] = 0;//预付情况
						$member[$k1]['business'][$k2]['business_weikuan'] = $v2['business_total'];//尾款
					}else{
						$member[$k1]['business'][$k2]['business_fkqk'] = $v2['business_total']-$v2['business_wfk'];//预付情况
						$member[$k1]['business'][$k2]['business_weikuan'] = $v2['business_total']-$member[$k1]['business'][$k2]['business_fkqk'];//尾款
					}
					/* 判断发放或待申请 */
					if($v2['business_wfk'] == 0){
						$member[$k1]['business'][$k2]['business_wfk'] = "发放";
					}else{
						$member[$k1]['business'][$k2]['business_wfk'] = "待申请";
					}
					/* 查询渠道 */
					$member[$k1]['business'][$k2]['channel_name'] = M("channel")
						->where("channel_id='{$v2['channel_id']}'")
						->getField("channel_name");
					/* 查询成员所有渠道编号 */
					$channel = M("channel")
						->where("member_id='{$v2['member_id']}'")
						->getField("channel_id",true);
					/* 判断是否本人渠道 */
					if(in_array($v2['channel_id'],$channel)){
						if($v2['time_text'] == 'first'){
							$member[$k1]['business'][$k2]['time_text'] = "头条";
							$member[$k1]['business'][$k2]['zhibiao'] = 2*0.8;
							$member[$k1]['business'][$k2]['zhibiao_dc'] = 2*$v2['time_price']*0.8;
							$member[$k1]['business'][$k2]['time_total'] = M("channel")
								->where("channel_id='{$v2['channel_id']}'")
								->getField("price_first"); //总金额
						}else{
							$member[$k1]['business'][$k2]['time_text'] = "次条";
							$member[$k1]['business'][$k2]['zhibiao'] = 1*0.8;
							$member[$k1]['business'][$k2]['zhibiao_dc'] = 1*$v2['time_price']*0.8;
							$member[$k1]['business'][$k2]['time_total'] = M("channel")
								->where("channel_id='{$v2['channel_id']}'")
								->getField("price_end"); //总金额
						}
					}else{
						if($v2['time_text'] == 'first'){
							$member[$k1]['business'][$k2]['time_text'] = "头条";
							$member[$k1]['business'][$k2]['zhibiao'] = 2*0.8;
							$member[$k1]['business'][$k2]['zhibiao_dc'] = 2*$v2['time_price']*0.8; //指标达成
							$member[$k1]['business'][$k2]['time_total'] = M("channel")
								->where("channel_id='{$v2['channel_id']}'")
								->getField("price_first"); //总金额
						}else{
							$member[$k1]['business'][$k2]['time_text'] = "次条";
							$member[$k1]['business'][$k2]['zhibiao'] = 1*0.8;
							$member[$k1]['business'][$k2]['zhibiao_dc'] = 1*$v2['time_price']*0.8; //指标达成
							$member[$k1]['business'][$k2]['time_total'] = M("channel")
								->where("channel_id='{$v2['channel_id']}'")
								->getField("price_end"); //总金额
						}
					}
					/* 查询客户信息 */
					$customer = M("customer")->where("customer_id='{$v2['customer_id']}'")->find();
					$member[$k1]['business'][$k2]['customer_company'] = $customer['customer_company']; //对接公司
					$member[$k1]['business'][$k2]['customer_brand'] = $customer['customer_brand']; //品牌
					$member[$k1]['business'][$k2]['deal_money'] = $v['business_total']*$v['time_price']; //
					if($v2['contract_id']){
						$member[$k1]['business'][$k2]['contract_name'] = "是"; //合同确认（是/否）
					}else{
						$member[$k1]['business'][$k2]['contract_name'] = "否"; //合同确认（是/否）
					}
			}
			p($member);
		/* 绩效统计导出表格 end */

		}
	}


	public function get_excel_down_xls_back(){
		$model = M();
		$from = $_POST['from'];
		$to = $_POST['to'];

		/* 绩效统计 begin */
		$member = M("member")->field("member_id,parent_id,member_name")->where("member_del=1")->select();
		foreach($member as $k1 => $v1){
			$member[$k1]['business'] = $model
				->field("t.*,b.remind_time,b.business_wfk,b.business_total,b.contract_id,b.member_id,customer_id,b.business_fkx,b.update_time,b.pay_id")
				->table("zhiyan_business b, zhiyan_business_time t")
				->where("b.business_del=1 and b.business_id=t.business_id and b.member_id='{$v1['member_id']}'")
				->select();
				foreach($data  as $k => $v){
					$data[$k]['remind_time'] = date("Y年m月",$v['remind_time']);
					$data[$k]['time_time'] = date("Y/m/d",$v['time_time']);
					$data[$k]['update_time'] = date("Y/m/d",$v['update_time']);
					$data[$k]['business_tfcs'] = 1;
					$data[$k]['business_cjje'] = $v['business_total']-$v['invoice_price'];
					$data[$k]['pay_name'] = M("payment")->where("pay_id='{$v['pay_id']}'")->getField("pay_name");
					$pay = M("pay")
						->where("pay_del=1 and pay_status=2 and business_id='{$v['business_id']}'")
						->field("pay_price,sum(pay_price) as pay_total")
						->select();
					$data[$k]['business_fandian'] = $pay['0']['pay_total'];
					if($v['business_total'] == $v['business_wfk']){
						$data[$k]['business_fkqk'] = 0;
						$data[$k]['business_weikuan'] = $v['business_total'];
					}else{
						$data[$k]['business_fkqk'] = $v['business_total']-$v['business_wfk'];
						$data[$k]['business_weikuan'] = $v['business_total']-$data[$k]['business_fkqk'];
					}
					/* 判断发放或待申请 */
					if($v['business_wfk'] == 0){
						$data[$k]['business_wfk'] = "发放";
					}else{
						$data[$k]['business_wfk'] = "待申请";
					}
					/* 查询渠道 */
					$data[$k]['channel_name'] = M("channel")
						->where("channel_id='{$v['channel_id']}'")
						->getField("channel_name");
					/* 查询成员所有渠道编号 */
					$channel = M("channel")
						->where("member_id='{$v['member_id']}'")
						->getField("channel_id",true);
					/* 判断是否本人渠道 */
					if(in_array($v['channel_id'],$channel)){
						/* 判断头条或次条 */
						if($v['time_text'] == 'first'){
							$data[$k]['time_text'] = "头条";
							$data[$k]['zhibiao'] = 2*0.8;
							$data[$k]['zhibiao_dc'] = 2*$v['time_price']*0.8;
							$data[$k]['time_total'] = M("channel")
								->where("channel_id='{$v['channel_id']}'")
								->getField("price_first");
						}else{
							$data[$k]['time_text'] = "次条";
							$data[$k]['zhibiao'] = 1*0.8;
							$data[$k]['zhibiao_dc'] = 1*$v['time_price']*0.8;
							$data[$k]['time_total'] = M("channel")
								->where("channel_id='{$v['channel_id']}'")
								->getField("price_end");
						}
					}else{
						/* 判断头条或次条 */
						if($v['time_text'] == 'first'){
							$data[$k]['time_text'] = "头条";
							$data[$k]['zhibiao'] = 2*0.8;
							$data[$k]['zhibiao_dc'] = 2*$v['time_price']*0.8;
							$data[$k]['time_total'] = M("channel")
								->where("channel_id='{$v['channel_id']}'")
								->getField("price_first");
						}else{
							$data[$k]['time_text'] = "次条";
							$data[$k]['zhibiao'] = 1*0.8;
							$data[$k]['zhibiao_dc'] = 1*$v['time_price']*0.8;
							$data[$k]['time_total'] = M("channel")
								->where("channel_id='{$v['channel_id']}'")
								->getField("price_end");
						}
					}
					/* 查询客户信息 */
					$customer = M("customer")->where("customer_id='{$v['customer_id']}'")->find();
					$data[$k]['customer_company'] = $customer['customer_company'];
					$data[$k]['customer_brand'] = $customer['customer_brand'];
					$data[$k]['deal_money'] = $v['business_total']*$v['time_price'];
					if($v['contract_id']){
						$data[$k]['contract_name'] = "是";
					}else{
						$data[$k]['contract_name'] = "否";
					}
				}
		}
		p($member);
		/* 绩效统计 end */

		//导出表格
		$arr = array();
		$cell_name  = "绩效核算";
        $cell  = array(
            array('update_time','预付日期'),
            array('remind_time','尾款日期'),
            array('time_time','投放时间'),
            array('business_wfk','业绩核算'),
            array('channel_name','公众号'),
            array('time_text','位置'),
            array('zhibiao','指标'),
            array('customer_company','对接公司'),
            array('customer_brand','品牌'),
            array('time_total','总金额'),
            array('time_price','折扣'),
            array('business_fandian','返点'),
            array('pay_name','支付方式'),
            array('business_cjje','成交金额'),
            array('business_tfcs','投放次数'),
            array('business_fkqk','预付情况'),
            array('business_weikuan','尾款'),
            array('invoice_price','票点'),
            array('business_total','合计金额'),
            array('zhibiao_dc','指标达成'),
            array('contract_name','合同确认（是/否）'),
        );
		$data = $model
			->field("t.*,b.remind_time,b.business_wfk,b.business_total,b.contract_id,b.member_id,customer_id,b.business_fkx,b.update_time,b.pay_id")
			->table("zhiyan_business b, zhiyan_business_time t")
			->where("b.business_del=1 and b.business_id=t.business_id")
			->select();
		foreach($data  as $k => $v){
			$data[$k]['remind_time'] = date("Y年m月",$v['remind_time']);
			$data[$k]['time_time'] = date("Y/m/d",$v['time_time']);
			$data[$k]['update_time'] = date("Y/m/d",$v['update_time']);
			$data[$k]['business_tfcs'] = 1;
			$data[$k]['business_cjje'] = $v['business_total']-$v['invoice_price'];
			$data[$k]['pay_name'] = M("payment")->where("pay_id='{$v['pay_id']}'")->getField("pay_name");
			$pay = M("pay")
				->where("pay_del=1 and pay_status=2 and business_id='{$v['business_id']}'")
				->field("pay_price,sum(pay_price) as pay_total")
				->select();
			$data[$k]['business_fandian'] = $pay['0']['pay_total'];
			if($v['business_total'] == $v['business_wfk']){
				$data[$k]['business_fkqk'] = 0;
				$data[$k]['business_weikuan'] = $v['business_total'];
			}else{
				$data[$k]['business_fkqk'] = $v['business_total']-$v['business_wfk'];
				$data[$k]['business_weikuan'] = $v['business_total']-$data[$k]['business_fkqk'];
			}
			/* 判断发放或待申请 */
			if($v['business_wfk'] == 0){
				$data[$k]['business_wfk'] = "发放";
			}else{
				$data[$k]['business_wfk'] = "待申请";
			}
			/* 查询渠道 */
			$data[$k]['channel_name'] = M("channel")
				->where("channel_id='{$v['channel_id']}'")
				->getField("channel_name");
			/* 查询成员所有渠道编号 */
			$channel = M("channel")
				->where("member_id='{$v['member_id']}'")
				->getField("channel_id",true);
			/* 判断是否本人渠道 */
			if(in_array($v['channel_id'],$channel)){
				/* 判断头条或次条 */
				if($v['time_text'] == 'first'){
					$data[$k]['time_text'] = "头条";
					$data[$k]['zhibiao'] = 2*0.8;
					$data[$k]['zhibiao_dc'] = 2*$v['time_price']*0.8;
					$data[$k]['time_total'] = M("channel")
						->where("channel_id='{$v['channel_id']}'")
						->getField("price_first");
				}else{
					$data[$k]['time_text'] = "次条";
					$data[$k]['zhibiao'] = 1*0.8;
					$data[$k]['zhibiao_dc'] = 1*$v['time_price']*0.8;
					$data[$k]['time_total'] = M("channel")
						->where("channel_id='{$v['channel_id']}'")
						->getField("price_end");
				}
			}else{
				/* 判断头条或次条 */
				if($v['time_text'] == 'first'){
					$data[$k]['time_text'] = "头条";
					$data[$k]['zhibiao'] = 2*0.8;
					$data[$k]['zhibiao_dc'] = 2*$v['time_price']*0.8;
					$data[$k]['time_total'] = M("channel")
						->where("channel_id='{$v['channel_id']}'")
						->getField("price_first");
				}else{
					$data[$k]['time_text'] = "次条";
					$data[$k]['zhibiao'] = 1*0.8;
					$data[$k]['zhibiao_dc'] = 1*$v['time_price']*0.8;
					$data[$k]['time_total'] = M("channel")
						->where("channel_id='{$v['channel_id']}'")
						->getField("price_end");
				}
			}
			/* 查询客户信息 */
			$customer = M("customer")->where("customer_id='{$v['customer_id']}'")->find();
			$data[$k]['customer_company'] = $customer['customer_company'];
			$data[$k]['customer_brand'] = $customer['customer_brand'];
			$data[$k]['deal_money'] = $v['business_total']*$v['time_price'];
			if($v['contract_id']){
				$data[$k]['contract_name'] = "是";
			}else{
				$data[$k]['contract_name'] = "否";
			}
		}
		$arr['cell_name'] = $cell_name;
		$arr["cell"] = $cell;
		$arr["data"] = $data;
		return $arr;
	}

}
