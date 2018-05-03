<?php
namespace Admin\Model;
use Think\Model;
class PropertyModel extends Model{
/************************************************ 审核管理模块 ****************************************/
	
	public function get_property_list(){
		$model = M();
		$str1 = search_like("c.channel_name","channel_name");
		$str2 = search_like("c.channel_wechat","channel_wechat");
		$time = search_time("c.channel_time","from","to");
		$key1 = search_key("c.type_id","type_id");
		$count = $model
	        ->table("zhiyan_property p, zhiyan_business b, zhiyan_customer c")
	        ->where("p.business_id=b.business_id and p.property_status=1 and b.customer_id=c.customer_id")
	        ->count();
        $pageSize = 24;
        $page = page($count,$pageSize);
        $data = $model
        	->field("b.*,p.property_id,c.customer_company,c.customer_name,p.property_total,p.property_come")
        	->limit($page['first'].",".$page['list'])
        	->table("zhiyan_property p, zhiyan_business b, zhiyan_customer c")
        	->order("property_id desc")
	        ->where("p.business_id=b.business_id and p.property_status=1 and b.customer_id=c.customer_id")
        	->select();
        foreach($data as $k=>$v){
            $data[$k]['member_name'] = M("member")
                ->where("member_id='{$v['member_id']}'")
                ->getField("member_name");
        	$data[$k]['create_time'] = date("Y-m-d",$v['create_time']);
        }
        $arr["total"] = $count;
        $arr["property"] = $data;
        $arr["link"] = $page['link'];
        $arr['channel_name'] = $str1['key'];
        $arr['channel_wechat'] = $str2['key'];
        $arr['from'] = $time['from'];
        $arr['to'] = $time['to'];
        return $arr;
	}

	public function get_property_list_remember(){
		$model = M();
		$str1 = search_like("c.channel_name","channel_name");
		$str2 = search_like("c.channel_wechat","channel_wechat");
		$time = search_time("c.channel_time","from","to");
		$key1 = search_key("c.type_id","type_id");
		$count = $model
            ->table("zhiyan_property p, zhiyan_business b, zhiyan_customer c")
            ->where("p.business_id=b.business_id and p.property_status=2 and b.customer_id=c.customer_id")
            ->count();
        $pageSize = 24;
        $page = page($count,$pageSize);
        $data = $model
            ->field("b.*,p.property_id,c.customer_company,c.customer_name,p.property_total,p.property_come")
            ->limit($page['first'].",".$page['list'])
            ->table("zhiyan_property p, zhiyan_business b, zhiyan_customer c")
            ->order("property_id desc")
            ->where("p.business_id=b.business_id and p.property_status=2 and b.customer_id=c.customer_id")
            ->select();
        foreach($data as $k=>$v){
            $data[$k]['member_name'] = M("member")
                ->where("member_id='{$v['member_id']}'")
                ->getField("member_name");
        	$data[$k]['update_time'] = date("Y-m-d H:i:s",$v['update_time']);
        }
        $arr["total"] = $count;
        $arr["property"] = $data;
        $arr["link"] = $page['link'];
        $arr['channel_name'] = $str1['key'];
        $arr['channel_wechat'] = $str2['key'];
        $arr['from'] = $time['from'];
        $arr['to'] = $time['to'];
        return $arr;
	}

    /* 要使用事务 */
	public function get_property_save(){
		$property = M("property");
		$map1['property_id'] = $_POST['id'];
		$res1['property_status'] = 2;
		$res1['update_time'] = time();
        $res1['pid'] = $_SESSION['admin']['member']['member_id'];
        /* 查找收款记录 */
		$pro = M("property")->where($map1)->find();
        /* 编辑收款记录 */
		$flag1 = M("property")->where($map1)->save($res1);
		$map2['business_id'] = $pro['business_id'];
		$business = M("business")->where($map2)->find();
        if($flag1){
            $res2['business_fkx'] = '';
            $flag2 = M("business")->where($map2)->save($res2);
            logs("确定审核收款");
            add($flag2, "收款确认成功", "设置失败");
        }else{
            $res3['business_wfk'] = $business['business_wfk']+$pro['property_come'];
            $flag2 = M("business")->where($map2)->save($res3);
            logs("确定审核收款");
            add($flag2, "收款确认失败", "设置失败");
        }
        
	}

    public function get_business_list(){
        $model = M();
        $count = $model
        ->table("zhiyan_business b")
        ->where("b.business_redel=2")
        ->count();
        $pageSize = 24;
        $page = page($count,$pageSize);
        $data = $model
        ->field("b.*")
        ->limit($page['first'].",".$page['list'])
        ->order("b.business_id desc")
        ->table("zhiyan_business b")
        ->where("b.business_redel=2".$str1['str'].$time['str'])
        ->select();
        foreach($data as $k=>$v){
                $data[$k]['member_name'] = M("member")
                ->where("member_id='{$v['member_id']}'")
                ->getField("member_name");
                $data[$k]['customer_name'] = M("customer")
                ->where("customer_id='{$v['customer_id']}'")
                ->getField("customer_name");
                $data[$k]['create_time'] = date("Y-m-d",$v['create_time']);
                $data[$k]['remind_time'] = date("Y-m-d",$v['remind_time']);
                if(!empty($v['update_time'])){
                        $data[$k]['update_time'] = date("Y-m-d",$v['update_time']);
                }else{
                        $data[$k]['update_time'] = "无";
                }
        }
        $arr["total"] = $count;
        $arr["business"] = $data;
        $arr["link"] = $page['link'];
        return $arr;       
    }

   public function get_business_del(){
        $id = $_POST['id'];
        $business = M("business");
        $arr['business_redel'] = 3;
        $arr['business_del'] = 2;
        $flag = $business->where("business_id in ($id)")->save($arr);
        logs("业务删除成功");
        add($flag,"业务删除成功","业务删除失败");
  }

  public function get_channel_list(){
        $model = M();
        $count = $model
        ->table("zhiyan_channel c, zhiyan_channel_type t")
        ->where("c.channel_redel=2 and c.type_id=t.type_id")
        ->count();
        $pageSize = 24;
        $page = page($count,$pageSize);
        $data = $model
        ->field("c.*,t.type_name")
        ->limit($page['first'].",".$page['list'])
        ->table("zhiyan_channel c, zhiyan_channel_type t")
        ->order("c.channel_sort desc, c.channel_id desc")
        ->where("c.channel_redel=2 and c.type_id=t.type_id")
        ->select();
        foreach($data as $k=>$v){
            $data[$k]['member_name'] = M("member")->where("member_id='{$v['member_id']}'")->getField("member_name");
            $data[$k]['channel_time'] = date("Y-m-d",$v['channel_time']);
        }
        $arr["total"] = $count;
        $arr["channel"] = $data;
        $arr["link"] = $page['link'];
        return $arr;
    }

    public function get_channel_del(){
        $id = $_POST['id'];
        $channel = M("channel");
        $arr['channel_redel'] = 3;
        $arr['channel_del'] = 2;
        $flag = $channel->where("channel_id in ($id)")->save($arr);
        logs("渠道删除成功");
        add($flag,"渠道删除成功","渠道删除失败");
    }

   public function get_pay_list(){
        $model = M();
        $count = $model
        ->table("zhiyan_pay p, zhiyan_business b")
        ->where("p.pay_status=1 and p.pay_del=1 and p.business_id=b.business_id")
        ->count();
        $pageSize = 24;
        $page = page($count,$pageSize);
        $data = $model
        ->field("p.*,b.business_name")
        ->limit($page['first'].",".$page['list'])
        ->table("zhiyan_pay p, zhiyan_business b")
        ->order("p.pay_id desc")
        ->where("p.pay_status=1 and p.pay_del=1 and p.business_id=b.business_id")
        ->select();
        foreach($data as $k=>$v){
            $data[$k]['member_name'] = M("member")
                ->where("member_id='{$v['member_id']}'")
                ->getField("member_name");
            $data[$k]['create_time'] = date("Y-m-d",$v['create_time']);
        }
        $arr["total"] = $count;
        $arr["pay"] = $data;
        $arr["link"] = $page['link'];
        return $arr;
    }

    public function get_pay_relist(){
        $model = M();
        $count = $model
        ->table("zhiyan_pay p, zhiyan_business b")
        ->where("p.pay_status!=1 and p.pay_del=1 and p.business_id=b.business_id")
        ->count();
        $pageSize = 24;
        $page = page($count,$pageSize);
        $data = $model
        ->field("p.*,b.business_name")
        ->limit($page['first'].",".$page['list'])
        ->table("zhiyan_pay p, zhiyan_business b")
        ->order("p.pay_id desc")
        ->where("p.pay_status!=1 and p.pay_del=1 and p.business_id=b.business_id")
        ->select();
        foreach($data as $k=>$v){
            $data[$k]['member_name'] = M("member")
                ->where("member_id='{$v['member_id']}'")
                ->getField("member_name");
            $data[$k]['create_time'] = date("Y-m-d",$v['create_time']);
        }
        $arr["total"] = $count;
        $arr["pay"] = $data;
        $arr["link"] = $page['link'];
        return $arr;
    }

    public function get_pay_del(){
        $map['pay_id'] = $_POST['id'];
        $arr['pay_status'] = 2;
        $arr['pay_time'] = time();
        $arr['parent_id'] = $_SESSION['admin']['member']['member_id'];
        $flag = M("pay")->where($map)->save($arr);
        logs("支出审核成功");
        add($flag,"审核成功","审核失败");
    }

    public function get_pay_redel(){
        $map['pay_id'] = $_POST['id'];
        $arr['pay_status'] = 3;
        $arr['pay_time'] = time();
        $arr['parent_id'] = $_SESSION['admin']['member']['member_id'];
        $flag = M("pay")->where($map)->save($arr);
        logs("支出审核不通过");
        add($flag,"审核成功","审核失败");
    }

    public function get_contract_list(){
        $model = M();
        $count = $model
        ->table("zhiyan_sign s")
        ->where("s.sign_status=1 and s.sign_del=1")
        ->count();
        $pageSize = 24;
        $page = page($count,$pageSize);
        $data = $model
        ->limit($page['first'].",".$page['list'])
        ->table("zhiyan_sign s")
        ->order("s.sign_id desc")
        ->where("s.sign_status=1 and s.sign_del=1")
        ->select();
        foreach($data as $k=>$v){
            $data[$k]['member_name'] = M("member")
                ->where("member_id='{$v['member_id']}'")
                ->getField("member_name");
            $data[$k]['create_time'] = date("Y-m-d",$v['create_time']);
            $data[$k]['sign_start_time'] = date("Y-m-d",$v['sign_start_time']);
            $data[$k]['sign_end_time'] = date("Y-m-d",$v['sign_end_time']);
        }
        $arr["total"] = $count;
        $arr["sign"] = $data;
        $arr["link"] = $page['link'];
        return $arr;
    }

    public function get_sign_del(){
        $map['sign_id'] = $_POST['id'];
        $arr['sign_status'] = 2;
        $arr['update_time'] = time();
        $arr['parent_id'] = $_SESSION['admin']['member']['member_id'];
        $flag = M("sign")->where($map)->save($arr);
        logs("签约审核成功");
        add($flag,"审核成功","审核失败");
    }

    public function get_sign_redel(){
        $map['sign_id'] = $_POST['id'];
        $arr['sign_status'] = 3;
        $arr['update_time'] = time();
        $arr['parent_id'] = $_SESSION['admin']['member']['member_id'];
        $flag = M("sign")->where($map)->save($arr);
        logs("签约审核不通过");
        add($flag,"审核成功","审核失败");
    }

    public function get_contract_relist(){
        $model = M();
        $count = $model
        ->table("zhiyan_sign s")
        ->where("s.sign_status!=1 and s.sign_del=1")
        ->count();
        $pageSize = 24;
        $page = page($count,$pageSize);
        $data = $model
        ->limit($page['first'].",".$page['list'])
        ->table("zhiyan_sign s")
        ->order("s.sign_id desc")
        ->where("s.sign_status!=1 and s.sign_del=1")
        ->select();
        foreach($data as $k=>$v){
            $data[$k]['member_name'] = M("member")
                ->where("member_id='{$v['member_id']}'")
                ->getField("member_name");
            $data[$k]['create_time'] = date("Y-m-d",$v['create_time']);
            $data[$k]['sign_start_time'] = date("Y-m-d",$v['sign_start_time']);
            $data[$k]['sign_end_time'] = date("Y-m-d",$v['sign_end_time']);
        }
        $arr["total"] = $count;
        $arr["sign"] = $data;
        $arr["link"] = $page['link'];
        return $arr;
    }


}
