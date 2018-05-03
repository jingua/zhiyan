<?php
namespace Admin\Controller;
use Think\Controller;
class LogController extends CommonController{
/************************************************ 系统日志管理模块 ****************************************/
	 /**
     * method  日志列表
     * author  xiami
     * date    2018-03-23
     */
	public function log_list(){
		$log = D("Log");
		$data = $log->get_log_list();
        $this->assign("log",$data);
		$this->display("log_list");
	}

	 /**
     * method  删除日志
     * author  xiami
     * date    2018-03-23
     */
	public function log_del(){
		$log = D("Log");
		$log->get_log_del();
	}

	
}