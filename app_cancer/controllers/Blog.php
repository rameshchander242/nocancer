<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Blog extends MY_Controller {
	public function __construct(){
		parent::__construct();
		$this->load->model('Post_model', 'post');
	}

	public function index(){
		$posts = $this->post->get_all( array('status'=>1) );
		$this->data['posts'] = $posts;
		$this->data['title'] = 'Blog';
		$this->render->view('post/index', $this->data);
	}

	public function view($id){
		$post = $this->post->get( array('slug'=>$id) );
		if(!empty($post)){
			$this->data['post'] = $post;
			$this->data['title'] = $post->title;
			$this->render->view('post/view', $this->data);
		}else{
			$this->data['heading'] = 'Post Not Found';
			$this->data['message'] = 'Post Not Found';
			$this->render->view('errors/html/error_404', $this->data);
		}
	}
}