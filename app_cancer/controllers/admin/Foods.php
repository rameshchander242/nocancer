<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Foods extends Admin_Controller {
	public function __construct(){
		parent::__construct();
		$this->load->model('Food_model', 'food');
		$this->load->library('form_validation');
	}
	public function index(){
		if(isset($_GET['search']) && !empty($_GET['search'])){
			$this->db->like('title', $_GET['search']);
		}
		if(isset($_GET['rating']) && !empty($_GET['rating'])){
			$this->db->like('rating', '"'.$_GET['rating'].'"');
		}
		$limit_per_page = 20;
		$segment = 5;
		$start_index = ($this->uri->segment($segment)) ? $this->uri->segment($segment) : 0;
        
		$base_url = base_url('admin/foods/index/page/');
		$total_rows = $this->food->get_total();
		$this->data["paginate"] = pagination($base_url, $total_rows, $limit_per_page);

		$this->data['title'] = 'Foods';
		if(isset($_GET['search']) && !empty($_GET['search'])){
			$this->db->like('title', $_GET['search']);
		}
		if(isset($_GET['rating']) && !empty($_GET['rating'])){
			$this->db->like('rating', '"'.$_GET['rating'].'"');
		}
		$this->data['foods'] = $this->food->get_all(NULL, 'title', NULL, $limit_per_page, $start_index);
		$this->data['message'] = (validation_errors() ? validation_errors() : $this->session->flashdata('message'));
		$this->render->view('food/index', $this->data);
	}
	public function create(){
		$this->form_validation->set_rules('title', 'Title', 'trim|required');
		if ($this->form_validation->run() === TRUE){
			if( isset($_FILES["food_image"]['name']) and !empty($_FILES["food_image"]['name']) ){
				$config = array(
					'upload_path' => FCPATH.'assets/images/',
					'allowed_types' => "gif|jpg|png|jpeg|pdf",
					'overwrite' => TRUE,
				);
				$new_name = time().'_'.$_FILES["food_image"]['name'];
				$config['file_name'] = $new_name;
				$this->load->library('upload', $config);
				if($this->upload->do_upload('food_image')){
					$food_Data['food_image'] = $this->upload->data()['file_name'];
				}
			}
			$food_Data['title'] = $this->input->post('title');
			$food_Data['slug'] = create_unique_slug($food_Data['title'], 'foods');
			$food_Data['description'] = $this->input->post('description');
			$food_Data['rating'] = json_encode($this->input->post('rating'));
			$food_Data['information_sources'] = json_encode( $this->input->post('information_sources') );
			$food_Data['recomend_products'] = json_encode( $this->input->post('recomend_products') );
			$food_Data['additional_information'] = $this->input->post('additional_information');
			$food_Data['created_by'] = $this->session->userdata('user_id');
			$food_Data['modified_at'] = date('Y-m-d H:i:s');
		}
		if ($this->form_validation->run() === TRUE && $this->food->insert($food_Data)){
			$this->session->set_flashdata('success', 'Food Create Successfully.');
			redirect("admin/foods", 'refresh');
		}else{
			$this->data['title'] = 'Create Food';
			$this->data['danger'] = (validation_errors() ? validation_errors() : '');
			$this->render->view('food/create', $this->data);
		}
	}
	public function edit($id){
		$food = $this->food->get( array('id'=>$id) );
		if (isset($_POST) && !empty($_POST)){
			$this->form_validation->set_rules('title', 'Title', 'trim|required');
			if ($this->form_validation->run() === TRUE){
				if( isset($_FILES["food_image"]['name']) and !empty($_FILES["food_image"]['name']) ){					
					$config = array(
						'upload_path' => FCPATH.'assets/images/',
						'allowed_types' => "gif|jpg|png|jpeg|pdf",
						'overwrite' => TRUE,
					);
					$new_name = time().$_FILES["food_image"]['name'];
					$config['file_name'] = $new_name;
					$this->load->library('upload', $config);
					if($this->upload->do_upload('food_image')){
						$food_Data['food_image'] = $this->upload->data()['file_name'];
					}else{
						$error = $this->upload->display_errors();
					}
				}
				$food_Data['title'] = $this->input->post('title');
				if(!empty($this->input->post('slug'))){
					$food_Data['slug'] = create_unique_slug($this->input->post('slug'), 'foods', 'id', $food->id);
				}else{
					$food_Data['slug'] = create_unique_slug($food_Data['title'], 'foods', 'id', $food->id);
				}
				$food_Data['description'] = $this->input->post('description');
				$food_Data['rating'] = json_encode($this->input->post('rating'));
				$food_Data['information_sources'] = json_encode( $this->input->post('information_sources') );
				$food_Data['recomend_products'] = json_encode( $this->input->post('recomend_products') );
				$food_Data['additional_information'] = $this->input->post('additional_information');
				$food_Data['modified_at'] = date('Y-m-d H:i:s');
			}
			if( $this->form_validation->run() === TRUE && $this->food->update($food_Data, array('id'=>$food->id))){
				$this->session->set_flashdata('success', 'Update Food Successfully');
				redirect("admin/foods", 'refresh');
			}else{
				$this->session->set_flashdata('danger', 'There is some problem');
				redirect("admin/foods/edit/".$food->id, 'refresh');
			}
		}
		$this->data['title'] = 'Edit Food';
		$this->data['danger'] = (validation_errors() ? validation_errors() : $this->session->flashdata('message'));
		$this->data['food'] = $food;
		$this->render->view('food/edit', $this->data);
	}
	public function delete($id){
		$where = array('id'=>$id);
		$food = $this->food->get($where);
		if( $this->food->delete( $where ) ){
			unlink(FCPATH.'assets/images/'.$food->food_image);
			$this->session->set_flashdata('success', 'Delete Food Successfully');
			redirect("admin/foods", 'refresh');
		}else{
			$this->session->set_flashdata('danger', 'Food not Deleted');
			redirect("admin/foods", 'refresh');
		}
	}

	public function featured($id){
		$where = array('id'=>$id);
		$food = $this->food->get($where);
		$this->food->update(array('featured'=>!$food->featured), array('id'=>$food->id));
		$this->session->set_flashdata('success', 'Update Food Successfully');
		redirect("admin/foods", 'refresh');
	}
}
