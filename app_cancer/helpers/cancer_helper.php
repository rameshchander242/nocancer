<?php
function get_list(){
	return array('abc', 'def');
}

function getTitle($str){
	return ucwords(str_replace('_', ' ', $str));
}
function getSlug($str){
	return strtolower(url_title($str));
}



function create_unique_slug($string, $table, $field='slug', $key=NULL, $value=NULL){
  $t =& get_instance();
  $slug = url_title($string);
  $slug = strtolower($slug);
  $i = 0;
  $params = array ();
  $params[$field] = $slug;
  if($key)$params["$key !="] = $value;
  while ($t->db->where($params)->get($table)->num_rows()) {
    if (!preg_match ('/-{1}[0-9]+$/', $slug )) {
      $slug .= '-' . ++$i;
    } else {
      $slug = preg_replace ('/[0-9]+$/', ++$i, $slug );
    }
    $params [$field] = $slug;
  }
  return $slug;
}

function pagination($base_url, $total_rows, $limit=2){
	$t =& get_instance();
	$t->load->library('pagination');
  $config = [
      'base_url' => $base_url,
      'per_page' => $limit,
      'total_rows' => $total_rows,
  ];

  $config['full_tag_open'] = '<ul class="pagination">';
  $config['full_tag_close'] = '</ul>';
  $config['num_tag_open'] = '<li class="page-item">';
  $config['num_tag_close'] = '</li>';
  $config['cur_tag_open'] = '<li class="page-item active"><a class="page-link" href="#">';
  $config['cur_tag_close'] = '</a></li>';
  $config['next_tag_open'] = '<li class="page-item">';
  $config['next_tagl_close'] = '</a></li>';
  $config['prev_tag_open'] = '<li class="page-item">';
  $config['prev_tagl_close'] = '</li>';
  $config['first_tag_open'] = '<li class="page-item disabled">';
  $config['first_tagl_close'] = '</li>';
  $config['last_tag_open'] = '<li class="page-item">';
  $config['last_tagl_close'] = '</a></li>';
  $config['attributes'] = array('class' => 'page-link');
  $t->pagination->initialize($config); // model function
  return $t->pagination->create_links();
}

function wysihtml5_editor(){
	return '
		<link rel="stylesheet" href="'.base_url('assets/dist/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css').'">
    <script src="'.base_url('assets/dist/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js').'"></script>
    <script>
      $(function(){
        $(".textarea").wysihtml5()
      })
    </script>
  '; 
}

function formatDate($d='', $f=''){
  $d = !empty($d)?$d:date('Y-m-d H:i:s');
  $f = !empty($f)?$f:'Y-m-d H:i:s';
  return date($f, strtotime($d));
}