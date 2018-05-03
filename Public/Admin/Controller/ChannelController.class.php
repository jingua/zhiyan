<?php
namespace Admin\Controller;
use Think\Controller;
class ChannelController extends CommonController{
/************************************************ 渠道管理模块 ****************************************/
	 /**
     * method  添加渠道模板
     * author  xiami
     * date    2018-03-22
     */
	public function channel_add(){
		$type = M("channelType")->where("type_del=1")->select();
		$province = M("province")->where("parent=1")->select();
		$this->assign("type",$type);
		$this->assign("provice",$province);
		$this->assign('province','-1');
		$this->assign('city','-1');
		$this->assign('block','-1');
		$this->display("channel_add");
	}

	/**
     * method  查询市
     * author  xiami
     * date    2018-03-22
     */
	public function getcity(){
		$map['parent'] = $_POST['province'];
		$list = M('province')->where($map)->select();
		echo json_encode($list);
	}

	/**
     * method  查询区
     * author  xiami
     * date    2018-03-22
     */
	public function getblock(){
		$map['parent'] = $_POST['city'];
		$list = M('province')->where($map)->select();
		echo json_encode($list);
	}

	 /**
     * method  执行渠道添加
     * author  xiami
     * date    2018-03-22
     */
	public function channel_add_save(){
		$channel = D("Channel");
		$channel->get_channel_add_save();
	}

	 /**
     * method  渠道列表
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
     * method  编辑渠道模板
     * author  xiami
     * date    2018-03-23
     */
	public function channel_mod(){
		$channel = D("Channel");
		$data = $channel->get_channel_mod();
		$type = M("channelType")->where("type_del=1")->select();
		$province = M("province")->where("parent=1")->select();
		$this->assign("channel",$data);
		$this->assign("type",$type);
		$this->assign("provice",$province);
		$this->assign('province','-1');
		$this->assign('city','-1');
		$this->assign('block','-1');
		$this->display("channel_mod");
	}


	 /**
     * method  执行渠道编辑
     * author  xiami
     * date    2018-03-23
     */
	public function channel_mod_save(){
		$channel = D("Channel");
		$channel->get_channel_mod_save();
	}

	 /**
     * method  删除渠道
     * author  xiami
     * date    2018-03-23
     */
	public function channel_del(){
		$channel = D("Channel");
		$channel->get_channel_del();
	}

	 /**
     * method  撤消删除渠道
     * author  xiami
     * date    2018-03-28
     */
	public function channel_redel(){
		$channel = D("Channel");
		$channel->get_channel_redel();
	}


/************************************************ 渠道类型管理 ****************************************/
	 /**
     * method  添加类型
     * author  xiami
     * date    2018-03-23
     */
	public function type_add(){
		$this->display("type_add");
	}

	 /**
     * method  执行数据添加
     * author  xiami
     * date    2018-03-23
     */
	public function type_add_save(){
		$channel = D("Channel");
		$channel->get_type_add_save();
	}

	 /**
     * method  类型列表
     * author  xiami
     * date    2018-03-23
     */
	public function type_list(){
		$channel = D("Channel");
		$data = $channel->get_type_list();
        $this->assign("type",$data);
		$this->display("type_list");
	}

	 /**
     * method  编辑类型模板
     * author  xiami
     * date    2018-03-23
     */
	public function type_mod(){
		$channel = D("Channel");
		$data = $channel->get_type_mod();
		$this->assign("type", $data);
		$this->display("type_mod");
	}

	 /**
     * method  执行类型编辑
     * author  xiami
     * date    2018-03-23
     */
	public function type_mod_save(){
		$channel = D("Channel");
		$channel->get_type_mod_save();
	}

	 /**
     * method  删除类型
     * author  xiami
     * date    2018-03-23
     */
	public function type_del(){
		$channel = D("Channel");
		$channel->get_type_del();
	}


}