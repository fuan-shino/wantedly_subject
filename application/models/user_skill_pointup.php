<?php
if(!defined('BASEPATH')){
	exit('No direct script access allowed');
}

class user_skill_pointup extends CI_Model{

	/**
	 * コンストラクタ
	 */
	public function __construct(){
		parent::__construct();
		$this->table_name = 'user_skill_pointup';
	}

	public function get($user_id = null,$to_user_id = null,$to_skill_id = null){
		
		$result = array();
		if($user_id || $to_user_id || $to_skill_id){

			if($user_id){
				$this->db->where('user_id',$user_id);
			}
			if($to_user_id){
				$this->db->where('to_user_id',$to_user_id);
			}
			if($to_skill_id){
				$this->db->where('to_skill_id',$to_skill_id);
			}
			$query = $this->db->get($this->table_name);

			if($query->num_rows() > 0){
				$result =  $query->result_array();
			}
		}

		return $result;
	}

	public function insert_pointup_log($user_id = null,$to_user_id = null,$to_skill_id = null){
		
		if(!$user_id || !$to_user_id || !$to_skill_id){
			return;
		}

		$this->db->set('user_id',$user_id);
		$this->db->set('to_user_id',$to_user_id);
		$this->db->set('to_skill_id',$to_skill_id);
		$this->db->insert($this->table_name);
	}
}
