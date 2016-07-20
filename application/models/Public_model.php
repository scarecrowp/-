<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Public_model extends CI_Model
{
	
	public function __construct()
	{
		parent::__construct();
	}
	
	/**
	 +------------------------------------------------------
	 * 验证用户
	 +------------------------------------------------------
	 */
	public function check_admin($u, $p)
	{
		if ($u && $p)
		{

			$this->db->where(array('username'=>$u, 'userpsw'=>$p));

			$e = $this->db->get('demo_user');

			if ($e->num_rows() > 0)
			{
				return true;
			}else {
				return false;
			}
		}
	}
	
	/**
	 +------------------------------------------------------
	 * 获取全表
	 +------------------------------------------------------
	 */
	public function get($table, $where = false, $order = false)
	{
		if ($where)
		{
			$this->db->where($where);
		}
		if ($order)
		{
			$this->db->order_by($order);
		}
		$e = $this->db->get($table);
		if ($e->num_rows() >0)
		{
			return $e->result_array();
		}
	}
	
	/**
	 +------------------------------------------------------
	 * 获取单条
	 +------------------------------------------------------
	 */
	public function get_one($table, $id)
	{
		if ($id)
		{
			$this->db->where('id', $id);
			$this->db->limit(1);
			$e = $this->db->get($table);
			if ($e->num_rows() > 0)
			{
				return $e->row_array();
			}
		}
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
	
	/**
	 +------------------------------------------------------
	 * 更新单条
	 +------------------------------------------------------
	 */
	public function update($table, $data, $id)
	{
		if ($id)
		{
			$e = $this->db->update($table, $data, array('id'=>$id));
			if ($e)
			{
				return true;
			}else {
				return false;
			}
		}
	}
	
	/**
	 +------------------------------------------------------
	 * 删除单条
	 +------------------------------------------------------
	 */
	public function del($table, $id)
	{
		if ($id)
		{
			$this->db->limit(1);
			$e = $this->db->delete($table, array('id'=>$id));
			if ($e)
			{
				return true;
			}else {
				return false;
			}
		}
	}
	
	/**
	 +------------------------------------------------------
	 * 分页总条
	 +------------------------------------------------------
	 */
	public function get_page_total($table, $where = false)
	{
		if ($where)
		{
			$this->db->where($where);
		}
		$e = $this->db->count_all_results($table);
		if ($e)
		{
			return $e;
		}
	}
	
	/**
	 +------------------------------------------------------
	 * 分页数据
	 +------------------------------------------------------
	 */
	public function get_page($offset, $page_size, $table, $where = false, $order = false)
	{
		if ($where)
		{
			$this->db->where($where);
		}
		if ($order)
		{
			$this->db->order_by($order);
		}
		$this->db->limit($page_size, $offset);
		$e = $this->db->get($table);
		if ($e->num_rows() > 0)
		{
			return $e->result_array();
		}
	}
	public function deleteAll($table)
	{
		$this->db->empty_table($table);
	}
}