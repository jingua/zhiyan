<?php
/**
 * method  手机号码验证
 * @param  $arr array
 * @param  $message string
 * author  xiami
 * date    2018-03-25
 * return  json
*/
function mobile($mobile, $message){
	$reg = "/^1[0-9]{10}$/";
	if(!preg_match($reg, $mobile)){  
	    $data['ok'] = 301;
	    $data['info'] = $message;
	    echo json_encode($data);
	    exit;
	}
}

/**
 * method  正则验证数据必须是字母数字下划线 6 到 12 位
 * author  xiami
 * date    2018-03-27
 * return  json
*/
function matchs($str, $message){
	$reg = "/^[a-zA-Z0-9_]{6,12}$/";
	if(!preg_match($reg, $str)){  
	    $data['ok'] = 301;
	    $data['info'] = $message;
	    echo json_encode($data);
	    exit;
	}
}

/**
 * method  邮箱验证
 * author  xiami
 * date    2018-03-27
 * return  json
*/
function emails($str, $message){
	$reg = "/^([a-zA-Z0-9_-])+@([a-zA-Z0-9_-])+(.[a-zA-Z0-9_-])+/";
    if(!preg_match($reg, $str)){
        $data['ok'] = 301;
        $data['info'] = $message;
        echo json_encode($data);
        exit;
    }
}

/**
 * method  昵称验证
 * author  xiami
 * date    2018-03-27
 * return  json
*/
function yourme($str, $message){
	$reg = "/^[a-zA-Z0-9_]{3,12}$/";
    if(!preg_match($reg, $str)){
        $data['ok'] = 301;
        $data['info'] = $message;
        echo json_encode($data);
        exit;
    }
}

/**
 * method  生日验证
 * author  xiami
 * date    2018-03-27
 * return  json
*/
function birthdays($str, $message){
	$reg = "/^(\d{4})(-)(\d{2})(-)(\d{2})$/"; 
    if(!empty($str)){
    	if(!preg_match($reg, $str)){
            $data['ok'] = 301;
            $data['info'] = $message;
            echo json_encode($data);
            exit;
        }
    }
}

/**
 * method  打印数据
 * author  xiami
 * date    2018-03-30
 * return  json
*/
function p($data){
	echo "<pre>";
	var_dump($data);exit;
	echo "</pre>";
}


/**
 * method  数量验证
 * author  xiami
 * date    2018-03-27
 * return  json
*/
function numbers($str, $message){
	 if(!is_numeric($str)){
    	$data['ok'] = 301;
        $data['info'] = $message;
        echo json_encode($data);
        exit;
    }
}
	
/**
 * method  判断数据库存是否存在此字段
 * author  xiami
 * date    2018-03-25
 * return  json
*/
function renames($name, $message){
	if($name){
		$data['ok'] = 301;
		$data['info'] = $message;
		echo json_encode($data);
		exit;
	}
}

/**
 * method  价格验证
 * author  xiami
 * date    2018-03-25
 * return  json
*/
function prices($str, $message){
	$reg = "/(^[-+]?[1-9]\d*(\.\d{1,2})?$)|(^[-+]?[0]{1}(\.\d{1,2})?$)/";
	if(!preg_match($reg,$str)){
	    $data['ok'] = 301;
	    $data['info'] = $message;
	    echo json_encode($data);
	    exit;
	}
}

/**
 * method  确认密码验证
 * @param  $arr array
 * @param  $message string
 * author  xiami
 * date    2018-03-25
 * return  json
*/
function repass($str1, $str2, $message){
	if($str1 != $str2){
		$data["ok"] = 301;
		$data['info'] = $message;
		echo json_encode($data);
		exit;
	}
}

/**
* method  添加系统日志
* @param  $arr array
* author  xiami
* date    2018-03-25
*/
function logs($message){
	$arr["member_id"] = $_SESSION['admin']['member']["member_id"];
	$arr["log_time"] = time();
	$arr["log_text"] = $message;
	M("log")->add($arr);
}

/**
 * method  返回 json 数据
 * @param  $arr array
 * @param  $message string
 * author  xiami
 * date    2018-01-21
 * return  json
 */
function json($arr, $message){
	if(empty($arr)){
		$data['ok'] = 301;
		$data['info'] = $message;
		echo json_encode($data); 
		exit;
	}
}

/**
 * method  添加数据返回
 * @param  $arr string
 * author  xiami
 * date    2018-01-21
 * return  json
 */
function add($arr, $str1, $str2){
	if($arr){
		$data["ok"] = 200;
		$data["info"] = $str1;
		echo json_encode($data);
		exit;
	}else{
		$data["ok"] = 301;
		$data["info"] = $str2;
		echo json_encode($data);
		exit;
	}
}

/**
 * method  编辑数据返回
 * @param  $arr string
 * author  xiami
 * date    2018-01-21
 * return  json
 */
function editor($arr, $str1, $str2){
	if($arr){
		$data["ok"] = 200;
		$data["info"] = $str1;
		echo json_encode($data);
		exit;
	}else{
		$data["ok"] = 301;
		$data["info"] = $str2;
		echo json_encode($data);
		exit;
	}
}

/**
 * method  删除数据返回
 * @param  $arr string
 * author  xiami
 * date    2018-01-21
 * return  json
 */
function del($arr, $str1, $str2){
	if($arr){
		$data["ok"] = 200;
		$data["info"] = $str1;
		echo json_encode($data);
		exit;
	}else{
		$data["ok"] = 301;
		$data["info"] = $str2;
		echo json_encode($data);
		exit;
	}
}

/**
 * method  单一上传图片
 * @param  $name 上传图片名称
 * @param  $name 上传图片路径
 * author  xiami
 * date    2018-01-21
 * return  string
 */
function upload_one($name, $dir){
	$pic = array_filter($name);
	if(count($pic)<=0){
		$data['ok'] = 301;
		$data['info'] = '上传图片不能为空';
		echo json_encode($data);
		exit;
	}else{
		$upload = new \Think\Upload();
		$upload->maxSize = 0;
		$upload->exts = array('jpg', 'gif', 'png', 'jpeg' ,'doc','pdf','docx','xlsx','xls');
		$upload->rootPath = "./Public/{$dir}/";
		if(!file_exists($upload->rootPath)){
			mkdir($upload->rootPath, 0777, true);
		}
		$upload->autoSub = false;
		$info = $upload->upload();
		$pic = $upload->rootPath.$info[0]['savename'];
		$url = C("HOST_URL");
		return $url."{$dir}/".$info[0]['savename'];
	}
}

/**
 * method  分页
 * @param  $count 总的记录条数
 * @param  $pageSize 每页显示条数
 * author  xiami
 * date    2018-01-21
 * return  array
 */
function page($count,$pageSize){
	$page = new \Think\Page($count, $pageSize);
	$page->setConfig("first","首页");
	$page->setConfig("prev","上一页");
	$page->setConfig("next","下一页");
	$page->setConfig("last","尾页");
	$arr['first'] = $page->firstRow;
	$arr['list'] = $page->listRows;
	$arr['link'] = $page->show();
	return $arr;
}

/**
 * method  分页
 * @param  $count 总的记录条数
 * @param  $pageSize 每页显示条数
 * author  xiami
 * date    2018-01-21
 * return  array
 */
function page1($count, $page, $prev='上一页', $next='下一页', $last='末页', $first='首页'){
	$Page = new \Think\Page($count,$page);
	$Page->setConfig('prev',$prev);
	$Page->setConfig('next',$next);
	$Page->setConfig('last',$last);
	$Page->setConfig('first',$first);
	$show['first'] = $Page->firstRow;
	$show['list']  = $Page->listRows;
	$show['show']  = $Page->show();
	return $show;
}

/**
 * method  模糊搜索关键字
 * @param  $name 数据库搜索关键字
 * @param  $key 要搜索的关键字
 * author  xiami
 * date    2018-01-21
 * return  array
 */
function search_like($name, $key){
	$key = $_POST[$key];
	if(!empty($key)){
		$arr['key'] = $key;
		$arr['str'] = " and {$name} like '%{$key}%'";
		return $arr;
	}
}

/**
 * method  普通搜索关键字
 * @param  $name 数据库搜索关键字
 * @param  $key 要搜索的关键字
 * author  xiami
 * date    2018-01-21
 * return  array
 */
function search_key($name, $key){
	$key = $_POST[$key];
	if(!empty($key)){
		$arr['key'] = $key;
		$arr['str'] = " and {$name}='{$key}'";
		return $arr;
	}
}

/**
 * method  搜索时间
 * @param  $arr 数据库时间字段
 * @param  $arr 开始时间
 * @param  $arr 结束时间
 * author  xiami
 * date    2018-01-21
 * return  array
 */
function search_time($time, $from, $to){
	$from = $_POST[$from];
	$to = $_POST[$to];
	if($from && $to){
		$str['from'] = $from;
		$str['to'] = $to;
		$str['str'] = " and from_unixtime($time) between '{$from}' and '{$to}'";
		return $str;
	}
}

/**
 * method  获取星期
 * author  xiami
 * date    2018-03-35
 * return  array
 */
function week(){
	$week = date("w"); 
	if( $week == "1" ){ 
		return "星期一"; 
	}else if( $week == "2" ){ 
		return "星期二"; 
	}else if( $week == "3" ){ 
		return "星期三"; 
	}else if( $week == "4" ){ 
		return "星期四"; 
	}else if( $week == "5" ){ 
		return "星期五"; 
	}else if( $week == "6" ){ 
		return "星期六"; 
	}else if( $week == "0" ){ 
		return "星期日"; 
	}
}


//计算商品总价
function pricestotal($price,$counts){
	$result = $price * $counts;
	return $result;
}


//计算所有商品总价
function totalPrices($res1){
	$totalPrice = 0;
	foreach($res1 as $v){
		$s = $v['detail_goods_price'] * $v['detail_goods_num'];
		$totalPrice += $s;
	}
	return $totalPrice;
}


//订单编号
function getOrderId(){
	$orderId=time();
	for($i=0;$i<3;$i++){
		$orderId .=rand(0,9);
	}
	return $orderId;
}

//上传文件
function upload($savePath,$file,$maxSize=0,$thumb=true,$exts,$rootPath=''){
set_time_limit(0);
$config = array(
	'maxSize'    =>    $maxSize,
	'rootPath'   =>    'Public/',
	'savePath'   =>    $savePath.'/',
	'saveName'   =>    array('uniqid',''),
	'exts'       =>    array('jpg','gif','png','jpeg',"mp4"),// 设置附件上传类型
	'autoSub'    =>    true,
	'subName'    =>    array('date','Ymd'),
);
if(is_array($exts)){
	$config['exts']=$exts;
}
if(!empty($rootPath)){
	$config['rootPath']=$rootPath;
}
$upload = new \Think\Upload($config);
if(!file_exists($upload->rootPath.'/'.$savePath)){
	mkdir($upload->rootPath.'/'.$savePath,0777,true);
}
if($thumb){
	$image = new \Think\Image(); 
}
if(!empty($file) && !is_array($file)){
	$info=$upload->uploadOne($_FILES[$file]);
	if(in_array($info['ext'],array('jpg', 'gif', 'png', 'jpeg'))&&$thumb){
		$image->open($config['rootPath'].$info['savepath'].$info['savename']);	
		if(!file_exists($config['rootPath'].'thumb/'.$info['savepath'])){
			mkdir($config['rootPath'].'thumb/'.$info['savepath'],0777,true);
		}
		$image->thumb(100,100)->save($config['rootPath'].'thumb/'.$info['savepath'].$info['savename']);
		$info['thumb']=$config['rootPath'].'thumb/'.$info['savepath'].$info['savename'];
		$info['imgpath']=$info['savepath'].$info['savename'];
	}else{
		$info['imgpath']=$info['savepath'].$info['savename'];	
	}	
}else{
	$info=$upload->upload($file);
	if(!is_array($info)){
		$info=$upload->upload();	
	}
	if($thumb&&$info){
		foreach($info as $key=>$val){
			if(in_array($val['ext'],array('jpg', 'gif', 'png', 'jpeg'))){
				$image->open($config['rootPath'].$val['savepath'].$val['savename']);
				if(!file_exists($config['rootPath'].'thumb/'.$val['savepath']))mkdir($config['rootPath'].'thumb/'.$val['savepath'],0777,true);
				// 按照原图的比例生成一个最大为150*150的缩略图
				$image->thumb(300,300)->save($config['rootPath'].'thumb/'.$val['savepath'].$val['savename']);
				$info[$key]['thumb']=$config['rootPath'].'thumb/'.$val['savepath'].$val['savename'];
				$info[$key]['imgpath']=$val['savepath'].$val['savename'];
			}
		}
	}elseif(!$thumb&&$info){
		foreach($info as $key=>$val){
			$info[$key]['imgpath']=$val['savepath'].$val['savename'];
		}		
		}
}
if($info){
	return $info;	
}
else return $upload->getError();	
}	

//上传图片
function fileUpload($uploadfile, $message){
$config = array(
	'mimes' => '', 
	'maxSize' => 6 * 1024 * 1024, 
	'exts' => array('jpg', 'gif', 'png', 'jpeg'),
	'autoSub' => true, 
	'subName' => array('date', 'Y-m-d'),
	'rootPath' => 'Public/',
	'savePath' => 'upload/game',
	'saveName'   => array('uniqid',''),
	 );	
$uploader = new \Think\Upload($config);
$info = $uploader->upload($uploadfile);
if($info){
foreach ($info as &$file) {
    $file['rootpath'] = ltrim($config['rootPath'], "..");
    $file['filepath'] = $file['rootpath'] . $file['savepath'] . $file['savename'];
}
$filepath = $file['filepath'];
$return_data['picture'] = $filepath;
$return_data['error'] = $message;
$return_data['img_path'] = $file['savepath'] . $file['savename'];
return $return_data;
} else {
$error_msg = $uploader->getError() ;
$return_data['error'] = $error_msg;
return $return_data;
}
}

function unicode2utf8($str){
if(!$str) return $str;
  $decode = json_decode($str);
if($decode) return $decode;
$str = '["' . $str . '"]';
$decode = json_decode($str);
if(count($decode) == 1){
return $decode[0];
}
return $str;
}


/*
* page() 分页插件
* @return $show['first'] 截取首
* @return $show['list'] 截取尾
* @return $show['show'] 分页输出
* $count 分页总数量
* $page 每页显示记录数
* $prev 上一页命名
* $next 下一页命名
* $last 末页命名
* $first 首页命名
*/

/*
*jump 弹窗跳转
*  $msg 消息内容
*  $url 跳转网址 ，不输入的话，执行后退操作
*/
function jump($msg , $url = '') {
echo "<meta http-equiv='Content-Type'' content='text/html; charset=utf-8'>";
if($url) {
    echo "<script>alert('".$msg."');location = '".$url."';</script>";
}else {
    echo "<script>alert('".$msg."');history.go(-1);</script>";
}
}
/*
* uploads 上传函数
* @path 保存路径
*/
function upload_path($path){
//获取新的文件以及相关信息，并且更新字段
$path = '.'.C('TMPL_PARSE_STRING.__PUBLIC__').'/Uploads/'.$path.'/';
$name = date('YmdHis',time()).'_'.mt_rand(0,100);
$upload = new \Think\Upload();
$upload->maxSize   =     31457288 ;//文件小于30m
$upload->exts      =     array('jpg', 'gif', 'png', 'jpeg');
$upload->rootPath  =     $path;//自定义保存路径
$upload->saveName  =     $name;//自定义保存名字，年月日时分秒+0~100的随机数
$upload->savePath  =     '';
$upload->autoSub = false;//关闭子目录
$info   =   $upload->upload(); // 上传文件
$arrs=$info['pic']['savename'];//获取保存的名字
return $arrs;
}

function check_code($code, $id = ''){
    $verify = new \Think\Verify();
    return $verify->check($code, $id);
}






?>