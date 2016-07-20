<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends CI_Controller
{
	/**
	 +------------------------------------------------------
	 * 构造方法
	 +------------------------------------------------------
	 */
	public function __construct()
	{
		parent::__construct();
		$this->load->model('public_model', 'pub');
		$this->system = $this->config->item('system', 'vars_dir');
		header("Content-type: text/html; charset=utf-8");
	}
	
	/**
	 +------------------------------------------------------
	 * 登陆表单
	 +------------------------------------------------------
	 */
	public function index()
	{
		$data = array();

		$this->load->view('system/login', $data);
	}
	
	/**
	 +------------------------------------------------------
	 * 管理登陆
	 +------------------------------------------------------
	 */
	public function ilogin()
	{

		if ($this->input->post('action'))
		{
			$username = $this->input->post('username');
			$password = $this->input->post('password');

			$e = $this->pub->check_admin($username, $password);


			if ($e === true)
			{
				$this->session->set_userdata('username', $username);
				exit('登陆成功');
			}else {
				exit("帐号或密码错误，请检查");
			}
		}
		else
		{

		}
	}
	
	/**
	 +------------------------------------------------------
	 * 管理注销
	 +------------------------------------------------------
	 */
	public function logout()
	{
		$this->session->set_userdata('username', '');
		redirect(base_url()."system/login/login");
	}
}