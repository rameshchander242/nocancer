<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pages extends Admin_Controller {
	public function __construct(){
		parent::__construct();
		$this->load->model('Page_model', 'page');
		$this->load->library('form_validation');
	}
	public function index(){
		$this->data['title'] = 'Pages';
		$this->data['pages'] = $this->page->get_all(NULL, 'title');
		$this->data['message'] = (validation_errors() ? validation_errors() : $this->session->flashdata('message'));
		$this->render->view('pages/index', $this->data);
	}
	public function create(){
		$this->form_validation->set_rules('title', 'Title', 'trim|required');
		if ($this->form_validation->run() === TRUE){
			if( isset($_FILES["featured_image"]['name']) and !empty($_FILES["featured_image"]['name']) ){
				$config = array(
					'upload_path' => FCPATH.'assets/images/',
					'allowed_types' => "gif|jpg|png|jpeg|pdf",
					'overwrite' => TRUE,
				);
				$new_name = time().'_'.$_FILES["featured_image"]['name'];
				$config['file_name'] = $new_name;
				$this->load->library('upload', $config);
				if($this->upload->do_upload('featured_image')){
					$page_Data['featured_image'] = $this->upload->data()['file_name'];
				}else{
					$error = $this->upload->display_errors();
				}
			}
			$page_Data['title'] = $this->input->post('title');
			$page_Data['slug'] = create_unique_slug($page_Data['title'], 'pages');
			$page_Data['description'] = $this->input->post('description');
			$page_Data['status'] = 1;
			$page_Data['created_by'] = $this->session->userdata('user_id');
		}
		if ($this->form_validation->run() === TRUE && $this->page->insert($page_Data)){
			$this->session->set_flashdata('success', 'Page Create Successfully.');
			redirect("admin/pages", 'refresh');
		}else{
			$this->data['title'] = 'Create Page';
			$this->data['danger'] = (validation_errors() ? validation_errors() : '');
			$this->render->view('pages/create', $this->data);
		}
	}
	public function edit($id){
		$page = $this->page->get( array('id'=>$id) );
		if (isset($_POST) && !empty($_POST)){
			$this->form_validation->set_rules('title', 'Title', 'trim|required');
			if ($this->form_validation->run() === TRUE){
				if( isset($_FILES["featured_image"]['name']) and !empty($_FILES["featured_image"]['name']) ){					
					$config = array(
						'upload_path' => FCPATH.'assets/images/',
						'allowed_types' => "gif|jpg|png|jpeg|pdf",
						'overwrite' => TRUE,
					);
					$new_name = time().$_FILES["featured_image"]['name'];
					$config['file_name'] = $new_name;
					$this->load->library('upload', $config);
					if($this->upload->do_upload('featured_image')){
						$page_Data['featured_image'] = $this->upload->data()['file_name'];
					}else{
						$error = $this->upload->display_errors();
					}
				}
				$page_Data['title'] = $this->input->post('title');
				if(!empty($this->input->post('slug'))){
					$page_Data['slug'] = create_unique_slug($this->input->post('slug'), 'pages', 'slug', 'id', $page->id);
				}else{
					$page_Data['slug'] = create_unique_slug($page_Data['title'], 'pages', 'slug', 'id', $page->id);
				}
				$page_Data['description'] = $this->input->post('description');
				$page_Data['status'] = $this->input->post('status');
				$page_Data['modified_at'] = date('Y-m-d H:i:s');
			}
			if( $this->form_validation->run() === TRUE && $this->page->update($page_Data, array('id'=>$page->id))){
				$this->session->set_flashdata('success', 'Update Page Successfully');
				redirect("admin/pages", 'refresh');
			}else{
				$this->session->set_flashdata('danger', 'There is some problem');
				redirect("admin/pages/edit/".$page->id, 'refresh');
			}
		}
		$this->data['title'] = 'Edit Page';
		$this->data['danger'] = (validation_errors() ? validation_errors() : $this->session->flashdata('message'));
		$this->data['page'] = $page;
		$this->render->view('pages/edit', $this->data);
	}
	public function delete($id){
		$where = array('id'=>$id);
		$page = $this->page->get($where);
		if( $this->page->delete( $where ) ){
			unlink(FCPATH.'assets/images/'.$page->featured_image);
			$this->session->set_flashdata('success', 'Delete Page Successfully');
			redirect("admin/pages", 'refresh');
		}else{
			$this->session->set_flashdata('danger', 'Page not Deleted');
			redirect("admin/pages", 'refresh');
		}
	}
}
