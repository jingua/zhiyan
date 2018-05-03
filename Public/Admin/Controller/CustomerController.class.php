<?php
namespace Admin\Controller;
use Think\Controller;
class CustomerController extends CommonController{
/************************************************ 客户管理模块 ****************************************/
	 /**
     * method  添加客户模板
     * author  xiami
     * date    2018-03-23
     */
	public function customer_add(){
		$this->display("customer_add");
	}

	 /**
     * method  执行客户添加
     * author  xiami
     * date    2018-03-23
     */
	public function customer_add_save(){
		$customer = D("Customer");
		$customer->get_customer_add_save();
	}

	 /**
     * method  客户列表
     * author  xiami
     * date    2018-03-23
     */
	public function customer_list(){
		$customer = D("Customer");
		$data = $customer->get_customer_list();
        $this->assign("customer",$data);
		$this->display("customer_list");
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
     * method  删除客户
     * author  xiami
     * date    2018-03-23
     */
	public function customer_del(){
		$customer = D("Customer");
		$customer->get_customer_del();
	}

}