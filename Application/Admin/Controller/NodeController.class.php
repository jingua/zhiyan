<?php
namespace Admin\Controller;
use Think\Controller;
class NodeController extends CommonController{
/************************************** 角色管理模块 *****************************************************/
	 /**
     * method  添加角色模板
     * author  xiami
     * date    2018-02-02
     */
	public function role_add(){
		$this->display("role_add");
	}

	/**
     * method  执行角色添加
     * author  xiami
     * date    2018-02-02
     */
	public function role_save(){
		$node = D("Node");
		$node->get_role_add();
	}

	/**
     * method  角色列表
     * author  xiami
     * date    2018-02-02
     */
	public function role_list(){
		$node = D("Node");
		$arr = $node->get_role_list();
		$this->assign("role",$arr);
		$this->display("role_list");
	}

	/**
     * method  编辑角色模板
     * author  xiami
     * date    2018-02-02
     */
	public function role_mod(){
		$node = D("Node");
		$role = $node->get_role_mod();
		$this->assign("role",$role);
		$this->display("role_mod");
	}

	/**
     * method  执行角色编辑
     * author  xiami
     * date    2018-02-02
     */
	public function role_edit(){
		$node = D('Node');
		$node->get_role_edit();
	}

	/**
     * method  删除角色
     * author  xiami
     * date    2018-02-02
     */
	public function role_del(){
		$node = D("Node");
		$node->get_role_del();
	}

	/**
     * method  分配角色模板
     * author  xiami
     * date    2018-02-02
     */
	public function role_user(){
		$node = D("Node");
		$arr = $node->get_role_list();
		$admin = $node->get_user_field();
		$role_id = $node->get_user_role_all();
		$this->assign("role",$arr['role']);
		$this->assign("admin",$admin);
		$this->assign("role_id",$role_id);
		$this->display("role_user");
	}

	/**
     * method  执行角色分配
     * author  xiami
     * date    2018-02-02
     */
	public function role_user_save(){
		$node = D("Node");
		$node->get_role_user_save();
	}

	/**
     * method  添加节点模板
     * author  xiami
     * date    2018-02-02
     */
	public function node_add(){
		$node = D("Node");
		$actions = $node->get_actions();
		$this->assign("actions",$actions);
		$this->display("node_add");
	}

	/**
     * method  执行节点添加
     * author  xiami
     * date    2018-02-02
     */
	public function node_save(){
		$node = D("Node");
		$node->get_node_save();
	}

	/**
     * method  节点列表
     * author  xiami
     * date    2018-02-02
     */
	public function node_list(){
		$node = D("Node");
		$arr = $node->get_node_all();
		$this->assign("node",$arr);
		$this->display("node_list");
	}

	/**
     * method  编辑节点模板
     * author  xiami
     * date    2018-02-02
     */
	public function node_mod(){
		$node = D("Node");
		$arr = $node->get_node_mod();
		$actions = $node->get_actions();
		$this->assign("actions",$actions);
		$this->assign("node",$arr);
		$this->display("node_mod");
	}

	/**
     * method  执行节点编辑
     * author  xiami
     * date    2018-02-02
     */
	public function node_edit(){
		$node = D("Node");
		$node->get_node_edit();
	}

	/**
     * method  执行节点删除
     * author  xiami
     * date    2018-02-02
     */
	public function node_del(){
		$node = D("Node");
		$node->get_node_del();
	}

	/**
     * method  权限列表
     * author  xiami
     * date    2018-02-02
     */
	public function role_node_list(){
		$node = D("Node");
		$arr = $node->get_role_list();
		$this->assign("role",$arr);
		$this->display("role_node_list");
	}

	/**
     * method  显示权限模板
     * author  xiami
     * date    2018-02-02
     */
	public function node_user(){
		$node = D("Node");
		$role = $node->get_role_mod();
		$arr = $node->get_node_all();
		$node_id = $node->get_role_user();
		$this->assign("actions",$arr);
		$this->assign("role",$role);
		$this->assign("node",$node_id);
		$this->display("node_user");
	}

	/**
     * method  执行权限分配
     * author  xiami
     * date    2018-02-02
     */
	public function role_node_save(){
		$node = D("Node");
		$node->get_role_node_save();
	}


}
