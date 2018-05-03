<?php
namespace Admin\Model;
use Think\Model;
class ContractModel extends Model{
/****************************** 合同管理模块 ********************************/
     
     public function get_contract_list(){
        $model = M();
        $str = "";
        $str1 = search_like("customer_brand","customer_brand");
        $time = search_time("customer_time","from","to");
        $count = $model
        ->table("zhiyan_contract c")
        ->where("c.contract_del=1".$str1['str'].$time['str'])
        ->count();
        $pageSize = 24;
        $page = page($count,$pageSize);
        $data = $model
        ->field("c.*")
        ->limit($page['first'].",".$page['list'])
        ->order("c.contract_id desc")
        ->table("zhiyan_contract c")
        ->where("c.contract_del=1".$str1['str'].$time['str'])
        ->select();
        foreach($data as $k=>$v){
                $data[$k]['contract_create'] = date("Y-m-d",$v['contract_create']);
        }
        $arr["total"] = $count;
        $arr["contract"] = $data;
        $arr["link"] = $page['link'];
        $arr['customer_brand'] = $str1['key'];
        $arr['from'] = $time['from'];
        $arr['to'] = $time['to'];
        return $arr;
     }

     public function get_contract_del(){
        $map["contract_id"] = $_POST['id'];
        $res1["contract_id"] = ' ';
        $res2["contract_del"] = 2;
        $business = M("Business");
        $del = M("contract")->where($map)->getField("contract_dir");
        if($del){ unlink("{$del}"); }
        $flag = M("contract")->where($map)->save($res2);
        $flag2 = $business->where($map)->save($res1);
        logs("删除客户");
        add($flag,"删除成功","删除失败");
    }


	
}
