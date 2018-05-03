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

	/**
     * method  显示个人指标设置列表
     * author  xiami
     * date    2018-04-20
     */
	public function set(){
		$one = M("system")->where("id=1")->find();
		$two = M("system")->where("id=2")->find();
		$three = M("system")->where("id=3")->find();
		$this->assign("one",$one);
		$this->assign("two",$two);
		$this->assign("c",$three);
		$this->display("set");
	}

	/**
     * method  执行个人指标设置
     * author  xiami
     * date    2018-04-20
     */
	public function set_one(){
		$left = $_POST['left'];
		$middle = $_POST['middle'];
		$right = $_POST['right'];
		$left_money = $_POST['left_money'];
		$middle_money = $_POST['middle_money'];
		$right_money = $_POST['right_money'];
		if(!empty($left) or !empty($left_money)){
			$arr['left'] = $left;
			$arr['left_money'] = $left_money;
			$res = M("system")->where("id=1")->save($arr);
			logs("设置指标或绩效金额");
			add($res, "设置成功", "设置失败");
		}
		if(!empty($middle) or !empty($middle_money)){
			$arr['middle'] = $middle;
			$arr['middle_money'] = $middle_money;
			$res = M("system")->where("id=1")->save($arr);
			logs("设置指标或绩效金额");
			add($res, "设置成功", "设置失败");
		}
		if(!empty($right) or !empty($right_money)){
			$arr['right'] = $right;
			$arr['right_money'] = $right_money;
			$res = M("system")->where("id=1")->save($arr);
			logs("设置指标或绩效金额");
			add($res, "设置成功", "设置失败");
		}
	}

	/**
     * method  执行绑定关系指标设置
     * author  xiami
     * date    2018-04-20
     */
	public function set_two(){
		$left = $_POST['left'];
		$middle = $_POST['middle'];
		$right = $_POST['right'];
		$left_money = $_POST['left_money'];
		$middle_money = $_POST['middle_money'];
		$right_money = $_POST['right_money'];
		if(!empty($left) or !empty($left_money)){
			$arr['left'] = $left;
			$arr['left_money'] = $left_money;
			$res = M("system")->where("id=2")->save($arr);
			logs("设置指标或绩效金额");
			add($res, "设置成功", "设置失败");
		}
		if(!empty($middle) or !empty($middle_money)){
			$arr['middle'] = $middle;
			$arr['middle_money'] = $middle_money;
			$res = M("system")->where("id=2")->save($arr);
			logs("设置指标或绩效金额");
			add($res, "设置成功", "设置失败");
		}
		if(!empty($right) or !empty($right_money)){
			$arr['right'] = $right;
			$arr['right_money'] = $right_money;
			$res = M("system")->where("id=2")->save($arr);
			logs("设置指标或绩效金额");
			add($res, "设置成功", "设置失败");
		}
	}

	/**
     * method  绑定关系设置助理指标
     * author  xiami
     * date    2018-04-26
     */
	public function set_three(){
		$left = $_POST['left3'];
		if(!empty($left)){
			$arr['left'] = $left;
			$res = M("system")->where("id=3")->save($arr);
			logs("设置绑定关系助理考核指标");
			add($res, "设置成功", "设置失败");
		}
	}

	
}