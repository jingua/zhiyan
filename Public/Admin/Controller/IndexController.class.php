<?php
namespace Admin\Controller;
use Think\Controller;
use Org\Util\Rbac;
class IndexController extends Controller {
/******************************************** 首页管理模块 *************************************************/
    /**
     * method  后台首页模板
     * author  xiami
     * date    2018-01-31
    */
    public function index(){
        if(!isset($_SESSION['admin']['isLogin']) || empty($_SESSION['admin']['isLogin'])){
            $this->error("请先登录",U('Index/login'),1);
        }
        $this->display("index");
    }

    /**
     * method  后台欢迎页面模板
     * author  xiami
     * date    2018-01-31
    */
    public function welcome(){
    	$this->display("welcome");
    }

     /**
     * method  验证码
     * author  xiami
     * date    2018-01-31
    */
    public function verify(){
        $verify = new \Think\Verify();
        $verify->codeSet = "0123456789";
        $verify->fontSize = 28;
        $verify->length = 4;
        $verify->useNoice = true;
        $verify->imageW = 200;
        $verify->imageH = 60;
        $verify->useCurve = false;
        $verify->entry();
    }

     /**
     * method  管理员登录模板
     * author  xiami
     * date    2018-01-31
    */
    public function login(){

        $this->display('login');
    }

     /**
     * method  管理员执行登录
     * author  xiami
     * date    2018-01-31
     */
    public function login_save(){
        $arr['member_user'] = $_POST["admin_name"];
        $arr["member_pass"] = $_POST["admin_pass"];
        $arr["admin_code"] = $_POST['admin_code'];
        json($arr['member_user'],"登录帐号不能为空");
        json($arr['member_pass'],"登录密码不能为空");
        json($arr['admin_code'],"验证码不能为空");
        $verify = new \Think\Verify();
        if(!$verify->check($arr['admin_code'])){
            $data['ok'] = 301;
            $data['info'] = "验证码不正确";
            echo json_encode($data);
            exit;
        }
        $map['member_user'] = $_POST["admin_name"];
        $map['member_pass'] = md5(md5($_POST['admin_pass']));
        $member = M("member")->where($map)->find();
        if($member){
            if($member['member_status']==2){
                $data['ok'] = 301;
                $data['info'] = "您的用户已经被冻结，请您联系管理员！！！";
                echo json_encode($data);
                exit;
            }
            /*$Rbac= new Rbac();
            Rbac::setAccessList($member['member_id']);*/
            $res['member_num'] = $member['member_num']+1;
            $res['member_ip'] = ip2long($_SERVER['REMOTE_ADDR']);
            $res['update_time'] = time();
            $name = $_POST['admin_name'];
            $map1['member_user'] = $_POST['admin_name'];
            M("member")->where($map1)->save($res);
            session('isLogin',1);
            session('member',$member);
            session("member_name",$name);
            $data['ok'] = 200;
            $data['info'] = "登录成功";
            echo json_encode($data);
            exit;
        }else{
            $data['ok'] = 301;
            $data['info'] = "登录失败";
            echo json_encode($data);
            exit;
        }
    }

    /**
     * method  退出登录
     * author  xiami
     * date    2018-01-31
    */
    public function logout(){
        session(null);
        if(!session('?isLogin')||session('isLogin')!=1){
            $this->success('退出成功',U('Index/login'),1);
        }
    }
    
}