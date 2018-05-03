<?php
namespace Admin\Controller;
use Think\Controller;
class MemberController extends CommonController{
/*********************************** 成员管理模块 ******************************/
	 /**
     * method  添加成员模板
     * author  xiami
     * date    2018-03-22
     */
	public function member_add(){
		$role = M("role")->select();
		$this->assign("role",$role);
		$this->display("member_add");
	}

	 /**
     * method  执行成员添加
     * author  xiami
     * date    2018-03-22
     */
	public function member_add_save(){
		$member = D("Member");
		$member->get_member_add_save();
	}

	 /**
     * method  成员列表
     * author  xiami
     * date    2018-03-22
     */
	public function member_list(){
		$member = D("Member");
		$data = $member->get_member_list();
		$position = M("position")->where("position_del=1")->select();
		$this->assign("position",$position);
        $this->assign("member",$data);
		$this->display("member_list");
	}

	 /**
     * method  编辑成员模板
     * author  xiami
     * date    2018-03-22
     */
	public function member_mod(){
		$member = D("Member");
		$data = $member->get_member_mod();
		$position = M("position")->where("position_del=1")->select();
		$this->assign("position",$position);
		$this->assign("member",$data);
		$this->display("member_mod");
	}

	 /**
     * method  执行成员编辑
     * author  xiami
     * date    2018-03-22
     */
	public function member_mod_save(){
		$member = D("Member");
		$member->get_member_mod_save();
	}

	 /**
     * method  删除成员
     * author  xiami
     * date    2018-03-22
     */
	public function member_del(){
		$member = D("Member");
		$member->get_member_del();
	}

	/**
     * method  修改密码模板
     * author  xiami
     * date    2018-03-29
    */
	public function member_pass(){
		$this->display("member_pass");
	}

	/**
     * method  执行密码修改
     * author  xiami
     * date    2018-03-29
    */
	public function member_pass_save(){
		$member = D("Member");
		$member->get_member_pass_save();
	}

	/**
     * method  总监添加模板
     * author  xiami
     * date    2018-04-02
    */
	public function chief_add(){
		$this->display("chief_add");
	}

	/**
     * method  总监执行添加
     * author  xiami
     * date    2018-04-02
    */
	public function chief_add_save(){
		$member = D("Member");
		$member->get_chief_add_save();
	}

	/**
     * method  绑定关系模板
     * author  xiami
     * date    2018-04-03
    */
	public function member_parent(){
		$member = M("member")->field("member_id,member_name")->where("member_del=1")->select();
		$data = M("member")->where("member_id='{$_GET['id']}'")->find();
		$this->assign("res",$data);
		$this->assign("member",$member);
		$this->display("member_parent");
	}

	/**
     * method  执行关系绑定
     * author  xiami
     * date    2018-04-03
    */
	public function member_parent_save(){
		$member = D("Member");
		$member->get_member_parent_save();
	}

}