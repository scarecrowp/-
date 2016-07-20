<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


/**
 * Created by PhpStorm.
 * User: wp
 * Date: 2016/7/15
 * Time: 17:21
 */

class Index extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();


        $this->load->view('index');
    }
}