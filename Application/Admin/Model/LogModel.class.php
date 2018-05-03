<?php
namespace Admin\Model;
use Think\Model;
class LogModel extends Model{
/************************************************ 系统日志管理模块 ****************************************/
     public function get_log_list(){
        $model = M();
        $str = "";
        $time = search_time("customer_time","from","to");
        $count = $model
        ->table("zhiyan_log c")
        ->where("log_del=1".$time['str'])
        ->count();
        $pageSize = 24;
        $page = page($count,$pageSize);
        $data = $model
        ->field("c.*")
        ->limit($page['first'].",".$page['list'])
        ->order("c.log_id desc")
        ->table("zhiyan_log c")
        ->where("log_del=1".$time['str'])
        ->select();
        foreach($data as $k=>$v){
        	$data[$k]['admin_name'] = M("member")
                ->where("member_id='{$v['member_id']}'")
                ->getField("member_name");
        	$data[$k]['log_time'] = date("Y-m-d",$v['log_time']);
        }
        $arr["total"] = $count;
        $arr["log"] = $data;
        $arr["link"] = $page['link'];
        $arr['from'] = $time['from'];
        $arr['to'] = $time['to'];
        return $arr;
     }

     public function get_log_del(){
	$id = $_POST['id'];
	$log = M("log");
	$arr['log_del'] = 2;
	$flag = $log->where("log_id in ($id)")->save($arr);
	logs("删除日志");
	del($flag, "删除成功", "删除失败");
    }

}
