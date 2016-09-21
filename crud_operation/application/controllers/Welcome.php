<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('college_stud');
	}
	public function index()
	{
		$data['title']='CRUD';
		$this->load->view('welcome_message',$data);
	}
	public function save()
	{
		$validation=array(
			array('field'=>'id','label'=>'ID','rules'=>'required|is_unique[college_student.id]'),
		);
		$this->form_validation->set_rules($validation);
		if ($this->form_validation->run()===FALSE) {
			$info['success']=FALSE;
			$info['errors']=validation_errors();
		}else{
			$info['success']=TRUE;
			$data=array(
				'id'=>$this->input->post('id'),
				'name'=>$this->input->post('name'),
				'sex'=>$this->input->post('sex'),
				'phone'=>$this->input->post('phone'),
				'address'=>$this->input->post('address')
			);
			$this->college_stud->save_data($data);
			$info['message']="Successfully saved";
		}
		$this->output->set_content_type('application/json')->set_output(json_encode($info));
	}
	public function update_data()
	{
		$validation=array(
			array('field'=>'id','label'=>'ID','rules'=>'required'),
		);
		$this->form_validation->set_rules($validation);
		if ($this->form_validation->run()===FALSE) {
			$info['success']=FALSE;
			$info['errors']=validation_errors();
		}else{
			$info['success']=TRUE;
			$data=array(
				'id'=>$this->input->post('id'),
				'name'=>$this->input->post('name'),
				'sex'=>$this->input->post('sex'),
				'phone'=>$this->input->post('phone'),
				'address'=>$this->input->post('address')
			);
			$this->college_stud->update_data($data);
			$info['message']="Successfully changed";
		}
		$this->output->set_content_type('application/json')->set_output(json_encode($info));
	}
	public function sample_data()
	{
		$sample_file = $this->college_stud->sample_data();
		$data=array();
		foreach ($sample_file as $rows) {
			array_push($data,
				array(
					$rows['id'],
					$rows['name'],
					$rows['sex'],
					$rows['phone'],
					'<a href="javascript:void(0)" class="btn btn-info btn-xs" onclick="update('."'".$rows['id']."'".')">update</a>'.
					'&nbsp;<a href="javascript:void(0)" class="btn btn-danger btn-xs" onclick="delete_data('."'".$rows['id']."'".')">delete</a>'
				)
			);
		}
		$this->output->set_content_type('application/json')->set_output(json_encode(array('data'=>$data)));
	}
	public function sample_update()
	{
		$id=$this->input->post('id');
		$data=$this->college_stud->sample_update_data($id);
		$this->output->set_content_type('application/json')->set_output(json_encode($data));
	}
	public function delete_data()
	{
		$validation=array(
			array('field'=>'id','rules'=>'required')
		);
		$this->form_validation->set_rules($validation);
		if ($this->form_validation->run()===FALSE) {
			$info['success']=FALSE;
			$info['errors']=validation_errors();
		}else{
			$info['success']=TRUE;
			$data=array(
				'id'=>$this->input->post('id')
			);
			$this->college_stud->delete_data($data);
			$info['message']='Data successfully deleted';
		}
		$this->output->set_content_type('application/json')->set_output(json_encode($info));
	}
}
