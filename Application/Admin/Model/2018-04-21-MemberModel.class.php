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
		logs("删除成员");
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
		$str = '';
		$str1 = '';
		$str = search_time("b.create_time","from","to");
		$str1 = search_time("update_time","from","to");
		/////////////////////////绩效统计导出表格 begin 
		$member = M("member")->field("member_id,parent_id,member_name")->where("member_del=1")->select();
		foreach($member as $k1 => $v1){
			$member[$k1]['business'] = $model
				->field("t.*,b.remind_time,b.business_wfk,b.business_total,b.contract_id,b.member_id,b.customer_id,b.business_fkx,b.update_time,b.pay_id,b.create_time")
				->table("zhiyan_business b, zhiyan_business_time t")
				->where("b.business_del=1 and b.business_id=t.business_id and b.member_id='{$v1['member_id']}'".$str['str'])
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
					//判断发放或待申请 
					if($v2['business_wfk'] == 0){
						$member[$k1]['business'][$k2]['business_wfk'] = "发放";
					}else{
						$member[$k1]['business'][$k2]['business_wfk'] = "待申请";
					}
					//查询渠道 
					$member[$k1]['business'][$k2]['channel_name'] = M("channel")
						->where("channel_id='{$v2['channel_id']}'")
						->getField("channel_name");
					//查询成员所有渠道编号 
					$channel = M("channel")
						->where("member_id='{$v2['member_id']}'")
						->getField("channel_id",true);
					//判断是否本人渠道 
					if(in_array($v2['channel_id'],$channel)){
						if($v2['time_text'] == 'first'){
							$member[$k1]['business'][$k2]['time_text'] = "头条";
							$member[$k1]['business'][$k2]['zhibiao'] = 2;
							$member[$k1]['business'][$k2]['zhibiao_dc'] = 2*$v2['time_price'];
							$member[$k1]['business'][$k2]['time_total'] = M("channel")
								->where("channel_id='{$v2['channel_id']}'")
								->getField("price_first"); //总金额
						}else{
							$member[$k1]['business'][$k2]['time_text'] = "次条";
							$member[$k1]['business'][$k2]['zhibiao'] = 1;
							$member[$k1]['business'][$k2]['zhibiao_dc'] = 1*$v2['time_price'];
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
					//查询客户信息 
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
		}
		//p($member);
		/////////////////////////////////////////////绩效统计导出表格 end 
	    ///////计算绩效指标考核（合计总指标、可发放指标、待申请指标、年框KPI）begin
	    foreach($member as $k3 => $v3){
	    	$member[$k3]['tj_zhibiao'] = $model
				->field("t.*,b.business_wfk,b.member_id,b.create_time")
				->table("zhiyan_business b, zhiyan_business_time t")
				->where("b.business_del=1 and b.business_id=t.business_id and b.member_id='{$v3['member_id']}'".$str['str'])
				->select();
			//查询签约合同通过合同
			$sign = M("sign")
				->field("sign_id")
				->where("sign_del=1 and sign_status=2 and member_id='{$v3['member_id']}'".$str1['str'])
				->select();
			$member[$k3]['qianque_fafang'] = count($sign)*0.6; //可发放指标（年框）
			//查询签约合同申请中合同
			$sign = M("sign")
				->field("sign_id")
				->where("sign_del=1 and sign_status=1 and member_id='{$v3['member_id']}'".$str1['str'])
				->select();
			$member[$k3]['qianque_shenqingzhong'] = count($sign)*0.6; //待申请指标（年框）
			////////////////////////////////////////////////////////查询年框公司
			$member[$k3]['sign_company'] = $model
				->field("c.customer_company")
				->table("zhiyan_sign s, zhiyan_customer c")
				->where("s.sign_status=2 and s.member_id='{$v3['member_id']}' and s.customer_id=c.customer_id")
				->select();
			///////////////////////////////////////////////////////注释说明
			$member[$k3]['member_text'] = "注：\n1.公众号名称务必填写完整\n2.已经有填写内容的选项框会自动根据业务人员填写的数据自动生成相应的正确结果\n3.尾款日期一定要按照所示填写\n4.如若业务量过大，表格不够填写，可直接在表格下方添加若干行，直接下拉带有公式的单元格即可复制相应的计算公式\n5.该表格为试行阶段，欢迎大家多多提建议，有特殊情况麻烦告知，谢谢\n6.将年匡客户名称填充";
			//发放变量设置	
			$zhibiao_fafang_total = 0;
			$zhibiao_shenqingzhong_total = 0;
			$zhibiao_fafang1 = 0;
			$zhibiao_fafang2 = 0;
			$zhibiao_fafang3 = 0;
			$zhibiao_fafang4 = 0;
			$zhibiao_shenqingzhong1 = 0;
			$zhibiao_shenqingzhong2 = 0;
			$zhibiao_shenqingzhong3 = 0;
			$zhibiao_shenqingzhong4 = 0;
			//定义总金额变量
			$first_price_total = 0;
			$end_price_total = 0;
			$first_price1 = 0;
			$end_price1 = 0;
			$first_price2 = 0;
			$end_price2 = 0;
			foreach($member[$k3]['tj_zhibiao'] as $k4 => $v4){
				//查询成员所有渠道编号 
				$channel = M("channel")
					->where("member_id='{$v4['member_id']}'")
					->getField("channel_id",true);
				//判断是发放还是申请中（发放）
				if($v4['business_wfk'] == 0){
					///////////////////////////可发放指标（总金额）
					if($v4['time_text'] == 'first'){
						///////////////////////////可发放指标（总金额）
						$first1 = M("channel")
							->where("channel_id='{$v4['channel_id']}'")
							->find();
						$first_price1 = $first_price1 + $first1['price_first'];
					}else{
						///////////////////////////可发放指标（总金额）
						$end1 = M("channel")
							->where("channel_id='{$v4['channel_id']}'")
							->find();
						$end_price1 = $end_price1 + $end1['price_end'];	
					}
					//判断是否本人渠道 
					if(in_array($v4['channel_id'],$channel)){
						if($v4['time_text'] == 'first'){
							//$member[$k3]['tj_zhibiao'][$k4]['zhibiao_fafang'] = 2*$v4['time_price'];
							$zhibiao_fafang1 = $zhibiao_fafang1 + 2*$v4['time_price'];
							///////////////////////////可发放指标（总金额）
							//$channel_price = M("channel")->where("channel_id='{$v4['channel_id']}'")
						}else{
							//$member[$k3]['tj_zhibiao'][$k4]['zhibiao_fafang'] = 1*$v4['time_price'];
							$zhibiao_fafang2 = $zhibiao_fafang2 + 1*$v4['time_price'];
							///////////////////////////可发放指标（总金额）
						}
					}else{
						if($v4['time_text'] == 'first'){
							//$member[$k3]['tj_zhibiao'][$k4]['zhibiao_fafang'] = 2*0.8*$v4['time_price'];
							$zhibiao_fafang3 = $zhibiao_fafang3 + 2*0.8*$v4['time_price'];
							///////////////////////////可发放指标（总金额）
						}else{
							//$member[$k3]['tj_zhibiao'][$k4]['zhibiao_fafang'] = 1*0.8*$v4['time_price'];
							$zhibiao_fafang4 = $zhibiao_fafang4 + 1*0.8*$v4['time_price'];
							///////////////////////////可发放指标（总金额）
						}
					}
				//判断是发放还是申请中（申请中）	
				}else{
					///////////////////////////待申请指标（总金额）
					if($v4['time_text'] == 'first'){
						///////////////////////////待申请指标（总金额）
						$first2 = M("channel")
							->where("channel_id='{$v4['channel_id']}'")
							->find();
						$first_price2 = $first_price2 + $first2['price_first'];	
					}else{
						///////////////////////////待申请指标（总金额）
						$end2 = M("channel")
							->where("channel_id='{$v4['channel_id']}'")
							->find();
						$end_price2 = $end_price2 + $end2['price_end'];
					}

					//判断是否本人渠道 
					if(in_array($v4['channel_id'],$channel)){
						if($v4['time_text'] == 'first'){
							//$member[$k3]['tj_zhibiao'][$k4]['zhibiao_shenqingzhong'] = 2*$v4['time_price'];
							$zhibiao_shenqingzhong1 = $zhibiao_shenqingzhong1 + 2*$v4['time_price'];
							///////////////////////////待申请指标（总金额）
						}else{
							//$member[$k3]['tj_zhibiao'][$k4]['zhibiao_shenqingzhong'] = 1*$v4['time_price'];
							$zhibiao_shenqingzhong2 = $zhibiao_shenqingzhong2 + 1*$v4['time_price'];
							///////////////////////////待申请指标（总金额）
						}
					}else{
						if($v4['time_text'] == 'first'){
							//$member[$k3]['tj_zhibiao'][$k4]['zhibiao_shenqingzhong'] = 2*0.8*$v4['time_price'];
							$zhibiao_shenqingzhong3 = $zhibiao_shenqingzhong3 + 2*0.8*$v4['time_price'];
							///////////////////////////待申请指标（总金额）
						}else{
							//$member[$k3]['tj_zhibiao'][$k4]['zhibiao_shenqingzhong'] = 1*0.8*$v4['time_price'];
							$zhibiao_shenqingzhong4 = $zhibiao_shenqingzhong4 + 1*0.8*$v4['time_price'];
							///////////////////////////待申请指标（总金额）
						}
					}
				}	
			}
			$member[$k3]['first_price_total'] = $first_price1 + $end_price1; //可发放指标（总金额）
			$member[$k3]['end_price_total'] = $first_price2 + $end_price2; //待申请指标（总金额）
			$member[$k3]['price_total'] = $member[$k3]['first_price_total'] + $member[$k3]['end_price_total']; //合计总指标（总金额）
			$zhibiao_fafang_total = $zhibiao_fafang1 + $zhibiao_fafang2 + $zhibiao_fafang3 + $zhibiao_fafang4;
			$zhibiao_shenqingzhong_total = $zhibiao_shenqingzhong1 + $zhibiao_shenqingzhong2 + $zhibiao_shenqingzhong3 + $zhibiao_shenqingzhong4;
			$member[$k3]['zhibiao_fafang_total'] = $zhibiao_fafang_total; //可发放指标（指标）
			$member[$k3]['zhibiao_shenqingzhong_total'] = $zhibiao_shenqingzhong_total; //待申请指标（指标）
			$member[$k3]['total_zhibiao'] = $member[$k3]['zhibiao_fafang_total'] + $member[$k3]['zhibiao_shenqingzhong_total']; //合计总指标（指标）
			$member[$k3]['total_qianyue'] = $member[$k3]['qianque_fafang'] + $member[$k3]['qianque_shenqingzhong']; //合计总指标（年框）
			$system = M("system")->where("id=1")->find();
			//计算 超额KPI 绩效奖金 总金额 begin
			//合计总指标绩效奖金
			$jixiao_total = ($member[$k3]['total_zhibiao']+$member[$k3]['total_qianyue'])-$system['left']; //合计总指标（超额）
			$member[$k3]['jixiao_total'] = $jixiao_total; //合计总指标（超额）
			if($jixiao_total >= 0 && $jixiao_total < $system['left']){
				$member[$k3]['jixiao_chaochu_total'] = 0; //合计总指标（绩效奖金）
			}else if($jixiao_total >= $system['left'] && $jixiao_total < $system['middle']){
				$member[$k3]['jixiao_chaochu_total'] = ($jixiao_total-$system['left'])*$system['left_money']; //合计总指标（绩效奖金）
			}else if($jixiao_total >= $system['middle'] && $jixiao_total < $system['right']){
				$member[$k3]['jixiao_chaochu_total'] = ($jixiao_total-$system['middle'])*$system['middle_money']+($system['middle']-$system['left'])*$system['left_money']; //合计总指标（绩效奖金）
			}else if($jixiao_total >= $system['right']){
				$member[$k3]['jixiao_chaochu_total'] = ($jixiao_total-$system['right'])*$system['right_money']+($system['right']-$system['middle'])*$system['middle_money']+($system['middle']-$system['left'])*$system['left_money']; //合计总指标（绩效奖金）
			}
			//可发放指标绩效奖金
			$fafang_total = ($member[$k3]['zhibiao_fafang_total'] + $member[$k3]['qianque_fafang'])-$system['left']; //可发放指标（超额）
			$member[$k3]['jixiao_fafang_total'] = $fafang_total; //可发放指标（超额）
			if($fafang_total >= 0 && $fafang_total < $system['left']){
				$member[$k3]['fafang_chaochu_total'] = 0; //可发放指标（绩效奖金）
			}else if($fafang_total >= $system['left'] && $fafang_total < $system['middle']){
				$member[$k3]['fafang_chaochu_total'] = ($fafang_total-$system['left'])*$system['left_money']; //可发放指标（绩效奖金）
			}else if($fafang_total >= $system['middle'] && $fafang_total < $system['right']){
				$member[$k3]['fafang_chaochu_total'] = ($fafang_total-$system['middle'])*$system['middle_money']+($system['middle']-$system['left'])*$system['left_money']; //可发放指标（绩效奖金）
			}else if($fafang_total >= $system['right']){
				$member[$k3]['fafang_chaochu_total'] = ($fafang_total-$system['right'])*$system['right_money']+($system['right']-$system['middle'])*$system['middle_money']+($system['middle']-$system['left'])*$system['left_money']; //可发放指标（绩效奖金）
			}
			//待申请指标绩效奖金
			$shenqingzhong_total = ($member[$k3]['zhibiao_shenqingzhong_total'] + $member[$k3]['qianque_shenqingzhong'])-$system['left']; //待申请指标（超额）
			$member[$k3]['jixiao_shenqingzhong_total'] = $shenqingzhong_total; //待申请指标（超额）
			if($shenqingzhong_total >= 0 && $shenqingzhong_total < $system['left']){
				$member[$k3]['shenqingzhong_chaochu_total'] = 0; //待申请指标（绩效奖金）
			}else if($shenqingzhong_total >= $system['left'] && $shenqingzhong_total < $system['middle']){
				$member[$k3]['shenqingzhong_chaochu_total'] = ($shenqingzhong_total-$system['left'])*$system['left_money']; //待申请指标（绩效奖金）
			}else if($shenqingzhong_total >= $system['middle'] && $shenqingzhong_total < $system['right']){
				$member[$k3]['shenqingzhong_chaochu_total'] = ($shenqingzhong_total-$system['middle'])*$system['middle_money']+($system['middle']-$system['left'])*$system['left_money']; //待申请指标（绩效奖金）
			}else if($shenqingzhong_total >= $system['right']){
				$member[$k3]['shenqingzhong_chaochu_total'] = ($shenqingzhong_total-$system['right'])*$system['right_money']+($system['right']-$system['middle'])*$system['middle_money']+($system['middle']-$system['left'])*$system['left_money']; //待申请指标（绩效奖金）
			}
			//p($system);
			//计算 超额KPI 绩效奖金 总金额 end
	    }
	   ///////计算绩效指标考核（合计总指标、可发放指标、待申请指标、年框KPI）end
	   //p($member);
	   return $member;
	}

	//渠道统计
	public function get_channel(){
		$from = $_POST['from'];
		$to = $_POST['to'];
		$str = '';
		$str1 = '';
		$str = search_time("b.create_time","from","to");
		$str1 = search_time("update_time","from","to");
		$model = M();
		$channel = M("channel")
			->field("channel_id,channel_name,price_first,price_end")
			->where("channel_del=1")
			->select();
		foreach($channel as $k1 => $v1){
			$channel[$k1]['list'] = $model
				->field("b.customer_id,b.member_id,b.business_total,t.*")
				->where("b.business_del=1 and b.business_id=t.business_id and t.channel_id='{$v1['channel_id']}'".$str['str'])
				->table("zhiyan_business b, zhiyan_business_time t")
				->select();
			$total1 = 0;
			$total2 = 0;
			$total3 = 0;
			foreach($channel[$k1]['list'] as $k2 => $v2){
				$channel[$k1]['list'][$k2]['member_name'] = M('member')->where("member_id='{$v2['member_id']}'")->getField("member_name"); //对接人
				if($v2['time_text'] == 'first'){
					$channel[$k1]['list'][$k2]['price_total'] = ($v1['price_first']-$v2['invoice_price']); //成交额
					$channel[$k1]['list'][$k2]['position'] = "头条"; //投放位置
					$total2 = $total2 + ($v1['price_first']-$v2['invoice_price']);
				}else{
					$channel[$k1]['list'][$k2]['price_total'] = ($v1['price_end']-$v2['invoice_price']); //成交额
					$channel[$k1]['list'][$k2]['position'] = "次条"; //投放位置
					$total3 = $total3 + ($v1['price_end']-$v2['invoice_price']);
				}
				$channel[$k1]['list'][$k2]['customer_company'] = M("customer")->where("customer_id='{$v2['customer_id']}'")->getField("customer_company"); //对接公司
				$channel[$k1]['list'][$k2]['customer_brand'] = M("customer")->where("customer_id='{$v2['customer_id']}'")->getField("customer_brand"); //合作品牌
				$channel[$k1]['list'][$k2]['time_time'] = date("Y/m/d",$v2['time_time']); //投放时间
				$total1 = $total1 + $v2['business_total'];
			}
			$channel[$k1]['total_cjje'] = $total1; //成交金额统计
			$channel[$k1]['total_cje'] = $total2 + $total3; //成交额统计
		}
		return $channel;
	}

	public function get_member_parent(){
		/*$parent_id = array_filter(M("member")->where("member_del=1")->getField("parent_id",true));
		$id = implode(",",$parent_id);
		$member = M("member")->where("parent_id in($id)")->select();
		foreach($member as $k1 => $v1){
			$member[$k1]['parent_name'] = M("member")->where("member_id='{$v1['parent_id']}'")->getField("member_name");
			$member[$k1]['id'] = $v1['member_id'].",".$v1['parent_id'];
			$member[$k1]['name'] = $v1['member_name']."+".M("member")->where("member_id='{$v1['parent_id']}'")->getField("member_name");
		}*/
		
	}

}
