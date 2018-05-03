<?php
namespace Admin\Controller;
use Think\Controller;
class PropertyController extends CommonController{
/************************************************ 审核管理模块 ****************************************/
	 /**
     * method  审核收款列表
     * author  xiami
     * date    2018-03-29
     */
	public function property_list(){
		$property = D("Property");
		$data = $property->get_property_list();
		$this->assign("property",$data);
		$this->display("property_list");
	}

	/**
     * method  收款记录列表
     * author  xiami
     * date    2018-03-28
     */
	public function property_list_remember(){
		$property = D("Property");
		$data = $property->get_property_list_remember();
		$this->assign("property",$data);
		$this->display("property_list_remember");
	}

	 /**
     * method  确定审核收款
     * author  xiami
     * date    2018-03-28
     */
	public function property_save(){
		$property = D("Property");
		$property->get_property_save();
	}

	 /**
     * method  审核业务列表
     * author  xiami
     * date    2018-03-28
     */
	public function business_list(){
		$business = D("Property");
		$data = $business->get_business_list();
        $this->assign("business",$data);
		$this->display("business_list");
	}

	/**
     * method  删除申请业务
     * author  xiami
     * date    2018-03-28
     */
	public function business_del(){
		$business = D("Property");
		$business->get_business_del();
	}

	/**
     * method  审核渠道列表
     * author  xiami
     * date    2018-03-23
     */
	public function channel_list(){
		$channel = D("Property");
		$data = $channel->get_channel_list();
		$type = M("channelType")->where("type_del=1")->select();
        $this->assign("channel",$data);
		$this->display("channel_list");
	}

	/**
     * method  删除审核渠道
     * author  xiami
     * date    2018-03-28
     */
	public function channel_del(){
		$business = D("Property");
		$business->get_channel_del();
	}

	/**
     * method  支出审核列表
     * author  xiami
     * date    2018-04-03
   	 */
	public function pay_list(){
		$pay = D("Property");
		$data = $pay->get_pay_list();
		$this->assign("pay",$data);
		$this->display("pay_list");
	}

	/**
     * method  审核记录列表
     * author  xiami
     * date    2018-04-04
   	 */
	public function pay_relist(){
		$pay = D("Property");
		$data = $pay->get_pay_relist();
		$this->assign("pay",$data);
		$this->display("pay_relist");
	}

	/**
     * method  支出审核通过
     * author  xiami
     * date    2018-04-03
   	 */
	public function pay_del(){
		$pay = D("Property");
		$data = $pay->get_pay_del();
		$this->display("pay_list");
	}

	/**
     * method  支出审核不通过
     * author  xiami
     * date    2018-04-04
   	 */
	public function pay_redel(){
		$pay = D("Property");
		$data = $pay->get_pay_redel();
		$this->display("pay_list");
	}

	/**
     * method  签约审核列表
     * author  xiami
     * date    2018-04-04
   	 */
	public function contract_list(){
		$sign = D("Property");
		$data = $sign->get_contract_list();
		$this->assign("sign",$data);
		$this->display("contract_list");
	}

	/**
     * method  签约审核通过
     * author  xiami
     * date    2018-04-04
   	 */
	public function sign_del(){
		$sign = D("Property");
		$sign->get_sign_del();
	}

	/**
     * method  签约审核不通过
     * author  xiami
     * date    2018-04-04
   	 */
	public function sign_redel(){
		$pay = D("Property");
		$pay->get_sign_redel();
	}

	/**
     * method  签约记录列表
     * author  xiami
     * date    2018-04-04
   	 */
	public function contract_relist(){
		$sign = D("Property");
		$data = $sign->get_contract_relist();
		$this->assign("sign",$data);
		$this->display("contract_relist");
	}

	/**
     * method  公司盈利
     * author  xiami
     * date    2018-04-04
   	 */
	public function property_money(){
		/* 查询月份总收入与未付款 */
		/*$pro1 = M("property")
			->field("from_unixtime(update_time,'%m') as month,sum(property_total) as total,min(property_come) as come")
			->where("property_status=2")
			->group('month')
			->select();*/
		$pro1 = M("business")
			->field("from_unixtime(create_time,'%m') as month,sum(business_total) as total,sum(business_wfk) as come")
			->where("business_del=1")
			->group('month')
			->select();		
		$arr = array();
		foreach($pro1 as $k => $v){
			$arr[(int)$v['month']]['total']= $v['total']-$v['come'];
			$arr[(int)$v['month']]['come']= $v['come'];
		}
		$str = date("Y-m");
		//当月收入金额
		$pro2 = M("property")
			->field("from_unixtime(update_time,'%Y-%m') as month,sum(property_total) as total")
			->where("property_status=2 and from_unixtime(update_time,'%Y-%m')='{$str}'")
			->select();
		//当月支出金额
		$into = M("pay")
			->field("from_unixtime(pay_time,'%Y-%m') as month,sum(pay_price) as total")
			->where("pay_status=2 and from_unixtime(pay_time,'%Y-%m')='{$str}'")
			->select();
		/* 支出百分比 */
		$intos = round((($into['0']['total']/$pro2['0']['total'])*10000)/100,2);
		/* 利润百分比 */
		$comes = round(((($pro2['0']['total']-$into['0']['total'])/$pro2['0']['total'])*10000)/100,2);
		/* 查询利润与支出 */
		/* 查询月份总收入 */
		$pro3 = M("property")
			->field("property_total,property_come,update_time,from_unixtime(update_time,'%m') as month,sum(property_total) as total,sum(property_come) as come")
			->where("property_status=2")
			->group('month')
			->select();
		$arr1 = array();
		foreach($pro3 as $k => $v){
			$arr1[(int)$v['month']]['total']= $v['total'];
			$arr1[(int)$v['month']]['come']= $v['come'];
		}
		/* 查询月份总支出 */	
		$into1 = M("pay")
			->field("pay_price,from_unixtime(pay_time,'%m') as month,sum(pay_price) as total")
			->where("pay_status=2")
			->group("month")
			->select();
		$arr2 = array();
		foreach($into1 as $k => $v){
			$arr2[(int)$v['month']]['totals']= $v['total'];
		}
		$this->assign("data",$arr);
		$this->assign("arr2",$arr2);
		$this->assign("month",$str);
		$this->assign("pro2",$pro2['0']['total']-$into['0']['total']);
		$this->assign("into",$into['0']['total']);
		$this->assign("intos",$intos);
		$this->assign("comes",$comes);
		$this->display("property_money");
	}

}