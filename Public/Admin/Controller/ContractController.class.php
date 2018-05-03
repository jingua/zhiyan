<?php
namespace Admin\Controller;
use Think\Controller;
class ContractController extends CommonController{
/************************************************ 合同管理模块 ****************************************/
	 /**
     * method  合同列表
     * author  xiami
     * date    2018-03-28
     */
	public function contract_list(){
		$contract = D("Contract");
		$data = $contract->get_contract_list();
        $this->assign("contract",$data);
		$this->display("contract_list");
	}

	/**
     * method  删除合同
     * author  xiami
     * date    2018-03-29
     */
	public function contract_del(){
		$contract = D("Contract");
		$contract->get_contract_del();
	}

}