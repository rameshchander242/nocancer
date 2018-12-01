<?php
class MY_Controller extends CI_Controller{
  function __construct(){
    parent::__construct();
  }
}

class Admin_Controller extends My_Controller{
  function __construct(){
    parent::__construct();
    if (!$this->ion_auth->logged_in() || !$this->ion_auth->is_admin()){
      redirect('admin/login', 'refresh');
    }else if (!$this->ion_auth->is_admin()){
      return show_error('You must be an administrator to view this page.');
    }
    $this->render->layoutsFodler = 'admin/layouts';
    $this->render->viewFolder = 'admin';
  }
}

class Public_Controller extends My_Controller{
  function __construct(){
    parent::__construct();
  }
}