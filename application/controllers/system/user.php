<?php
class User extends CI_Controller {
    function userList($id,$name='a')
    {
        //var_dump($this->input);
        $this->load->view("admin/user");
    }
    public function Persons()
    {
        $this->load->database();
        $sql ="select * from peoper";
        $res =$this->db->query($sql);
        var_dump($res->result());
        $list =$res->result();
        //  $data["plist"]=$res->result();
        $this->load->view("home/list" ,array('list'=>$list));
    }
}
?>