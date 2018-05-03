<?php
namespace Admin\Controller;
use Think\Controller;
class BusinessController extends CommonController{
/************************************************ 业务管理模块 ****************************************/
	 /**
     * method  选择渠道模板
     * author  xiami
     * date    2018-03-23
     */
	public function channel_list(){
		$channel = D("Channel");
		$data = $channel->get_channel_list();
		$type = M("channelType")->where("type_del=1")->select();
		$province = M("province")->where("parent=1")->select();
		$this->assign("provice",$province);
		$this->assign("type",$type);
        $this->assign("channel",$data);
        $this->assign('province','-1');
		$this->assign('city','-1');
		$this->assign('block','-1');
		$this->display("channel_list");
	}

	 /**
     * method  添加业务模板
     * author  xiami
     * date    2018-03-23
     */
	public function business_add(){
		$id = $_GET['id'];
		$business = D("Business");
		$channel = M("channel")->field("channel_id,channel_name")->where("channel_id in ({$id})")->select();
		$customer = $business->get_customer();
		$this->assign("customer",$customer);
		$this->assign("channel",$channel);
		$this->display("business_add");
	}

	 /**
     * method  执行业务添加
     * author  xiami
     * date    2018-03-26
     */
	public function business_add_save(){
		$business = D("Business");
		$business->get_business_add_save();
	}

	 /**
     * method  搜索客户
     * author  xiami
     * date    2018-03-24
     */
	public function search_business(){
		$str = '';
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
		$str1 = search_like("customer_company","kehu");
		$customer = M("customer")
		->field("member_id,customer_id,customer_company")
		->where("customer_del=1".$key.$key2.$str1['str'])
		->select();
		echo json_encode($customer);
	}

	/**
     * method  显示投放时间
     * author  xiami
     * date    2018-03-26
     */
	public function business_time(){
		$business = D("Business");
		$id = $_REQUEST['business_id'];
		$data = $business->get_business_time();
		$this->assign("time", $data);
		$this->display("business_time");
	}

	/**
     * method  已结算设置
     * author  xiami
     * date    2018-03-26
     */
	public function time_start(){
		D("Business")->get_time_start();
	}

	/**
     * method  未结算设置
     * author  xiami
     * date    2018-03-26
     */
	public function time_stop(){
		D("Business")->get_time_stop();
	}

	/**
     * method  支出管理
     * author  xiami
     * date    2018-03-26
     */
	public function business_pay(){
		$pay = M("pay")->where("pay_del=1 and business_id='{$_GET['id']}'")->select();
		$this->assign("pay",$pay);
		$this->assign("id",$_GET['id']);
		$this->display("business_pay");
	}

	/**
     * method  添加支出
     * author  xiami
     * date    2018-03-26
     */
	public function business_pay_save(){
		$pay = D("Business");
		$pay->get_business_pay_save();
	}

	/**
     * method  删除支出
     * author  xiami
     * date    2018-03-26
     */
	public function pay_del(){
		$id = $_REQUEST['id'];
		$business_id = $_REQUEST['business_id'];
		$pay = M("pay");
		$arr['pay_del'] = 2;
		$flag = $pay->where("pay_id in ($id)")->save($arr);
		$this->redirect('Business/business_pay',array('id'=>$business_id));
	}

	/**
     * method  申请收款
     * author  xiami
     * date    2018-03-26
     */
	public function business_price(){
		$pay = M("payment")->where("pay_del=1")->select();
		$this->assign("id",$_GET['id']);
		$this->assign("pay",$pay);
		$this->display("business_price");
	}

	/**
     * method  添加申请收款
     * author  xiami
     * date    2018-03-26
     */
	public function business_price_save(){
		$pay = D("Business");
		$pay->get_business_price_save();
	}

	/**
     * method  上传合同模板
     * author  xiami
     * date    2018-03-28
     */
	public function business_contract(){
		$this->assign("id",$_GET['id']);
		$this->display("business_contract");
	}

	/**
     * method  执行合同上传
     * author  xiami
     * date    2018-03-28
     */
	public function business_upload_save(){
		$contract = D("Business");
		$contract->get_business_upload_save();
	}

	/**
     * method  重新上传合同模板
     * author  xiami
     * date    2018-03-29
     */
	public function business_recontract(){
		$this->assign("id",$_GET['id']);
		$this->display("business_recontract");
	}

	/**
     * method  执行重新合同上传
     * author  xiami
     * date    2018-03-29
     */
	public function business_reupload_save(){
		$contract = D("Business");
		$contract->get_business_reupload_save();
	}

	 /**
     * method  业务列表
     * author  xiami
     * date    2018-03-26
     */
	public function business_list(){
		$business = D("Business");
		$data = $business->get_business_list();
        $this->assign("business",$data);
		$this->display("business_list");
	}

	 /**
     * method  编辑业务模板
     * author  xiami
     * date    2018-03-30
     */
	public function business_mod(){
		$business = D("Business");
		$data = $business->get_business_mod();
		$customer = $business->get_customer();
		$time = $business->get_business_time_mod();
		$this->assign("time",$time);
		$this->assign("customer",$customer);
		$this->assign("business",$data);
		$this->display("business_mod");
	}

	 /**
     * method  执行业务编辑
     * author  xiami
     * date    2018-03-30
     */
	public function business_mod_save(){
		$business = D("Business");
		$business->get_business_mod_save();
	}

	 /**
     * method  申请删除
     * author  xiami
     * date    2018-03-28
     */
	public function business_redel(){
		$business = D("Business");
		$business->get_business_redel();
	}

	/**
     * method  添加签约模板
     * author  xiami
     * date    2018-04-24
     */
	public function sign_add(){
		$id = $_GET['id'];
		$customer = M("customer")->where("customer_del=1")->select();
		$this->assign("customer",$customer);
		$this->display("sign_add");
	}

	/**
     * method  执行签约添加
     * author  xiami
     * date    2018-04-24
     */
	public function sign_add_save(){
		$sign = D("Business");
		$sign->get_sign_add_save();
	}

	/**
     * method  签约列表
     * author  xiami
     * date    2018-04-04
     */
	public function sign_list(){
		$sign = D("Business");
		$data = $sign->get_sign_list();
        $this->assign("sign",$data);
		$this->display("sign_list");
	}

	/**
     * method  编辑签约模板
     * author  xiami
     * date    2018-04-24
     */
	public function sign_mod(){
		$map['sign_id'] = $_GET['sign_id'];
		$data = M("sign")->where($map)->find();
		$data['customer_name'] = M("customer")
			->where("customer_id='{$data['customer_id']}'")
			->getField("customer_company");
		$customer = M("customer")->where("customer_del=1")->select();
		$this->assign("customer",$customer);
		$this->assign("sign",$data);
		$this->display("sign_mod");
	}

	/**
     * method  执行签约编辑
     * author  xiami
     * date    2018-04-24
     */
	public function sign_mod_save(){
		$sign = D("Business");
		$sign->get_sign_mod_save();
	}

	/**
     * method  删除签约
     * author  xiami
     * date    2018-04-04
     */
	public function sign_del(){
		$sign = D("Business");
		$sign->get_sign_del();
	}


}