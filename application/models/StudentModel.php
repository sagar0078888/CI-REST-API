<?php

class StudentModel extends CI_Model{

public function __construct()
{
    parent::__construct();

    $this->load->database();
}


public function get_students()
{


  $this->db->select('*');

  $this->db->from('tbl_students');

  $query=$this->db->get();

  return $query->result();


}


public function insert_student($data){

 return $this->db->insert("tbl_students",$data);



}


public function update_student($id,$data)
{


$this->db->where("id",$id);

return $this->db->update("tbl_students",$data);



}

public function editemployee($id){

$this->db->where("id",$id);
$query=$this->db->get("tbl_students");

return $query->row();


}






public function delete_student($student_id){

$this->db->where("id",$student_id);
return $this->db->delete("tbl_students");
}



}













?>