<?php
if(!defined('BASEPATH')){
	exit('No direct script access allowed');
}

class user_data extends CI_Model{

	/**
	 * コンストラクタ
	 */
	public function __construct(){
		parent::__construct();
		$this->table_name = 'user_list';
	}

	public function get_all(){

		$result = array();
		$query = $this->db->get($this->table_name);

		if($query->num_rows() > 0){
			$result =  $query->result_array();
		}

		return $result;
	}

	public function get_by_user_id($user_id = null){
		
		$result = array();
		if($user_id){

			$this->db->where('user_id',$user_id);
			$query = $this->db->get($this->table_name);

			if($query->num_rows() > 0){
				$result =  $query->row_array();
			}
		}

		return $result;
	}

	public function insert_user($user_name = null){
		
		if(!$user_name){
			return;
		}

		$this->db->set('user_name',$user_name);
		$this->db->insert($this->table_name);

		return $this->db->insert_id();
	}

	public function update_user_name($user_id = null,$user_name = null){
		
		if(!$user_id || !$user_name){
			return;
		}

		$this->db->where('user_id',$user_id);
		$this->db->set('user_name',$user_name);
		$this->db->update($this->table_name);
	}
}
