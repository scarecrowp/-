<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller
{

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 *        http://example.com/index.php/welcome
	 *    - or -
	 *        http://example.com/index.php/welcome/index
	 *    - or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Qustion_model', 'ques');
		$this->load->model('public_model', 'pub');
	}

	public function index()
	{

		$this->load->view('index');
	}

	public function submit()
	{

		$data['for_name'] = $this->input->post('for_name');
		$data['content'] = $this->input->post('content');
		$this->ques->insert('questions', $data);
		exit('保存成功');

	}

	public function content()
	{
		$this->load->view('content');
	}

	public function getMaxID($table = "questions_select")
	{
		$maxid = $this->ques->maxID($table);
		exit($maxid);
	}

	public function getMaxQuestionID()
	{
		return $this->ques->maxID("questions");
	}
	public  function getLastContent($mid)
	{
		//$mid =$this->input->post("ID");
		$res=$this->ques->getLastContent($mid);
		echo json_encode($res);
	}
	public function admin()
	{
		$this->load->library('pagination');
		$this->load->model('public_model', 'pub');
		$page_size = 15;
		$config['base_url'] = base_url().'Welcome/admin';
		$config['total_rows'] = $this->pub->get_page_total('questions');
		$config['per_page'] = $page_size;
		$config['first_link'] = '首页';
		$config['prev_link'] = '上页';
		$config['next_link'] = '下页';
		$config['last_link'] = '末页';
		$config['cur_tag_open'] = '<a class="active">';
		$config['cur_tag_close'] = '</a>';
		$config['num_links'] = 10;
		$config['uri_segment'] = 3;
		$this->pagination->initialize($config);
		if(isset( $_COOKIE["order"]))
		{
			$order =  $_COOKIE["order"];
		}
		else
		{
			$order = 'create_time desc';
		}
		$offset = intval($this->uri->segment(3));
		$data['e'] = $this->pub->get_page($offset, $page_size, 'questions',false,$order);
		$data['page'] = $this->pagination->create_links();
		$data['maxid'] =$this->ques->maxID("questions");
		$this->load->view('qustion', $data);
	}
	public function checkIsHasNew($oid)
	{
		exit($this->ques->isHasNewRecord('questions',$oid)) ;
	}
	public function order()
	{
		$this->setPage();
		$page_size = 15;
		if(isset( $_COOKIE["order"]))
		{
			if(explode(' ',$_COOKIE["order"])[0]=='create_time')
			{
				if(explode(' ',$_COOKIE["order"])[1]=='asc')
				{
					$_COOKIE["order"] ='create_time desc';
				}
				else
				{
					$_COOKIE["order"] ='create_time asc';
				}
			}
			else
			{
				$_COOKIE["order"] ='create_time asc';
			}
		}
		else
		{
			$_COOKIE["order"] = 'create_time desc';
		}

		setcookie('order',$_COOKIE["order"],time()+36000);
		$offset = intval($this->uri->segment(3));
		$data['e'] = $this->pub->get_page($offset, $page_size, 'questions',false,$_COOKIE["order"]);
		$data['page'] = $this->pagination->create_links();

		$this->load->view('qustion', $data);
	}
	function setPage()
	{
		$this->load->library('pagination');
		$this->load->model('public_model', 'pub');
		$page_size = 15;
		$config['base_url'] = base_url().'Welcome/admin';
		$config['total_rows'] = $this->pub->get_page_total('questions');
		$config['per_page'] = $page_size;
		$config['first_link'] = '首页';
		$config['prev_link'] = '上页';
		$config['next_link'] = '下页';
		$config['last_link'] = '末页';
		$config['cur_tag_open'] = '<a class="active">';
		$config['cur_tag_close'] = '</a>';
		$config['num_links'] = 10;
		$config['uri_segment'] = 3;
		$this->pagination->initialize($config);

	}
	public function status()
	{
		$this->setPage();
		$page_size = 15;

		if(isset( $_COOKIE["order"]))
		{
			if(explode(' ',$_COOKIE["order"])[0]=='is_ok')
			{
				if(explode(' ',$_COOKIE["order"])[1]=='asc')
				{
					$_COOKIE["order"] ='is_ok desc';
				}
				else
				{
					$_COOKIE["order"] ='is_ok asc';
				}
			}
			else
			{
				$_COOKIE["order"] ='is_ok desc';
			}
		}
		else
		{
			$_COOKIE["order"] = 'is_ok desc';
		}
		setcookie('order',$_COOKIE["order"],time()+36000);
		$offset = intval($this->uri->segment(3));
		$data['e'] = $this->pub->get_page($offset, $page_size, 'questions',false,$_COOKIE["order"]);
		$data['page'] = $this->pagination->create_links();
		$this->load->view('qustion', $data);
	}
	public function editStatus()
	{

		$k = $this->input->post('k');
		$id = $this->input->post('id');
		$data_s['qid']=$id;
		$data['is_ok'] = $this->input->post('radios'.$k);
		$e = $this->pub->insert('questions_select', $data_s);
		$e = $this->pub->update('questions', $data, $id);
		echo $e;
	}
	public function add()
	{
		$id = $this->uri->segment(3);
		if (!empty($id))
		{
			$data['e'] = $this->pub->get_one('questions', $id);

		}else {
			$data['e'] = $this->set_question();

		}

		$this->load->view('addQuestion',$data);
	}
	public function addquestion()
	{
		$id = $this->input->post('id');
		$data['for_name'] = $this->input->post('for_name');
		$data['content'] = $this->input->post('content');

		if (!empty($id))
		{
			$e = $this->pub->update('questions', $data, $id);
			if ($e)
			{
				exit('保存成功');
			}else {
				exit('保存失败');
			}
		}else {
			$e = $this->pub->insert('questions', $data);
			if ($e)
			{
				exit('保存成功');
			}else {
				exit('保存失败');
			}
		}
	}
	public function set_question()
	{
		$data = ['id'=>'', 'content'=>'','for_name'=>''];
		return $data;
	}
	public function deleteAll()
	{
		$e = $this->pub->deleteAll('questions');
		exit('成功');
	}
	public function response()
	{
		header("Content-type:text/html; charset=utf-8");
		$data['e'] = $this->pub->get('questions', false, 'create_time desc');
		$this->load->view($this->system.'response', $data);
	}
	public function notify()
	{
		$this->load->view($this->system.'test');
	}
	public function del()
	{
		$id = $this->uri->segment(3);
		if ($id)
		{
			$e = $this->pub->del('questions', $id);

			if ($e)
			{
				exit('删除成功');
			}else {
				exit('删除失賖 ');
			}
		}
	}
}
