<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class MY_Controller extends CI_Controller
{
	/**
	 +------------------------------------------------------
	 * 构造方法
	 +------------------------------------------------------
	 */
	public function __construct()
	{
		parent::__construct();
	}
	
	public function authorization_system()
	{
		if(!$this->session->userdata('username'))
		{

			redirect('http://localhost:8088/login');
		}
	}
	
	public function authorization_member()
	{
		// Enter code here ...
	}
	
	public function authorization_position()
	{
		// Enter code here ...
	}
	
	public function get_user_info($code, $appid, $appsecret)
	{
	    $access_token = "";
		
	    $access_token_url = "https://api.weixin.qq.com/sns/oauth2/access_token?appid=$appid&secret=$appsecret&code=$code&grant_type=authorization_code";
	    $access_token_json = $this->https_request($access_token_url);
	    $access_token_array = json_decode($access_token_json, true);
	    $access_token = $access_token_array['access_token'];
	    $openid = $access_token_array['openid'];
	
	    $userinfo_url = "https://api.weixin.qq.com/sns/userinfo?access_token=$access_token&openid=$openid&lang=zh_CN";
	    $userinfo_json = $this->https_request($userinfo_url);
	    $userinfo_array = json_decode($userinfo_json, true);
	    return $userinfo_array;
	}
	
	public function https_request($url)
	{
	    $curl = curl_init();
	    curl_setopt($curl, CURLOPT_URL, $url);
	    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);
	    curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, FALSE);
	    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
	    $data = curl_exec($curl);
	    if (curl_errno($curl)) {return 'ERROR '.curl_error($curl);}
	    curl_close($curl);
	    return $data;
	}
}