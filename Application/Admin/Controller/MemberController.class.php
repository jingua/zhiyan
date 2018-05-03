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
		/*$position = M("position")->where("position_del=1")->select();
		$this->assign("position",$position);*/
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
		$role = M("role")->select();
		$this->assign("role",$role);
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
				if($v3 == $v4['member_id'] /*&& $v4['business_wfk'] == 0*/){
					$num = $num + $v4['num'];
					$member_name = $v4['member_name'];
					//$business_id = $v4['business_id'];
					//************发现 bug begin
					if($v4['business_wfk'] == 0){
						$noNum = $noNum + $v4['num'];
					}
					//************发现 bug end
				}else{
					//$noNum = $noNum + $v4['num'];
					//$member_name = $v4['member_name'];
				}
			}
			$datas['member_id'] = $v3;
			$datas['num'] = $num;
			$datas['noNum'] = $noNum;
			$datas['member_name'] = $member_name;
			$data[$v3] = $datas;
		}
		/* 查询没有指标的客户动态添加指标个数为0 */
		if(!empty($cid_array)){
			$map['member_id']  = array('not in',$cid_array);
			$pid = M("member")
				->field("member_name,member_id")
				->where($map)
				->where("member_del=1")
				->select();
			foreach($pid as $k6 => $v6){
				$pid[$k6]['num'] = 0;
			} 
		}else{
			$pid = M("member")
				->field("member_name,member_id")
				->where("member_del=1")
				->select();
			foreach($pid as $k6 => $v6){
				$pid[$k6]['num'] = 0;
			}
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

	//绩效统计导入表格
	public function excel(){
		//加载导出表格类与进行实例化
        vendor("PHPExcel.PHPExcel");
        $objPHPExcel = new \ PHPExcel();
		$from = date("Y-m-d",strtotime($_GET['from']));
		$to = date("Y-m-d",strtotime($_GET['to']));
		$xlsTitle = iconv('utf-8', 'gb2312', "绩效统计");
        $fileName = "绩效统计";
		$arr = D("Member")->get_excel_down_xls();
		$channel = D("Member")->get_channel();
		$parent = D("member")->get_member_parent();
		//p($parent);
		$i = 1;
		//循环创建sheet 
        foreach($arr as $v1){
        	if($i>1){
				$objPHPExcel->createSheet(); //创建sheet
			}
			$objPHPExcel->setActiveSheetIndex($i-1); //把新创建的sheet设定为当前活动sheet
			$objSheet=$objPHPExcel->getActiveSheet();//获取当前活动的sheet
			$objSheet->setTitle($v1['member_name']); //给当前sheet起别名
			$objSheet->mergeCells("A1".":"."U1");    //合并单元格
			$objPHPExcel->getActiveSheet()
				->getStyle('A1')
				->getAlignment()
				->setHorizontal(\PHPExcel_Style_Alignment::HORIZONTAL_CENTER); //内容居中对齐
			$objPHPExcel->getActiveSheet()
				->getStyle("A1".":"."U1")
				->getBorders()
				->getAllBorders()
				->setBorderStyle(\PHPExcel_Style_Border::BORDER_THIN); //添加边框
			$objPHPExcel->getActiveSheet()
					->getStyle("A1")
					->getFont()
					->setName('宋体')
	        		->setSize(14) 
	        		->setBold(true); //添加样式（包括字体、大小、加粗）
			$objSheet
				->setCellValue("A1",$from."—".$to." 绩效核算"); //给当前sheet填充数据
			$objSheet
				->setCellValue("A2","预付日期") //给当前sheet填充数据
				->setCellValue("B2","尾款日期")
				->setCellValue("C2","投放时间")
				->setCellValue("D2","业绩核算")
				->setCellValue("E2","公众号")
				->setCellValue("F2","位置")
				->setCellValue("G2","指标")
				->setCellValue("H2","对接公司")
				->setCellValue("I2","品牌")
				->setCellValue("J2","支付方式")
				->setCellValue("K2","总金额")
				->setCellValue("L2","折扣")
				->setCellValue("M2","成交金额")
				->setCellValue("N2","投放次数")
				->setCellValue("O2","预付情况")
				->setCellValue("P2","尾款")
				->setCellValue("Q2","票点")
				->setCellValue("R2","返点")
				->setCellValue("S2","合计金额")
				->setCellValue("T2","指标达成")
				->setCellValue("U2","合同确认（是/否");
			$objPHPExcel->getActiveSheet()->getColumnDimension("A")->setWidth(15); //设置单元格宽度
			$objPHPExcel->getActiveSheet()->getColumnDimension("B")->setWidth(15);	
			$objPHPExcel->getActiveSheet()->getColumnDimension("C")->setWidth(15);
			$objPHPExcel->getActiveSheet()->getColumnDimension("D")->setWidth(15);
			$objPHPExcel->getActiveSheet()->getColumnDimension("E")->setWidth(15);
			$objPHPExcel->getActiveSheet()->getColumnDimension("F")->setWidth(15);
			$objPHPExcel->getActiveSheet()->getColumnDimension("G")->setWidth(10);
			$objPHPExcel->getActiveSheet()->getColumnDimension("H")->setWidth(15);
			$objPHPExcel->getActiveSheet()->getColumnDimension("I")->setWidth(15);
			$objPHPExcel->getActiveSheet()->getColumnDimension("J")->setWidth(10);
			$objPHPExcel->getActiveSheet()->getColumnDimension("K")->setWidth(10);
			$objPHPExcel->getActiveSheet()->getColumnDimension("L")->setWidth(10);
			$objPHPExcel->getActiveSheet()->getColumnDimension("M")->setWidth(10);
			$objPHPExcel->getActiveSheet()->getColumnDimension("N")->setWidth(5);
			$objPHPExcel->getActiveSheet()->getColumnDimension("O")->setWidth(10);
			$objPHPExcel->getActiveSheet()->getColumnDimension("P")->setWidth(10);
			$objPHPExcel->getActiveSheet()->getColumnDimension("Q")->setWidth(10);
			$objPHPExcel->getActiveSheet()->getColumnDimension("R")->setWidth(10);
			$objPHPExcel->getActiveSheet()->getColumnDimension("S")->setWidth(10);
			$objPHPExcel->getActiveSheet()->getColumnDimension("T")->setWidth(10);
			$objPHPExcel->getActiveSheet()->getColumnDimension("U")->setWidth(20);
			$j=3;
			foreach($v1['business'] as $v2){
				$objSheet
					->setCellValue("A".$j,$v2['update_time']) //给当前sheet填充数据
					->setCellValue("B".$j,$v2['remind_time'])
					->setCellValue("C".$j,$v2['time_time'])
					->setCellValue("D".$j,$v2['business_wfk'])
					->setCellValue("E".$j,$v2['channel_name'])
					->setCellValue("F".$j,$v2['time_text'])
					->setCellValue("G".$j,$v2['zhibiao'])
					->setCellValue("H".$j,$v2['customer_company'])
					->setCellValue("I".$j,$v2['customer_brand'])
					->setCellValue("J".$j,$v2['pay_name'])
					->setCellValue("K".$j,$v2['time_total'])
					->setCellValue("L".$j,$v2['time_price'])
					->setCellValue("M".$j,$v2['business_cjje'])
					->setCellValue("N".$j,$v2['business_tfcs'])
					->setCellValue("O".$j,$v2['business_fkqk'])
					->setCellValue("P".$j,$v2['business_weikuan'])
					->setCellValue("Q".$j,$v2['invoice_price'])
					->setCellValue("R".$j,$v2['business_fandian'])
					->setCellValue("S".$j,$v2['business_total'])
					->setCellValue("T".$j,$v2['zhibiao_dc'])
					->setCellValue("U".$j,$v2['contract_name']);
				$j++;
			}
			$z = $j+1;
			$zz = $z+6;
			$objSheet->mergeCells("A".$z.":"."P".$zz); //合并单元格
			$objPHPExcel->getActiveSheet()
				->getStyle("A".$z.":"."P".$zz)
				->getAlignment()
				->setHorizontal(\PHPExcel_Style_Alignment::HORIZONTAL_JUSTIFY); //内容左对齐
			$objPHPExcel->getActiveSheet()
				->getStyle("A".$z.":"."P".$zz)
				->getBorders()
				->getAllBorders()
				->setBorderStyle(\PHPExcel_Style_Border::BORDER_THIN); //添加边框
			$objSheet
				->setCellValue("A".$z,$v1['member_text']); //填充内容
			$y1 = $z+10;
			$y2 = $z+11;
			$y3 = $z+12;
			$y4 = $z+13;
			$y5 = $z+15;
			$y6 = $z+16;
			$objSheet
				->setCellValue("A".$y1) //填充内容
				->setCellValue("B".$y1,"指标") 
				->setCellValue("C".$y1,"年框KPI")
				->setCellValue("D".$y1,"超额KPI")
				->setCellValue("E".$y1,"绩效奖金")
				->setCellValue("F".$y1,"总金额");
			$objSheet
				->setCellValue("A".$y2,"合计总指标") //填充内容
				->setCellValue("B".$y2,$v1['total_zhibiao'])
				->setCellValue("C".$y2,$v1['total_qianyue'])
				->setCellValue("D".$y2,$v1['jixiao_total'])
				->setCellValue("E".$y2,$v1['jixiao_chaochu_total'])
				->setCellValue("F".$y2,$v1['price_total']);
			$objSheet
				->setCellValue("A".$y3,"可发放指标") //填充内容
				->setCellValue("B".$y3,$v1['zhibiao_fafang_total'])
				->setCellValue("C".$y3,$v1['qianque_fafang'])
				->setCellValue("D".$y3,$v1['jixiao_fafang_total'])
				->setCellValue("E".$y3,$v1['fafang_chaochu_total'])
				->setCellValue("F".$y3,$v1['first_price_total']);
			$objSheet
				->setCellValue("A".$y4,"待申请指标") //填充内容
				->setCellValue("B".$y4,$v1['zhibiao_shenqingzhong_total'])
				->setCellValue("C".$y4,$v1['qianque_shenqingzhong'])
				->setCellValue("D".$y4,$v1['jixiao_shenqingzhong_total'])
				->setCellValue("E".$y4,$v1['shenqingzhong_chaochu_total'])
				->setCellValue("F".$y4,$v1['end_price_total']);
			//年框公司
			$objSheet->mergeCells("A".$y5.":"."F".$y5); //合并单元格
			$objPHPExcel->getActiveSheet()
				->getStyle("A".$y5)
				->getAlignment()
				->setHorizontal(\PHPExcel_Style_Alignment::HORIZONTAL_CENTER); //居中对齐
			$objSheet
				->setCellValue("A".$y5,"年框公司");
				foreach($v1['sign_company'] as $v3){
					$objSheet->mergeCells("A".$y6.":"."F".$y6); //合并单元格
					$objSheet
						->setCellValue("A".$y6,$v3['customer_company']); //填充内容
						$y6++;
				}
			$i++;
        }
        //渠道统计
        $v = $i+1;
        $total_one = 0;
		$total_two = 0;
        if($v){
        	$objPHPExcel->createSheet(); //创建sheet
        	$objPHPExcel->setActiveSheetIndex($v-2); //设置为当前sheet为活动sheet
			$objSheet=$objPHPExcel->getActiveSheet(); //获取当前活动sheet
	        $objSheet->setTitle("渠道统计"); //给当前sheet起名字
	        $jj = 2;
	        $ss = $jj-1;
	        foreach($channel as $v5){
	        	$aa = $jj;
	        	$jj = $jj+1;
	        	$objSheet
					->setCellValue("A".$aa,$v5['channel_name']."(".$from."—".$to.")"); //填充内容
				$objSheet->mergeCells("A".$aa.":"."G".$aa); //合并单元格
				$objPHPExcel->getActiveSheet()
					->getStyle("A".$aa)
					->getAlignment()
					->setHorizontal(\PHPExcel_Style_Alignment::HORIZONTAL_CENTER); //内容中间对齐
				$objPHPExcel->getActiveSheet()
					->getStyle("A".$aa.":"."G".$aa)
					->getBorders()
					->getAllBorders()
					->setBorderStyle(\PHPExcel_Style_Border::BORDER_THIN); //添加边框
				$objPHPExcel->getActiveSheet()
					->getStyle("A".$aa)
					->getFont()
					->setName('宋体')
	        		->setSize(14) 
	        		->setBold(true); //添加字体 设置字体大小 加粗
				$objSheet
					->setCellValue("A".$jj,"投放位置") //填充内容
					->setCellValue("B".$jj,"投放时间")
					->setCellValue("C".$jj,"对接公司")
					->setCellValue("D".$jj,"合作品牌")
					->setCellValue("E".$jj,"成交金额（含税）")
					->setCellValue("F".$jj,"成交额（不含税）")
					->setCellValue("G".$jj,"对接人");
				$objPHPExcel->getActiveSheet()->getColumnDimension("A")->setWidth(15); //设置单元格宽度
				$objPHPExcel->getActiveSheet()->getColumnDimension("B")->setWidth(15);
				$objPHPExcel->getActiveSheet()->getColumnDimension("C")->setWidth(15);
				$objPHPExcel->getActiveSheet()->getColumnDimension("D")->setWidth(15);
				$objPHPExcel->getActiveSheet()->getColumnDimension("E")->setWidth(20);
				$objPHPExcel->getActiveSheet()->getColumnDimension("F")->setWidth(20);
				$objPHPExcel->getActiveSheet()->getColumnDimension("G")->setWidth(15);
				foreach($v5['list'] as $v6){
					$jj = $jj+1;
					$objSheet
						->setCellValue("A".$jj,$v6['position']) //填充数据
						->setCellValue("B".$jj,$v6['time_time'])
						->setCellValue("C".$jj,$v6['customer_company'])
						->setCellValue("D".$jj,$v6['customer_brand'])
						->setCellValue("E".$jj,$v6['business_total'])
						->setCellValue("F".$jj,$v6['price_total'])
						->setCellValue("G".$jj,$v6['member_name']);
				}
				$jj = $jj+1;
				$objSheet
					->setCellValue("A".$jj) //填充数据
					->setCellValue("B".$jj)
					->setCellValue("C".$jj)
					->setCellValue("D".$jj,"小计")
					->setCellValue("E".$jj,$v5['total_cjje'])
					->setCellValue("F".$jj,$v5['total_cje'])
					->setCellValue("G".$jj);
				$jj = $jj+3;
				$total_one = $total_one + $v5['total_cjje'];
				$total_two = $total_two + $v5['total_cje'];
	        }
	        $jj = $jj;
	        $objSheet
				->setCellValue("A".$jj) //填充数据
				->setCellValue("B".$jj)
				->setCellValue("C".$jj)
				->setCellValue("D".$jj,"总计")
				->setCellValue("E".$jj,$total_one)
				->setCellValue("F".$jj,$total_two)
				->setCellValue("G".$jj);
        }
        //绑定关系统计 begin
        $ii = $v+1;
        foreach($parent as $v7){
			$objPHPExcel->createSheet(); //创建sheet
			$objPHPExcel->setActiveSheetIndex($ii-2); //设置当前sheet为活动sheet
			$objSheet=$objPHPExcel->getActiveSheet(); //获取当前活动为sheet 
			$objSheet->setTitle($v7['name']); //给当前sheet起名字
			//begin
			$objSheet->mergeCells("A1".":"."U1"); //合并单元格
			$objPHPExcel->getActiveSheet()
				->getStyle('A1')
				->getAlignment()
				->setHorizontal(\PHPExcel_Style_Alignment::HORIZONTAL_CENTER); //内容居中对齐
			$objPHPExcel->getActiveSheet()
				->getStyle("A1".":"."U1")
				->getBorders()
				->getAllBorders()
				->setBorderStyle(\PHPExcel_Style_Border::BORDER_THIN); //添加边框
			$objPHPExcel->getActiveSheet()
					->getStyle("A1")
					->getFont()
					->setName('宋体')
	        		->setSize(14) 
	        		->setBold(true); //设置字体 大小 粗细
			$objSheet
				->setCellValue("A1",$from."—".$to." 绩效核算"); //填充内容
			$objSheet
				->setCellValue("A2","预付日期") //填充内容
				->setCellValue("B2","尾款日期")
				->setCellValue("C2","投放时间")
				->setCellValue("D2","业绩核算")
				->setCellValue("E2","公众号")
				->setCellValue("F2","位置")
				->setCellValue("G2","指标")
				->setCellValue("H2","对接公司")
				->setCellValue("I2","品牌")
				->setCellValue("J2","支付方式")
				->setCellValue("K2","总金额")
				->setCellValue("L2","折扣")
				->setCellValue("M2","成交金额")
				->setCellValue("N2","投放次数")
				->setCellValue("O2","预付情况")
				->setCellValue("P2","尾款")
				->setCellValue("Q2","票点")
				->setCellValue("R2","返点")
				->setCellValue("S2","合计金额")
				->setCellValue("T2","指标达成")
				->setCellValue("U2","合同确认（是/否");
			$objPHPExcel->getActiveSheet()->getColumnDimension("A")->setWidth(15); //设置单元格宽度
			$objPHPExcel->getActiveSheet()->getColumnDimension("B")->setWidth(15);
			$objPHPExcel->getActiveSheet()->getColumnDimension("C")->setWidth(15);
			$objPHPExcel->getActiveSheet()->getColumnDimension("D")->setWidth(15);
			$objPHPExcel->getActiveSheet()->getColumnDimension("E")->setWidth(15);
			$objPHPExcel->getActiveSheet()->getColumnDimension("F")->setWidth(15);
			$objPHPExcel->getActiveSheet()->getColumnDimension("G")->setWidth(15);
			$objPHPExcel->getActiveSheet()->getColumnDimension("H")->setWidth(15);
			$objPHPExcel->getActiveSheet()->getColumnDimension("I")->setWidth(15);
			$objPHPExcel->getActiveSheet()->getColumnDimension("J")->setWidth(10);
			$objPHPExcel->getActiveSheet()->getColumnDimension("K")->setWidth(10);
			$objPHPExcel->getActiveSheet()->getColumnDimension("L")->setWidth(10);
			$objPHPExcel->getActiveSheet()->getColumnDimension("M")->setWidth(10);
			$objPHPExcel->getActiveSheet()->getColumnDimension("N")->setWidth(5);
			$objPHPExcel->getActiveSheet()->getColumnDimension("O")->setWidth(10);
			$objPHPExcel->getActiveSheet()->getColumnDimension("P")->setWidth(10);
			$objPHPExcel->getActiveSheet()->getColumnDimension("Q")->setWidth(10);
			$objPHPExcel->getActiveSheet()->getColumnDimension("R")->setWidth(10);
			$objPHPExcel->getActiveSheet()->getColumnDimension("S")->setWidth(10);
			$objPHPExcel->getActiveSheet()->getColumnDimension("T")->setWidth(10);
			$objPHPExcel->getActiveSheet()->getColumnDimension("U")->setWidth(20);
			$j=3;
			foreach($v7['business'] as $v8){
				$objSheet
					->setCellValue("A".$j,$v8['update_time']) //填充内容
					->setCellValue("B".$j,$v8['remind_time'])
					->setCellValue("C".$j,$v8['time_time'])
					->setCellValue("D".$j,$v8['business_wfk'])
					->setCellValue("E".$j,$v8['channel_name'])
					->setCellValue("F".$j,$v8['time_text'])
					->setCellValue("G".$j,$v8['zhibiao'])
					->setCellValue("H".$j,$v8['customer_company'])
					->setCellValue("I".$j,$v8['customer_brand'])
					->setCellValue("J".$j,$v8['pay_name'])
					->setCellValue("K".$j,$v8['time_total'])
					->setCellValue("L".$j,$v8['time_price'])
					->setCellValue("M".$j,$v8['business_cjje'])
					->setCellValue("N".$j,$v8['business_tfcs'])
					->setCellValue("O".$j,$v8['business_fkqk'])
					->setCellValue("P".$j,$v8['business_weikuan'])
					->setCellValue("Q".$j,$v8['invoice_price'])
					->setCellValue("R".$j,$v8['business_fandian'])
					->setCellValue("S".$j,$v8['business_total'])
					->setCellValue("T".$j,$v8['zhibiao_dc'])
					->setCellValue("U".$j,$v8['contract_name']);
				$j++;
			}
			$j;
			foreach($v7['business_parent'] as $v9){
				$objSheet
					->setCellValue("A".$j,$v9['update_time']) //填充内容
					->setCellValue("B".$j,$v9['remind_time'])
					->setCellValue("C".$j,$v9['time_time'])
					->setCellValue("D".$j,$v9['business_wfk'])
					->setCellValue("E".$j,$v9['channel_name'])
					->setCellValue("F".$j,$v9['time_text'])
					->setCellValue("G".$j,$v9['zhibiao'])
					->setCellValue("H".$j,$v9['customer_company'])
					->setCellValue("I".$j,$v9['customer_brand'])
					->setCellValue("J".$j,$v9['pay_name'])
					->setCellValue("K".$j,$v9['time_total'])
					->setCellValue("L".$j,$v9['time_price'])
					->setCellValue("M".$j,$v9['business_cjje'])
					->setCellValue("N".$j,$v9['business_tfcs'])
					->setCellValue("O".$j,$v9['business_fkqk'])
					->setCellValue("P".$j,$v9['business_weikuan'])
					->setCellValue("Q".$j,$v9['invoice_price'])
					->setCellValue("R".$j,$v9['business_fandian'])
					->setCellValue("S".$j,$v9['business_total'])
					->setCellValue("T".$j,$v9['zhibiao_dc'])
					->setCellValue("U".$j,$v9['contract_name']);
				$j++;
			}
			$z = $j+1;
			$zz = $z+6;
			$objSheet->mergeCells("A".$z.":"."P".$zz); //合并单元格
			$objPHPExcel->getActiveSheet()
				->getStyle("A".$z.":"."P".$zz) 
				->getAlignment()
				->setHorizontal(\PHPExcel_Style_Alignment::HORIZONTAL_JUSTIFY); //内容左对齐
			$objPHPExcel->getActiveSheet()
					->getStyle("A".$z.":"."P".$zz)
					->getBorders()
					->getAllBorders()
					->setBorderStyle(\PHPExcel_Style_Border::BORDER_THIN); //添加边框
			$objSheet
				->setCellValue("A".$z,$v7['member_text']); //
			$y1 = $z+10;
			$y2 = $z+11;
			$y3 = $z+12;
			$y4 = $z+13;
			$y5 = $z+15;
			$y6 = $z+16;
			$objSheet
				->setCellValue("A".$y1) //填充数据
				->setCellValue("B".$y1,"指标")
				->setCellValue("C".$y1,"年框KPI")
				->setCellValue("D".$y1,"经理超额KPI")
				->setCellValue("E".$y1,"助理超额KPI")
				->setCellValue("F".$y1,"总超额KPI")
				->setCellValue("G".$y1,"经理绩效奖金")
				->setCellValue("H".$y1,"助理绩效奖金")
				->setCellValue("I".$y1,"总绩效奖金")
				->setCellValue("J".$y1,"总金额");
			$objSheet
				->setCellValue("A".$y2,"合计总指标")
				->setCellValue("B".$y2,$v7['total_zhibiaoss'])
				->setCellValue("C".$y2,$v7['total_qianyuess'])
				->setCellValue("D".$y2,$v7['zhibiao_jingli_total'])
				->setCellValue("E".$y2,$v7['zhibiao_zhuli_total'])
				->setCellValue("F".$y2,$v7['jixiao_totals'])
				->setCellValue("G".$y2,$v7['jixiao_chaochu_jingli_totals'])
				->setCellValue("H".$y2,$v7['jixiao_chaochu_zhuli_totals'])
				->setCellValue("I".$y2,$v7['jixiao_chaochu_totals'])
				->setCellValue("J".$y2,$v7['price_totals']);
			$objSheet
				->setCellValue("A".$y3,"可发放指标")
				->setCellValue("B".$y3,$v7['zhibiao_fafang_totalss'])
				->setCellValue("C".$y3,$v7['qianque_fafangss'])
				->setCellValue("D".$y3,$v7['zhibiao_fafang_jingli'])
				->setCellValue("E".$y3,$v7['zhibiao_fafang_zhuli'])
				->setCellValue("F".$y3,$v7['jixiao_fafang_totals'])
				->setCellValue("G".$y3,$v7['fafang_chaochu_jingli_totals'])
				->setCellValue("H".$y3,$v7['fafang_chaochu_zhuli_totals'])
				->setCellValue("I".$y3,$v7['fafang_chaochu_totals'])
				->setCellValue("J".$y3,$v7['first_price_totals']);
			$objSheet
				->setCellValue("A".$y4,"待申请指标")
				->setCellValue("B".$y4,$v7['zhibiao_shenqingzhong_totalss'])
				->setCellValue("C".$y4,$v7['qianque_shenqingzhongss'])
				->setCellValue("D".$y4,$v7['zhibiao_shenqingzhong_jingli'])
				->setCellValue("E".$y4,$v7['zhibiao_shenqingzhong_zhuli'])
				->setCellValue("F".$y4,$v7['jixiao_shenqingzhong_totals'])
				->setCellValue("G".$y4,$v7['shenqingzhong_chaochu_jingli_totals'])
				->setCellValue("H".$y4,$v7['shenqingzhong_chaochu_zhuli_totals'])
				->setCellValue("I".$y4,$v7['shenqingzhong_chaochu_totals'])
				->setCellValue("J".$y4,$v7['end_price_totals']);
			//年框公司
			$objSheet->mergeCells("A".$y5.":"."J".$y5); 
			$objPHPExcel->getActiveSheet()
				->getStyle("A".$y5)
				->getAlignment()
				->setHorizontal(\PHPExcel_Style_Alignment::HORIZONTAL_CENTER); 
			$objSheet
				->setCellValue("A".$y5,"年框公司");
				foreach($v7['sign_company'] as $v33){
					$objSheet->mergeCells("A".$y6.":"."F".$y6);
					$objSheet
						->setCellValue("A".$y6,$v33['customer_company']);
						$y6++;
				}
				$y7 = $y6;
				foreach($v7['sign_companys'] as $v333){
					$objSheet->mergeCells("A".$y7.":"."F".$y7);
					$objSheet
						->setCellValue("A".$y7,$v333['customer_company']);
						$y7++;
				}
			$ii++;
			//end
        }
        //绑定关系统计 end
        logs("绩效统计导出表格");
        header('pragma:public');
        header('Content-type:application/vnd.ms-excel;charset=utf-8;name="'.$xlsTitle.'.xls"');
        header("Content-Disposition:attachment;filename=$fileName.xls");
        $objWriter = \PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');  
        $objWriter->save('php://output'); 
        exit;
	}

}