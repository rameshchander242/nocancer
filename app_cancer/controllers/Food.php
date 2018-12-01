<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Food extends MY_Controller {
	public function __construct(){
		parent::__construct();
		$this->load->model('food_model', 'food');
	}
	public function index(){
		$this->render->layout = 'home_layout';
		$this->data['featured_foods'] = $this->food->get_all(array('featured'=>1), 'title');
		$this->render->view('food/search', $this->data);
	}
	public function search(){
		if(isset($_GET['search']) && !empty($_GET['search'])){
			$search = $_GET['search'];
			$this->db->like('title', $search);
		}
		$this->data['search'] = isset($search)?$search:'';
		$this->data['foods'] = $this->food->get_all(NULL, 'title');
		$this->render->view('food/list', $this->data);
	}

	public function product($id){
		$food = $this->food->get(array('slug'=>$id));
		if(!empty($food)){
			$this->data['food'] = $food;
			$this->data['title'] = $food->title;
			$this->render->view('food/view', $this->data);
		}else{
			$this->data['heading'] = 'Food Not Found';
			$this->data['message'] = 'Food Not Found';
			$this->render->view('errors/html/error_404', $this->data);
		}
	}

	public function food_search(){
		$foodList = array();
		if(isset($_POST['search']) && !empty($_POST['search'])){
			$search = $_POST['search'];
			$this->db->like('title', $search);
			$results = $this->food->get_all(NULL, 'title', 'id, title');
			if( !empty($results) ){
				foreach($results as $result){
					$foodList[] = $result->title;
				}
			}
		}
		echo json_encode($foodList);
	}
}
