<?php
class MY_Model extends CI_Model{
  protected $table;
  public $where_arr = NULL;
  public $order_by_arr = NULL;
  public $cols_sel = NULL;
  public $cols_upd = NULL;

  public function __construct(){
    parent::__construct();
  }

  public function get_all($where_arr = NULL, $order_by_var_arr = NULL, $select = NULL, $limit=NULL, $offset=0){
    if(isset($where_arr)){
      $this->db->where($where_arr);
    }
    if(isset($limit)){
      $this->db->limit($limit, $offset);
    }
    if(isset($order_by_var_arr)){
      if(!is_array($order_by_var_arr)){
        $order_by[0] = $order_by_var_arr;
        $order_by[1] = 'asc';
      }else{
        $order_by[0] = $order_by_var_arr[0];
        $order_by[1] = $order_by_var_arr[1];
      }
      $this->db->order_by($order_by[0],$order_by[1]);
    }
    if(isset($select)){
      $this->db->select($select);
    }
    $query = $this->db->get($this->table);
    //echo $this->db->last_query();
    if($query->num_rows()>0){
      foreach($query->result() as $row){
        $data[] = $row;
      }
      return $data;
    }else{
      return FALSE;
    }
  }

  public function get_total($where_arr = NULL){
    if(isset($where_arr)){
      $this->db->where($where_arr);
    }
    return $this->db->count_all($this->table);
  }

  public function get($where_arr = NULL){
    if(isset($where_arr)){
      $this->db->where($where_arr);
      $this->db->limit(1);
      $query = $this->db->get($this->table);
      if($query->num_rows()>0){
        return $query->row();
      }else{
        return FALSE;
      }
    }else{
      return FALSE;
    }
  }

  public function insert($columns_arr){
    if(is_array($columns_arr)){
      if($this->db->insert($this->table,$columns_arr)){
        return $this->db->insert_id();
      }else{
        return FALSE;
      }
    }
  }

  public function update($columns_arr, $where_arr = NULL){
    if(isset($where_arr)){
      $this->db->where($where_arr);
      $this->db->update($this->table,$columns_arr);
      if($this->db->affected_rows()>0){
        return $this->db->affected_rows();
      }
    }else{
      return FALSE;
    }
  }

  public function delete($where_arr = NULL){
    if(isset($where_arr)){
      $this->db->where($where_arr);
      $this->db->delete($this->table);
      return $this->db->affected_rows();
    }else{
      return FALSE;
    }
  }
}