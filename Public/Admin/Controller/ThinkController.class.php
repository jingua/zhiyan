<?php
namespace Admin\Controller;
use Think\Controller;
class ThinkController extends CommonController{
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
		$channel = M("channel")->field("channel_id,channel_name")->where("channel_id in ({$id})")->select();
		$customer = M("customer")->where("customer_del=1")->select();
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
		$str1 = search_like("customer_name","kehu");
		$customer = M("customer")->field("customer_id,customer_name")->where("1=1".$str1['str'])->select();
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
		$this->assign("id",$_GET['id']);
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
     * method  编辑客户模板
     * author  xiami
     * date    2018-03-23
     */
	public function customer_mod(){
		$customer = D("Customer");
		$data = $customer->get_customer_mod();
		$this->assign("customer",$data);
		$this->display("customer_mod");
	}

	 /**
     * method  执行客户编辑
     * author  xiami
     * date    2018-03-23
     */
	public function customer_mod_save(){
		$customer = D("Customer");
		$customer->get_customer_mod_save();
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

}