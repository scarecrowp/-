<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Product extends MY_Controller
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
		$this->load->library('pagination');
		$this->load->model('public_model', 'pub');
		$this->system = $this->config->item('system', 'vars_dir');
		header("Content-type: text/html; charset=utf-8");
	}
	
	/**
	 +------------------------------------------------------
	 * 产品列表
	 +------------------------------------------------------
	 */
	public function index()
	{
		$page_size = 15;
		$config['base_url'] = base_url().'system/product/index';
		$config['total_rows'] = $this->pub->get_page_total('product');
		$config['per_page'] = $page_size;
		$config['first_link'] = '首页';
		$config['prev_link'] = '上页';
		$config['next_link'] = '下页';
		$config['last_link'] = '末页';
		$config['cur_tag_open'] = '<a class="active">';
		$config['cur_tag_close'] = '</a>';
		$config['num_links'] = 10;
		$config['uri_segment'] = 4;
		$this->pagination->initialize($config);
		$offset = intval($this->uri->segment(4));
		$data['e'] = $this->pub->get_page($offset, $page_size, 'product');
		$data['page'] = $this->pagination->create_links();

		$this->load->view($this->system.'product', $data);
	}
	
	/**
	 +------------------------------------------------------
	 * 产品表单
	 +------------------------------------------------------
	 */
	public function edit()
	{
		$id = $this->uri->segment(3);
		if (!empty($id))
		{
			$data['e'] = $this->pub->get_one('product', $id);
			$data['photo'] = $this->pub->get('product_photo', array('productid'=>$data['e']['id']));
		}else {
			$data['e'] = $this->set_product();
			$data['photo'] = $data['e']['photo'];
		}
		$data['class'] = $this->pub->get('product_class'); 
		$this->load->view($this->system.'product_edit', $data);
	}
	
	/**
	 +------------------------------------------------------
	 * 产品处理
	 +------------------------------------------------------
	 */
	public function save()
	{
		if ($this->input->post('action'))
		{
			$id = $this->input->post('id');
			$data['title'] = $this->input->post('title');
			$data['classid'] = $this->input->post('classid');
			$data['price'] = $this->input->post('price');
			$data['color'] = $this->input->post('color');
			$data['content'] = $this->input->post('content');
			$data['brand'] = $this->input->post('brand');
			$data['design'] = $this->input->post('design');
			$data['number'] = $this->input->post('number');
			$data['thumb'] = $this->input->post('thumb');
		//	$thumbinfo = getimagesize(base_url().$data['thumb']);
//			if ($thumbinfo[0] != 297 && $thumbinfo != 255)
//			{
//				exit('缩略图尺寸有误，请重新上传');
//			}
			$photo = $this->input->post('photo');
			if (!empty($id))
			{
				$this->db->delete('product_photo', array('productid'=>$id));
				if ($photo)
				{
					foreach ($photo as $key => $val)
					{
						$p['productid'] = $id;
						$p['photo'] = $val;
						$this->pub->insert('product_photo', $p);
					}
				}
				$e = $this->pub->update('product', $data, $id);
				if ($e)
				{
					exit('保存成功');
				}else {
					exit('保存失败');
				}
			}else {
				$e = $this->pub->insert('product', $data);
				$id = $this->db->insert_id();
				if (!empty($id) && $photo)
				{
					foreach ($photo as $key => $val)
					{
						$p['productid'] = $id;
						$p['photo'] = $val;
						$this->pub->insert('product_photo', $p);
					}
				}
				if ($e)
				{
					exit('保存成功');
				}else {
					exit('保存失败');
				}
			}
		}
	}
	
	/**
	 +------------------------------------------------------
	 * 产品删除
	 +------------------------------------------------------
	 */
	public function del()
	{
		$id = $this->uri->segment(3);
		if ($id)
		{
			$e = $this->pub->del('product', $id);
			$e = $this->db->delete('product_photo', array('productid'=>$id));
			if ($e)
			{
				exit('删除成功');
			}else {
				exit('删除失賖 ');
			}
		}
	}
	
	/**
	 +------------------------------------------------------
	 * 设置数据
	 +------------------------------------------------------
	 */
	public function set_product()
	{
		$data = array('id'=>'', 'classid'=>'', 'title'=>'', 'price'=>'', 'color'=>'', 'content'=>'', 'brand'=>'', 'design'=>'', 'thumb'=>'', 'photo'=>array(), 'number'=>'');
		return $data;
	}
	
	/**
	 +------------------------------------------------------
	 * 分类列表
	 +------------------------------------------------------
	 */
	public function class_list()
	{
		$data['e'] = $this->pub->get('product_class', false, 'sort asc');
		$this->load->view($this->system.'product_class', $data);
	}
	
	/**
	 +------------------------------------------------------
	 * 分类排序
	 +------------------------------------------------------
	 */
	public function class_sort()
	{
		$ids = $this->input->post('id');
		$sorts = $this->input->post('sort');
		foreach ($ids as $k=>$v)
		{
			$e = $this->db->update('product_class', array('sort'=>$sorts[$k]), array('id'=>$v));
		}
		if ($e)
		{
			exit('更新成功');
		}else {
			exit('更新失败');
		}
	}
	
	/**
	 +------------------------------------------------------
	 * 分类表单
	 +------------------------------------------------------
	 */
	public function class_edit()
	{
		$id = $this->uri->segment(3);
		if (!empty($id))
		{
			$data['e'] = $this->pub->get_one('product_class', $id);
		}else {
			$data['e'] = $this->set_class();
		}

		$this->load->view($this->system.'product_class_edit', $data);
	}
	
	/**
	 +------------------------------------------------------
	 * 分类处理
	 +------------------------------------------------------
	 */
	public function class_save()
	{
		$id = $this->input->post('id');
		$data['classname'] = $this->input->post('classname');
		$data['ico'] = $this->input->post('ico');
		$data['icohover'] = $this->input->post('icohover');
		if (!empty($id))
		{
			$e = $this->pub->update('product_class', $data, $id);
			if ($e)
			{
				exit('保存成功');
			}else {
				exit('保存失败');
			}
		}else {
			$e = $this->pub->insert('product_class', $data);
			if ($e)
			{
				exit('保存成功');
			}else {
				exit('保存失败');
			}
		}
	}
	
	/**
	 +------------------------------------------------------
	 * 分类删除
	 +------------------------------------------------------
	 */
	public function class_del()
	{
		$id = $this->uri->segment(3);
		if ($id)
		{
			$e = $this->pub->del('product_class', $id);
			if ($e)
			{
				exit('删除成功');
			}else {
				exit('删除失賖 ');
			}
		}
	}
	
	/**
	 +------------------------------------------------------
	 * 设置数据
	 +------------------------------------------------------
	 */
	public function set_class()
	{
		$data = array('id'=>'', 'classname'=>'', 'ico'=>'', 'icohover'=>'');
		return $data;
	}
	
	/**
	 +------------------------------------------------------
	 * 预约列表
	 +------------------------------------------------------
	 */
	public function apply()
	{
		$page_size = 15;
		$config['base_url'] = base_url().'system/product/apply';
		$config['total_rows'] = $this->pub->get_page_total('apply');
		$config['per_page'] = $page_size;
		$config['first_link'] = '首页';
		$config['prev_link'] = '上页';
		$config['next_link'] = '下页';
		$config['last_link'] = '末页';
		$config['cur_tag_open'] = '<a class="active">';
		$config['cur_tag_close'] = '</a>';
		$config['num_links'] = 10;
		$config['uri_segment'] = 4;
		$this->pagination->initialize($config);
		$offset = intval($this->uri->segment(4));
		
		$data['e'] = $this->pub->get_page($offset, $page_size, 'apply', false, 'postdate desc');
		$data['page'] = $this->pagination->create_links();

		$this->load->view($this->system.'product_apply', $data);
	}
	public function applyList()
	{
		$page_size = 15;
		$config['base_url'] = base_url().'system/product/apply';
		$config['total_rows'] = $this->pub->get_page_total('apply');
		$config['per_page'] = $page_size;
		$config['first_link'] = '首页';
		$config['prev_link'] = '上页';
		$config['next_link'] = '下页';
		$config['last_link'] = '末页';
		$config['cur_tag_open'] = '<a class="active">';
		$config['cur_tag_close'] = '</a>';
		$config['num_links'] = 10;
		$config['uri_segment'] = 4;
		$this->pagination->initialize($config);
		$offset = intval($this->uri->segment(5));
		$stype= intval($this->uri->segment(4));
		$data['e'] = $this->pub->get_page($offset, $page_size, 'apply',  array('status'=>$stype), 'postdate desc');
		$data['page'] = $this->pagination->create_links();
	
		$this->load->view($this->system.'product_apply', $data);
	}
	/**
	 +------------------------------------------------------
	 * 预约更新
	 +------------------------------------------------------
	 */
	public function apply_edit()
	{
		$k = $this->input->post('k');
		$id = $this->input->post('id');
		$data['status'] = $this->input->post('radios'.$k);
		switch ($data['status'])
		{
			case '0': $data['returninfo'] = '审核中，请耐心等候'; break;
			case '1': $data['returninfo'] = '预约成功，礼品将在15个工作日内配送'; break;
			case '2': $data['returninfo'] = '已发货'; break;
			default: $data['returninfo'] = $this->input->post('returninfo');
		}
		if ($this->db->update('apply', $data, array('id'=>$id)))
		{
			exit('更新成功');
		}else {
			exit('更新失败');
		}
	}
	
	/**
	 +------------------------------------------------------
	 * 预约删除
	 +------------------------------------------------------
	 */
	public function apply_del()
	{
		$id = $this->uri->segment(4);
		if ($id)
		{
			$e = $this->pub->del('apply', $id);
			if ($e)
			{
				exit('删除成功');
			}else {
				exit('删除失賖 ');
			}
		}
	}
	
	/**
	 +------------------------------------------------------
	 * 数据输出
	 +------------------------------------------------------
	 */
	public function response()
	{
		header("Content-type:text/html; charset=utf-8");
		$data['e'] = $this->pub->get('apply', false, 'postdate desc');
		$this->load->view($this->system.'response', $data);
	}
}