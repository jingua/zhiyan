<?php
namespace Admin\Controller;
use Think\Controller;
use Org\Util\Rbac;
class CommonController extends Controller {

    //自动加载方法
    public function _initialize(){
        //判断用户是否已经登录
        if(!isset($_SESSION["admin"]['isLogin']) || empty($_SESSION["admin"]['isLogin'])){
            $this->error('对不起,您还没有登录!请先登录再进行浏览', U('Index/login'), 1);
        }
        //权限设置
        /*$Rbac= new Rbac();
        if(!$Rbac::checkAuth()){
            $this->error('抱歉！您没有权限！请联系权限管理员！',U('Index/welcome'),1);
        }*/
    }


     /*
        expTitle     导出的标题
        expCellName  单元格数量
        expTableData 导出的内容
      */
      public function exportExcel($expTitle,$expCellName,$expTableData){
        $xlsTitle = iconv('utf-8', 'gb2312', $expTitle); 
        $fileName = date("YmdHis");//导出文件名称可根据自己情况设定
        $cellNum = count($expCellName);
        $dataNum = count($expTableData);
        vendor("PHPExcel.PHPExcel");
        $objPHPExcel = new \ PHPExcel();
        $cellName = array('A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z','AA','AB','AC','AD','AE','AF','AG','AH','AI','AJ','AK','AL','AM','AN','AO','AP','AQ','AR','AS','AT','AU','AV','AW','AX','AY','AZ');
        $objPHPExcel->getActiveSheet(0)->mergeCells('A1:'.$cellName[$cellNum-1].'1');//合并单元格
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('A1', $expTitle);  
        for($i=0;$i<$cellNum;$i++){
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue($cellName[$i].'2', $expCellName[$i][1]); 
        } 
        for($i=0;$i<$dataNum;$i++){
          for($j=0;$j<$cellNum;$j++){
            $objPHPExcel->getActiveSheet(0)->setCellValue($cellName[$j].($i+3), $expTableData[$i][$expCellName[$j][0]]);
          }             
        }  
        header('pragma:public');
        header('Content-type:application/vnd.ms-excel;charset=utf-8;name="'.$xlsTitle.'.xls"');
        header("Content-Disposition:attachment;filename=$fileName.xls");//attachment新窗口打印inline本窗口打印
        $objWriter = \PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');  
        $objWriter->save('php://output'); 
        exit;   
    }

    //分页查询数据
    public function getnews(){
        header("Content-type:text/html;charset=utf-8");
        if((empty($_REQUEST['start']) && $_REQUEST['start']!=0 ) || empty($_REQUEST['end'])){
            $rs['res'] = 0;
            $rs['error'] = "参数错误";
            echo json_encode($rs,JSON_UNESCAPED_UNICODE);exit;
        }else{
            $news = M("news");
            $imgs = M("images");
            $data = $news->order("addtime desc")->limit($_REQUEST['start'].','.$_REQUEST['end'])->select();
            for($i = 0;$i<count($data);$i++){
                $data[$i]['url'] = C("YUMING_URL").U("newsdetail")."?id=".$data[$i]['id'];
                $temp = $imgs->field('img')->where("nid = {$data[$i]['id']}")->select();
                $arr = array();
                foreach($temp as $v){
                    $arr[] = $v['img'];
                }
                $data[$i]['imgs'] = $arr;
            }
            $rs['res'] = '200';
            $rs['info'] = $data;
            if($_REQUEST['advert']==1){
                $banner = M("banner");
                $pic=$banner->order("id desc")->select();
                $rs["advert"]=$pic;
            }
            echo json_encode($rs,JSON_UNESCAPED_UNICODE);exit;
        }
    }
        
    //根据经纬度查询距离
    public function getwifiinfo(){
        $latitude = $_REQUEST['x'];
        $longitude = $_REQUEST['y'];
        $scale  = $_REQUEST['scale'];
        $latitude1 = $latitude - $scale;
        $latitude2 = $latitude + $scale;
        $longitude1 = $longitude - $scale;
        $longitude2 = $longitude + $scale;
        $wifi = M("wifi");
        $data = $wifi->where("latitude >= {$latitude1} and latitude <= {$latitude2} and longitude >= {$longitude1} and longitude <= {$longitude2}")->select();
        $rs['res'] = '200';
        $rs['info'] = $data;
        echo json_encode($rs,JSON_UNESCAPED_UNICODE);exit;
    }
    
}