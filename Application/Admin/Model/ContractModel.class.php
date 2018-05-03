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
        //权限判断 begin
        $key = '';
        $key2 = '';
        $member_id = $_SESSION['admin']['member']['member_id'];
        $member = M("member")->where("member_id='{$member_id}'")->find();
        if($member['role_id'] == 3){
            $key .= " and b.member_id='{$member_id}'";
        }else if($member['role_id'] == 4){
            $key1 = M("member")->where("member_del=1 and parent_id='{$member['member_id']}'")->find();
            if(!empty($key1)){
                $key11 = $key1['member_id'].",".$member['member_id'];
                $key2 = " and b.member_id in ($key11)";
            }else{
                $key2 = " and b.member_id='{$member['member_id']}'";
            }
        }
        //权限判断 end
        $count = $model
        ->table("zhiyan_contract b")
        ->where("b.contract_del=1 {$key} {$key2}".$str1['str'].$time['str'])
        ->count();
        $pageSize = 24;
        $page = page($count,$pageSize);
        $data = $model
        ->field("b.*")
        ->limit($page['first'].",".$page['list'])
        ->order("b.contract_id desc")
        ->table("zhiyan_contract b")
        ->where("b.contract_del=1 {$key} {$key2}".$str1['str'].$time['str'])
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
        logs("删除合同");
        add($flag,"删除成功","删除失败");
    }


	
}
