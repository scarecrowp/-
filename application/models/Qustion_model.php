<?php

/**
 * Created by PhpStorm.
 * User: wp
 * Date: 2016/7/18
 * Time: 10:41
 */
class Qustion_model extends CI_Model {

    public function __construct()
    {
        parent::__construct();
    }
    public function maxID($table)
    {
  //      $res = $this->db->get('questions');
        //select max(id) from testnotnull;
        $res=  $this->db->query("select max(id) as mid from questions_select ");
        //var_dump($res->result()[0]->mid);
        //$res = $this->db->get_where('questions', array('owner =' => '$owner'))->result();

        return $res->result()[0]->mid;
//        $res = $this->db->insert_id();
//        var_dump($res);
//        return $res->result()[0]->id;
	}
    public function getLastContent($mid)
    {

        $res=  $this->db->query("select a.id,b.for_name,b.content from questions_select a,questions b WHERE  a.id>".$mid." and a.qid=b.id");

        return $res->result();
    }
    /**
    +------------------------------------------------------
     * 插入单条
    +------------------------------------------------------
     */
    public function insert($table, $data)
    {
        $e = $this->db->insert($table, $data);
        if ($e)
        {
            return true;
        }else {
            return false;
        }
    }

}