<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Page extends MY_Controller {
	public function __construct(){
		parent::__construct();
		$this->load->model('Page_model', 'page');
	}
	public function page($id){
		$page = $this->page->get( array('slug'=>$id) );
		if(!empty($page)){
			$this->data['page'] = $page;
			$this->data['title'] = $page->title;
			$this->render->view('page/view', $this->data);
		}else{
			$this->data['heading'] = 'Page Not Found';
			$this->data['message'] = 'Page Not Found';
			$this->render->view('errors/html/error_404', $this->data);
		}
	}
}