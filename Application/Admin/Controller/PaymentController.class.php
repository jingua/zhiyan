<?php
namespace Admin\Controller;
use Think\Controller;
class PaymentController extends CommonController{
/************************************************ 支付方式管理模块 ****************************************/
	 /**
     * method  添加支付方式模板
     * author  xiami
     * date    2018-04-13
     */
	public function pay_add(){
		$this->display("pay_add");
	}

	 /**
     * method  执行数据添加
     * author  xiami
     * date    2018-04-13
     */
	public function pay_add_save(){
		$pay = D("Payment");
		$pay->get_pay_add_save();
	}

	 /**
     * method  支付方式列表
     * author  xiami
     * date    2018-04-13
     */
	public function pay_list(){
		$pay = D("Payment");
		$data = $pay->get_pay_list();
        $this->assign("pay",$data);
		$this->display("pay_list");
	}

	 /**
     * method  编辑支付方式模板
     * author  xiami
     * date    2018-04-13
     */
	public function pay_mod(){
		$pay = D("Payment");
		$data = $pay->get_pay_mod();
		$this->assign("pay", $data);
		$this->display("pay_mod");
	}

	 /**
     * method  执行支付方式编辑
     * author  xiami
     * date    2018-04-13
     */
	public function pay_mod_save(){
		$pay = D("Payment");
		$pay->get_pay_mod_save();
	}

	 /**
     * method  删除支付方式
     * author  xiami
     * date    2018-04-13
     */
	public function pay_del(){
		$pay = D("Payment");
		$pay->get_pay_del();
	}

}