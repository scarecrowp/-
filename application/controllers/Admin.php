<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin extends MY_Controller
{
	/**
	 +------------------------------------------------------
	 * 构造方法
	 +------------------------------------------------------
	 */
	public function __construct()
	{

		parent::__construct();
		parent::authorization_system();
		$this->system = $this->config->item('system', 'vars_dir');

		$this->load->model('public_model', 'pub');
		header("Content-type: text/html; charset=utf-8");
	}
	
	/**
	 +------------------------------------------------------
	 * 用户列表
	 +------------------------------------------------------
	 */
	public function index()
	{
		$data['e'] = $this->pub->get('demo_user');

		$this->load->view('admin/admin', $data);
	}
	
	/**
	 +------------------------------------------------------
	 * 用户表单
	 +------------------------------------------------------
	 */
	public function edit()
	{
		$id = $this->uri->segment(3);
		if (!empty($id))
		{
			$data['e'] = $this->pub->get_one('demo_user', $id);
		}else {
			$data['e'] = $this->set_admin();
		}
      //  var_dump($data);
	 $this->load->view($this->system.'admin/admin_edit', $data);
	}
	
	/**
	 +------------------------------------------------------
	 * 数据处理
	 +------------------------------------------------------
	 */
	public function save()
	{
		$id = $this->input->post('id');
		$data['username'] = $this->input->post('username');
		$uname = $this->session->userdata('username');
		if($uname == $data['username'] || $uname == 'admin')
		{
			if ($this->input->post('password'))
			{
				$data['password'] = md5($this->input->post('password'));
			}
			if (!empty($id))
			{
				$e = $this->pub->update('admin', $data, $id);
				if ($e)
				{
					exit('保存成功');
				}else {
					exit('保存失败');
				}
			}else {
				if($data['username'] == $uname)
				{
					exit('不能重复为自己添加帐号');
				}
				$e = $this->pub->insert('admin', $data);
				if ($e)
				{
					exit('保存成功');
				}else {
					exit('保存失败');
				}
			}
		}else{
			exit('您没有权限进行此操作');	
		}
	}
	
	/**
	 +------------------------------------------------------
	 * 用户删除
	 +------------------------------------------------------
	 */
	public function del()
	{
		$id = $this->uri->segment(4);
		if ($id)
		{
			$e = $this->pub->del('admin', $id);
			if ($e)
			{
				exit('删除成功');
			}else {
				exit('删除失败 ');
			}
		}
	}
	
	/**
	 +------------------------------------------------------
	 * 设置数据
	 +------------------------------------------------------
	 */
	public function set_admin()
	{
		$data = array('id'=>'', 'username'=>'', 'password'=>'');
		return $data;
	}
}