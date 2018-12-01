<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Posts extends Admin_Controller {
	public function __construct(){
		parent::__construct();
		$this->load->model('Post_model', 'post');
		$this->load->library('form_validation');
	}
	public function index(){
		$this->data['title'] = 'Posts';
		$this->data['posts'] = $this->post->get_all(NULL, 'title');
		$this->data['message'] = (validation_errors() ? validation_errors() : $this->session->flashdata('message'));
		$this->render->view('posts/index', $this->data);
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
					$post_Data['featured_image'] = $this->upload->data()['file_name'];
				}else{
					$error = $this->upload->display_errors();
				}
			}
			$post_Data['title'] = $this->input->post('title');
			$post_Data['slug'] = create_unique_slug($post_Data['title'], 'posts');
			$post_Data['description'] = $this->input->post('description');
			$post_Data['status'] = 1;
			$post_Data['created_by'] = $this->session->userdata('user_id');
		}
		if ($this->form_validation->run() === TRUE && $this->post->insert($post_Data)){
			$this->session->set_flashdata('success', 'Post Create Successfully.');
			redirect("admin/posts", 'refresh');
		}else{
			$this->data['title'] = 'Create Post';
			$this->data['danger'] = (validation_errors() ? validation_errors() : '');
			$this->render->view('posts/create', $this->data);
		}
	}
	public function edit($id){
		$post = $this->post->get( array('id'=>$id) );
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
						$post_Data['featured_image'] = $this->upload->data()['file_name'];
					}else{
						$error = $this->upload->display_errors();
					}
				}
				$post_Data['title'] = $this->input->post('title');
				if(!empty($this->input->post('slug'))){
					$post_Data['slug'] = create_unique_slug($this->input->post('slug'), 'posts', 'slug', 'id', $post->id);
				}else{
					$post_Data['slug'] = create_unique_slug($post_Data['title'], 'posts', 'slug', 'id', $post->id);
				}
				$post_Data['description'] = $this->input->post('description');
				$post_Data['status'] = $this->input->post('status');
				$post_Data['modified_at'] = date('Y-m-d H:i:s');
			}
			if( $this->form_validation->run() === TRUE && $this->post->update($post_Data, array('id'=>$post->id))){
				$this->session->set_flashdata('success', 'Update Post Successfully');
				redirect("admin/posts", 'refresh');
			}else{
				$this->session->set_flashdata('danger', 'There is some problem');
				redirect("admin/posts/edit/".$post->id, 'refresh');
			}
		}
		$this->data['title'] = 'Edit Post';
		$this->data['danger'] = (validation_errors() ? validation_errors() : $this->session->flashdata('message'));
		$this->data['post'] = $post;
		$this->render->view('posts/edit', $this->data);
	}
	public function delete($id){
		$where = array('id'=>$id);
		$post = $this->post->get($where);
		if( $this->post->delete( $where ) ){
			unlink(FCPATH.'assets/images/'.$post->featured_image);
			$this->session->set_flashdata('success', 'Delete Post Successfully');
			redirect("admin/posts", 'refresh');
		}else{
			$this->session->set_flashdata('danger', 'Post not Deleted');
			redirect("admin/posts", 'refresh');
		}
	}
}
