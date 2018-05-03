<?php
class wechamin{
	private $appid = 'wx396e0119a5370b69';
    private $appsecret = '056e6b1243d1941bffbdcdd103a85e22';
	
	public function index(){
		//获得参数 signature,nonce,token,timestamp,echostr
		$signature 	= 	$_GET["signature"];
		$nonce		=	$_GET['nonce'];
		$token		=	'weixin';
		$timestamp 	=	$_GET['timestamp'];
		$echostr		=	$_GET['echostr'];
		//形成数组，然后按字典序排序
		$array	=	array();
		$array	=	array($nonce,$token,$timestamp);
		sort($array);
		//拼接成字符串，sha1加密并与singature进行校验
		$str = sha1(implode($array));
		if($str == $signature && $echostr){
			//第一次接入微信api验证
		/*	echo $echostr;
			exit;*/
		}else{
			ECHO $this->getWxAccessToken();
		}
	}
	//接收事件推送并回复
	public function responseMsg(){
		//接收微信推送的post数据（xml格式）
		$postArr = $GLOBALS['HTTP_RAW_POST_DATA'];
		//处理消息类型，并设置回复类型和内容
		$postObj = simplexml_load_string($postArr,'SimpleXMLElement',LIBXML_NOCDATA);
		$toUser 	 = $postObj->FromUserName;
		$fromUser = $postObj->ToUserName;
		$time 	 = time();
		//判断该数据包是否为订阅的推送事件
		if(strtolower($postObj->MsgType) == 'event'){
			//如果是关注subscribe事件
			if(strtolower($postObj->Event) == 'subscribe'){
				//回复用户消息
				$msgType  = 'text';
				$content  = '公众帐号'.$postObj->ToUserName .'\n微信用户的poenid'.$postObj->FromUserName .'\n回复消息格式'.$template;
				$template = "<xml>
							<ToUserName><![CDATA[%s]]></ToUserName>
							<FromUserName><![CDATA[%s]]></FromUserName>
							<CreateTime>%s</CreateTime>
							<MsgType><![CDATA[%s]]></MsgType>
							<Content><![CDATA[%s]]></Content>
							</xml>";
				$info 	 = sprintf($template,$toUser,$fromUser,$time,$msgType,$content);
				echo $info.'123';
			}
		}
		//文本回复
		if(strtolower($postObj->MsgType) == 'text' && strtolower($postObj->Content) == '图文'){
			$arr = array(
					array( 
						'title'=>'单图文回复',
						'description'=>'hello11111',
						'picurl'=>'http://news.xinhuanet.com/photo/2015-09/25/128267081_14431440714881n.jpg',
						'url'=>'http://www.baidu.com',
					),
					array( 
						'title'=>'单图文回复',
						'description'=>'hello11111',
						'picurl'=>'http://news.xinhuanet.com/photo/2015-09/25/128267081_14431440714881n.jpg',
						'url'=>'http://www.baidu.com',
					),
					array( 
						'title'=>'单图文回复',
						'description'=>'hello11111',
						'picurl'=>'http://news.xinhuanet.com/photo/2015-09/25/128267081_14431440714881n.jpg',
						'url'=>'http://www.baidu.com',
					),
			);
			$template = "<xml>
						<ToUserName><![CDATA[%s]]></ToUserName>
						<FromUserName><![CDATA[%s]]></FromUserName>
						<CreateTime>%s</CreateTime>
						<MsgType><![CDATA[%s]]></MsgType>
						<ArticleCount>".count($arr)."</ArticleCount>
						<Articles>";
			foreach($arr as $k=>$v){
				$template.= "<item>
							<Title><![CDATA[".$v['title']."]]></Title> 
							<Description><![CDATA[".$v['description']."]]></Description>
							<PicUrl><![CDATA[".$v['picurl']."]]></PicUrl>
							<Url><![CDATA[".$v['url']."]]></Url>
							</item>";
			}			
			$template.= "</Articles>
						</xml> ";
			$info = sprintf($template,$toUser,$fromUser,$time,'news');
			echo $info;
		}else{
			switch(trim($postObj->Content)){
				case 1:
					$content = '您输入的是1';
				break;
				case 2:
					$content = '您输入的是222222222222222222';
				break;
				case 'nihao':
					$content = 'hello';
				break;
				case '百度':
					$content = "<a href='http://www.baidu.com'>百度</a>";
				break;
			}
				$template = "<xml>
							<ToUserName><![CDATA[%s]]></ToUserName>
							<FromUserName><![CDATA[%s]]></FromUserName>
							<CreateTime>%s</CreateTime>
							<MsgType><![CDATA[%s]]></MsgType>
							<Content><![CDATA[%s]]></Content>
							</xml>";
				$msgType  = 'text';
				$info 	 = sprintf($template,$toUser,$fromUser,$time,$msgType,$content);
				echo $info;
		}
	}
	//curl操作,https get或者post请求方法
	function https_request($url,$data=null){
		$ch=curl_init();
		curl_setopt($ch,CURLOPT_URL,$url);
		curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
		curl_setopt($ch,CURLOPT_SSL_VERIFYPEER,false);
		curl_setopt($ch,CURLOPT_SSL_VERIFYHOST,false);
		if(!empty($data)){
			curl_setopt($ch,CURLOPT_POST,1);
			curl_setopt($ch,CURLOPT_POSTFIELDS,$data);
		}
		//curl_setopt($ch, CURLOPT_HEADER, 1);
		$output=curl_exec($ch);
		curl_close($ch);
		return $output;
	}
	//获取AccessToken
	function getWxAccessToken(){
		$url = "https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=".$this->appid."&secret=".$this->appsecret;
		$res = $this->https_request($url);
		$arr = json_decode($res,true);
		return $arr['access_token'];
	}
	//获取微信服务器IP
	function getWxServerIp(){
		$access_token = $this->getWxAccessToken();
		$url = "https://api.weixin.qq.com/cgi-bin/getcallbackip?access_token=".$access_token;
		$res = $this->https_request($url);
		$arr = json_decode($res,true);
		//var_dump ($arr);
		//return $arr;
	}
	//自定义菜单
	function customMenu(){
		$access_token = $this->getWxAccessToken();
		$json = '{
		 "button":[
		   {	
			   "type":"click",
			   "name":"你好!",
			   "key":"V1001_TODAY_MUSIC"
		   },
		   {
			   "name":"菜单",
			   "sub_button":[
			    {	
				   "type":"view",
				   "name":"aaaaaaaaaa",
				   "url":"http://www.focusinfotech.cn/index.php/home/test/wxpay"
				},
				{
				   "type":"view",
				   "name":"bbbbbbbbbbbbbb",
				   "url":"http://www.focusinfotech.cn/wxpayapi/index.php"
				},
				{
				   "type":"click",
				   "name":"赞一下我们",
				   "key":"V1001_GOOD"
				}]
		   }]
		}';
		$url = "https://api.weixin.qq.com/cgi-bin/menu/create?access_token=".$access_token;
		$res = $this->https_request($url,$json);
		//var_dump ($res);
	}
	//获取code
	public function getCode(){
		
			$redirect_uri = 'http://www.focusinfotech.cn/index.php/home/index/getWebAccessToken';
			$redirect_uri = urlencode($redirect_uri);
			$url = "https://open.weixin.qq.com/connect/oauth2/authorize?appid=".$this->appid."&redirect_uri=".$redirect_uri."&response_type=code&scope=snsapi_base&state=1#wechat_redirect";
			echo "<script language='javascript' type='text/javascript'>";
			echo "window.location.href='$url'";
			echo "</script>";
			
			//$this->getWebAccessToken();
		
		/* return $url; */
	}
	//通过code换取网页授权access_token
	public function getWebAccessToken(){
		if(!isset($_GET['code'])){
			$this->getCode();
		}
		$code = $_GET['code'];
        $tokenUrl = "https://api.weixin.qq.com/sns/oauth2/access_token?appid=".$this->appid."&secret=".$this->appsecret."&code=".$code."&grant_type=authorization_code";
        $webAccessToken = $this->https_request($tokenUrl);
		$tokenUrlArr = json_decode($webAccessToken,true);
		echo "<pre>";
		ECHO ($tokenUrlArr['openid']);
		echo "</pre>";
		//获取用户信息
		$url = "https://api.weixin.qq.com/sns/userinfo?access_token=".$tokenUrlArr['access_token']."&openid=".$tokenUrlArr['openid']."&lang=zh_CN";
		$info = $this->https_request($url);
		$arr1 = json_decode($info,true);
		/* echo "<pre>";
		print_r($arr1);
		echo "</pre>"; */
		//检验accesstoken是否有效
		$url1 = "https://api.weixin.qq.com/sns/auth?access_token=".$tokenUrlArr['access_token']."&openid=".$tokenUrlArr['openid'];
		$info1 = $this->https_request($url1);
		//var_dump($info1);
	}
}