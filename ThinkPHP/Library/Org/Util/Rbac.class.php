<?php
namespace Org\Util;
use Think\Db;
class Rbac{

    //根据用户的ID查询出对应的所有的角色ID
    protected static function getRoleId($admin_id){
        $data = D("UserRole")->where("admin_id=%d",$admin_id)->select();
        foreach($data as $val){
            $role_id[] = $val['role_id'];
        }
        return $role_id;
    }

    //根据角色ID，查询出对应的所有的节点的ID
    protected static function getNodeId($role_id=array()){
        $rolenode = D("RoleNode");
        foreach($role_id as $val){
            $data = $rolenode->where("role_id=%d",$val)->select();
            foreach($data as $v){
                $node_id[] = $v['node_id'];
            }
        }
        return array_unique($node_id);
    }

    //查询当前用户的权限
    //根据节点id去节点表查询，获取节点所对应的控制器
    protected static function getAccessList($node_id=array()){
        $node = D("Node");
        $data = array();
        foreach($node_id as $nid){
            $n = $node->where('node_id=%d',$nid)->find();
            if($n['node_level']==1){
                $data[$n['node_name']] = array();
            }
        }
        //把查询出来的控制器进行循环的健值作为条件，去节点表去查询
        //控制器的id，   
        //p($data);
        foreach($data as $key=>$val){
            $id = $node->where("node_name='%s' and node_level=1",$key)->getField("node_id");
            //根据控制器的ID，查询出每一个控制器的方法的名称
            //循环节点id去节点表查询 pid 的值，如果控制器 id 
            //等于pid，以节点id作为条件去节点表查询 name 的值
            //然后组装数组以控制器为健名，方法为健值的数组
            foreach($node_id as $nid){
                $pid = $node->where("node_id=%d",$nid)->getField("node_pid");
                if($id==$pid){
                    $name = $node->where("node_id=%d",$nid)->getField("node_name");
                    $data[$key][] = $name;
                }
            }
            //echo "<hr/>";
        }
        return $data;
    }
    
    //设置SESSION
    public static function setAccessList($admin_id){
        $role_id = self::getRoleId($admin_id);
        $node_id = self::getNodeId($role_id);
        $accesslist = self::getAccessList($node_id);
        //p($accesslist);exit;
        return session("AccessList",$accesslist);
    }
    //检测权限
    public function checkAuth(){
        //(session('AccessList'));exit;
        if(!array_key_exists(CONTROLLER_NAME,session('AccessList'))){
            return false;
        }else{
            //($_SESSION[C("SESSION_PREFIX")]['AccessList'][CONTROLLER_NAME]);exit;
            if(!in_array(ACTION_NAME,$_SESSION[C("SESSION_PREFIX")]['AccessList'][CONTROLLER_NAME])){
                return false;
            }
        }
        return true; 
    }

} 