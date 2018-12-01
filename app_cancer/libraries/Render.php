<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');
class Render{
    public $data = array();
    public $viewFolder = null;
    public $layoutsFodler = 'layouts';
    public $layout = 'default';
    public $header = '';
    public $footer = '';
    var $obj;

    function __construct(){
        $this->obj =& get_instance();
    }

    function setLayout($layout){
        $this->layout = $layout;
    }
    function setLayoutFolder($layoutFolder){
        $this->layoutsFodler = $layoutFolder;
    }

    function view($view, $viewdata = array(), $returnhtml = false){
        $controller = $this->obj->router->fetch_class();
        $method = $this->obj->router->fetch_method();
        $viewFolder = !($this->viewFolder) ? '' : $this->viewFolder.'/';

        $loadedData = array();
        $loadedData = $viewdata;
        $loadedData['view_file'] = $viewFolder.$view;

        $layoutPath = '/'.$this->layoutsFodler.'/'.$this->layout;
        $this->obj->load->view($layoutPath, $loadedData, $returnhtml);
    }
    function get_title(){
        $title = isset($this->data['title'])?$this->data['title']:'Be care from Cancer';
        $title .= ' | Cancer';
        return $title;
    }


}
?>