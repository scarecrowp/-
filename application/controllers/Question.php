<?php
/**
 * Created by PhpStorm.
 * User: wp
 * Date: 2016/7/18
 * Time: 15:01
 */
defined('BASEPATH') OR exit('No direct script access allowed');

class Question extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('pagination');
        $this->load->model('public_model', 'pub');




    }
    public  function index()
    {
        $page_size = 15;
        $config['base_url'] = base_url().'system/product/index';
        $config['total_rows'] = $this->pub->get_page_total('questions');
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
        $offset = intval($this->uri->segment(3));
        die($offset);
        $data['e'] = $this->pub->get_page($offset, $page_size, 'questions');
        $data['page'] = $this->pagination->create_links();

        $this->load->view('qustion', $data);
    }
    public  function  editStatus()
    {

    }
}