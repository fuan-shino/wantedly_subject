<?php
if(!defined('BASEPATH')){
	exit('No direct script access allowed');
}

class user_skill extends CI_Model{

	/**
	 * コンストラクタ
	 */
	public function __construct(){
		parent::__construct();
		$this->table_name = 'user_skill';
	}

	public function get_by_user_id($user_id = null,$skill_id = null){
		
		$result = array();
		if($user_id){

			$this->db->where('user_id',$user_id);
			if($skill_id){
				$this->db->where('skill_id',$skill_id);
			}
			$query = $this->db->get($this->table_name);

			if($query->num_rows() > 0){
				$result =  $query->result_array();
			}
		}

		return $result;
	}

	public function insert_user_skill($user_id = null,$skill_id = null){
		
		if(!$user_id || !$skill_id){
			return;
		}

		$this->db->set('user_id',$user_id);
		$this->db->set('skill_id',$skill_id);
		$this->db->set('skill_point',0);
		$this->db->insert($this->table_name);
	}

	public function increment_skill_point($user_id = null,$skill_id = null){
		
		if(!$user_id || !$skill_id){
			return;
		}

		$now_skill_data = $this->get_by_user_id($user_id,$skill_id);
		if(count($now_skill_data)){
			$next_point = (int)$now_skill_data[0]['skill_point'] + 1;

			$this->db->where('user_id',$user_id);
			$this->db->where('skill_id',$skill_id);
			$this->db->set('skill_point',$next_point);
			$this->db->update($this->table_name);
		}
	}
}
