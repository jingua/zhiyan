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

	/**
     * method  显示考核指标列表
     * author  xiami
     * date    2018-04-09
    */
	public function business_member(){
		/* 搜索指标个数 */
		$str1 = '';
		$str2 = '';
		$str1 = search_time("create_time","from","to");
		$str2 = search_time("update_time","from","to");
		/* 执行指标查询 */
		$business = M("business")
			->field("business_id,customer_id,create_time,member_id,business_wfk")
			->where("business_del=1".$str1['str'])
			->select();
		foreach($business as $k => $v){
			/* 查询成员名称 */
			$business[$k]['member_name'] = M("member")
				->where("member_id='{$v['member_id']}'")
				->getField("member_name");
			/* 查询投放渠道 */
			$business[$k]['time'] = M("businessTime")
				->where("business_id='{$v['business_id']}'")
				->select();
			/* 查询渠道编号 */
			$channel = M("channel")
				->where("member_id='{$v['member_id']}'")
				->getField("channel_id",true);
			foreach($business[$k]['time'] as $k1 => $v1){
				/* 判断是否本人渠道 */
				if(in_array($v1['channel_id'],$channel)){
					/* 是本人渠道在判断指标是头条还是次条 */
					if($v1['time_text'] == 'first'){
						$business[$k]['num'] += 2*$v1['time_price'];
					}else{
						$business[$k]['num'] += 1*$v1['time_price'];
					}
				}else{
					/* 不是本人渠道在判断指标是头条还是次条 */
					if($v1['time_text'] == 'first'){
						$business[$k]['num'] += 2*0.8*$v1['time_price'];
					}else{
						$business[$k]['num'] += 1*0.8*$v1['time_price'];
					}
				}
			}
		}
		$cid_array = array();
		/* 去除重复成员编号 */
		foreach ($business as $k2 => $v2) {
			if(in_array($v2['member_id'], $cid_array)){
				continue;
			}else{
				$cid_array[] = $v2['member_id'];
			}
		}
		$data = array();
		/* 计算成员指标个数重复的编号去除 指标个数相加求和 */
		foreach ($cid_array as $k3 => $v3){
			$num = 0;
			$noNum = 0;
			foreach ($business as $k4 => $v4){
				if($v3 == $v4['member_id'] && $v4['business_wfk'] == 0){
					$num = $num + $v4['num'];
					$member_name = $v4['member_name'];
					$business_id = $v4['business_id'];
				}else{
					$noNum = $noNum + $v4['num'];
					$member_name = $v4['member_name'];
				}
			}
			$datas['member_id'] = $v3;
			$datas['num'] = $num;
			$datas['noNum'] = $noNum;
			$datas['member_name'] = $member_name;
			$data[$v3] = $datas;
		}
		/* 查询没有指标的客户动态添加指标个数为0 */
		$map['member_id']  = array('not in',$cid_array);
		$pid = M("member")
			->field("member_name,member_id,member_name")
			->where($map)
			->select();
		foreach($pid as $k6 => $v6){
			$pid[$k6]['num'] = 0;
		} 
		$in = array_merge($data,$pid);
		/* 查询合同指标个数 */
		foreach($in as $k7 => $v7){
			$con1 = M("sign")
				->where("sign_del=1 and sign_status=2 and member_id='{$v7['member_id']}'".$str2['str'])
				->select();
			$in[$k7]['num'] = $v7['num'] + count($con1)*0.6;
		}
		/* 查询绑定关系 */
		$member = M("member")
			->field("member_id,member_name,parent_id")
			->where("member_del=1 and parent_id!=''")
			->select();
		/* 给绑定关系签约成员计算指标个数 */
		foreach($member as $k5 => $v5){
			$con1 = M("sign")
				->where("sign_del=1 and sign_status=2 and member_id='{$v5['parent_id']}'".$str2['str'])
				->select();
			$cnum = count($con1)*0.6;
			$member[$k5]['parent_name'] = M("member")
				->where("member_id='{$v5['parent_id']}'")
				->getField("member_name");
			$member[$k5]['num'] = $data[$v5['parent_id']]['num']+$data[$v5['member_id']]['num'] + $cnum;
			$member[$k5]['noNum'] = $data[$v5['parent_id']]['noNum']+$data[$v5['member_id']]['noNum'];

		}
		$data = array_merge($data,$pid);
		$this->assign("business",$in);
		$this->assign("from",$str1['from']);
		$this->assign("to",$str1['to']);
		$this->assign("member",$member);
		$this->display("business_member");
	}

	public function excel(){
		$xlsTitle = iconv('utf-8', 'gb2312', "绩效统计");
        $fileName = date("YmdHis");
        vendor("PHPExcel.PHPExcel");
        $objPHPExcel = new \ PHPExcel();
		$arr = D("Member")->get_excel_down_xls();
		//p($arr);
		$i = 1;
        foreach($arr as $v1){
        	if($i>1){
				$objPHPExcel->createSheet();
			}
			$objPHPExcel->setActiveSheetIndex($i-1);
			$objSheet=$objPHPExcel->getActiveSheet();
			$objSheet->setTitle($v1['member_name']);
			$objSheet->mergeCells("A1".":"."M1");
			$objPHPExcel->getActiveSheet()
				->getStyle('A1')
				->getFont()
				->setName('宋体') //字体  
        		->setSize(16) //字体大小  
        		->setBold(true); //字体加粗   
        	$objPHPExcel->getActiveSheet()->getRowDimension('1')->setRowHeight(28);  
        	//$objPHPExcel->getActiveSheet()->getRowDimension('2')->setRowHeight(31.5);  
        	//$objPHPExcel->getActiveSheet()->getRowDimension('3')->setRowHeight(69.75); 
        	$objPHPExcel->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal(\PHPExcel_Style_Alignment::HORIZONTAL_CENTER); 
        	 $objPHPExcel->getActiveSheet()->getStyle('A1:H8')->getBorders()->getAllBorders()->setBorderStyle(\PHPExcel_Style_Border::BORDER_THIN); 
        	  $objPHPExcel->getActiveSheet()->getStyle('B')->getAlignment()->setWrapText(true);
        	   $objPHPExcel->getActiveSheet()->getColumnDimension('A1')->setWidth(50);  
        	   $objPHPExcel->getActiveSheet()->getColumnDimension('B1')->setWidth(50);  
        	   $objPHPExcel->getActiveSheet()->getColumnDimension('C1')->setWidth(50);  
			$objSheet
				->setCellValue("A1","预付日期")
				->setCellValue("B1","尾款日期")
				->setCellValue("C1","投放时间")
				->setCellValue("D1","业绩核算")
				->setCellValue("E1","公众号")
				->setCellValue("F1","位置")
				->setCellValue("G1","指标")
				->setCellValue("H1","对接公司")
				->setCellValue("I1","品牌");
			$objSheet
				->setCellValue("A2","预付日期")
				->setCellValue("B2","尾款日期")
				->setCellValue("C2","投放时间")
				->setCellValue("D2","业绩核算")
				->setCellValue("E2","公众号")
				->setCellValue("F2","位置")
				->setCellValue("G2","指标")
				->setCellValue("H2","对接公司")
				->setCellValue("I2","品牌");
			$j=3;
			foreach($v1['business'] as $v2){
				$objSheet
					->setCellValue("A".$j,$v2['update_time'])
					->setCellValue("B".$j,$v2['remind_time'])
					->setCellValue("C".$j,$v2['time_time'])
					->setCellValue("D".$j,$v2['business_wfk'])
					->setCellValue("E".$j,$v2['channel_name'])
					->setCellValue("F".$j,$v2['time_text'])
					->setCellValue("G".$j,$v2['zhibiao'])
					->setCellValue("H".$j,$v2['customer_company'])
					->setCellValue("I".$j,$v2['customer_brand']);
				$j++;
			}	
			$i++;
        }
        header('pragma:public');
        header('Content-type:application/vnd.ms-excel;charset=utf-8;name="'.$xlsTitle.'.xls"');
        header("Content-Disposition:attachment;filename=$fileName.xls");
        $objWriter = \PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');  
        $objWriter->save('php://output'); 
        exit;
		
	}

}