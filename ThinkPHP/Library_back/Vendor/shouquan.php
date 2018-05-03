<?php
class shouquan {
	public $appId = "wx06d63d99c9d45c2e";
	public $appSecret = "899eb90d628ae55a4dca3b2524784606";

	public function get_authorize_url($redirect_uri = '', $snsapi = 'base', $state = 1) {
		$redirect_uri = urlencode($redirect_uri);
		$url = "https://open.weixin.qq.com/connect/oauth2/authorize?appid={$this->appId}&redirect_uri={$redirect_uri}&response_type=code&scope=snsapi_{$snsapi}&state={$state}#wechat_redirect";
		header("Location: $url");
		exit ;
	}

	public function getWebAccessToken() {
		$code = $_GET['code'];
		$tokenUrl = "https://api.weixin.qq.com/sns/oauth2/access_token?appid={$this->appId}&secret={$this->appSecret}&code=" . $code . "&grant_type=authorization_code";
		$webAccessToken = $this -> https_request($tokenUrl);
		$tokenUrlArr = json_decode($webAccessToken, true);
		if ($_GET['state'] == 2) {
			$url = "https://api.weixin.qq.com/sns/userinfo?access_token=" . $tokenUrlArr['access_token'] . "&openid=" . $tokenUrlArr['openid'] . "&lang=zh_CN";
			$info = $this -> https_request($url);
			return json_decode($info, true);
		}
		return $tokenUrlArr;
	}
	
	public function getuserinfo($openid){
		$access_token = $this->getAccessToken();
		$url = "https://api.weixin.qq.com/cgi-bin/user/info?access_token=".$access_token."&openid=".$openid."&lang=zh_CN";
		$info = $this->https_request($url);
		return json_decode($info, true);
	}

	public function getSignPackage() {
		$jsapiTicket = $this -> getJsApiTicket();
		// 注意 URL 一定要动态获取，不能 hardcode.
		$protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";
		$url = "$protocol$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
		$timestamp = time();
		$nonceStr = $this -> createNonceStr();
		// 这里参数的顺序要按照 key 值 ASCII 码升序排序
		$string = "jsapi_ticket=$jsapiTicket&noncestr=$nonceStr&timestamp=$timestamp&url=$url";
		$signature = sha1($string);
		$signPackage = array("appId" => $this ->appId, "nonceStr" => $nonceStr, "timestamp" => $timestamp, "url" => $url, "signature" => $signature, "rawString" => $string);
		return $signPackage;
	}

	public function createNonceStr($length = 16) {
		$chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
		$str = "";
		for ($i = 0; $i < $length; $i++) {
			$str .= substr($chars, mt_rand(0, strlen($chars) - 1), 1);
		}
		return $str;
	}

	public function getJsApiTicket() {
		// jsapi_ticket 应该全局存储与更新，以下代码以写入到文件中做示例
		$data = json_decode(file_get_contents("jsapi_ticket.json"));
		if ($data ->expire_time < time()) {
			$accessToken = $this -> getAccessToken();
			// 如果是企业号用以下 URL 获取 ticket
			// $url = "https://qyapi.weixin.qq.com/cgi-bin/get_jsapi_ticket?access_token=$accessToken";
			$url = "https://api.weixin.qq.com/cgi-bin/ticket/getticket?type=jsapi&access_token=$accessToken";
			$res = json_decode($this -> https_request($url));
			$ticket = $res ->ticket;
			if ($ticket) {
				$data ->expire_time = time() + 7000;
				$data ->jsapi_ticket = $ticket;
				$fp = fopen("jsapi_ticket.json", "w");
				fwrite($fp, json_encode($data));
				fclose($fp);
			}
		} else {
			$ticket = $data ->jsapi_ticket;
		}
		return $ticket;
	}

	public function getAccessToken() {
		// access_token 应该全局存储与更新，以下代码以写入到文件中做示例
		$data = json_decode(file_get_contents("access_token.json"));
		if ($data ->expire_time < time()) {
			// 如果是企业号用以下URL获取access_token
			// $url = "https://qyapi.weixin.qq.com/cgi-bin/gettoken?corpid=$this->appId&corpsecret=$this->appSecret";
			$url = "https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=".$this->appId."&secret=".$this->appSecret;
			$res = json_decode($this -> https_request($url));
			$access_token = $res ->access_token;
			if ($access_token) {
				$data ->expire_time = time() + 7000;
				$data ->access_token = $access_token;
				$fp = fopen("access_token.json", "w");
				fwrite($fp, json_encode($data));
				fclose($fp);
			}
		} else {
			$access_token = $data ->access_token;
		}
		return $access_token;
	}

	//curl操作,https get或者post请求方法
	public function https_request($url, $data = null) {
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
		if (!empty($data)) {
			curl_setopt($ch, CURLOPT_POST, 1);
			curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
		}
		//curl_setopt($ch, CURLOPT_HEADER, 1);
		$output = curl_exec($ch);
		curl_close($ch);
		return $output;
	}

}
