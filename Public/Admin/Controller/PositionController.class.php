<?php
namespace Admin\Controller;
use Think\Controller;
class PositionController extends CommonController{
/************************************************ 职位管理模块 ****************************************/
	 /**
     * method  添加职位
     * author  xiami
     * date    2018-03-21
     */
	public function position_add(){
		$this->display("position_add");
	}

	 /**
     * method  执行数据添加
     * author  xiami
     * date    2018-03-21
     */
	public function position_add_save(){
		$position = D("Position");
		$position->get_position_add_save();
	}

	 /**
     * method  职位列表
     * author  xiami
     * date    2018-03-21
     */
	public function position_list(){
		$position = D("Position");
		$data = $position->get_position_list();
        $this->assign("position",$data);
		$this->display("position_list");
	}

	 /**
     * method  编辑职位模板
     * author  xiami
     * date    2018-03-21
     */
	public function position_mod(){
		$position = D("Position");
		$data = $position->get_position_mod();
		$this->assign("position", $data);
		$this->display("position_mod");
	}

	 /**
     * method  执行职位编辑
     * author  xiami
     * date    2018-03-21
     */
	public function position_mod_save(){
		$position = D("Position");
		$position->get_position_mod_save();
	}

	 /**
     * method  删除职位
     * author  xiami
     * date    2018-03-21
     */
	public function position_del(){
		$position = D("Position");
		$position->get_position_del();
	}

}