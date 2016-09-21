<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class college_stud extends CI_Model {
	public function __construct()
	{
		parent::__construct();
	}
	public function save_data($data)
	{
		$this->db->insert('college_student', $data);
		return TRUE;
	}
	public function update_data($data)
	{
		$this->db->where(array('id'=>$data['id']));
		$this->db->update('college_student', $data);
		return TRUE;
	}
	public function sample_data()
	{
		$this->db->select('*');
		$this->db->from('college_student');
		$query=$this->db->get();
		return $query->result_array();
	}
	public function sample_update_data($id)
	{
		$this->db->select('*');
		$this->db->from('college_student');
		$this->db->where('id',$id);
		$query=$this->db->get();
		return $query->row_array();
	}
	public function delete_data($data)
	{
		$this->db->where(array('id'=>$data['id']));
		$this->db->delete('college_student');
		return TRUE;
	}

}

/* End of file college_stud.php */
/* Location: ./application/models/college_stud.php */
