<?php
if(!defined('BASEPATH')){
	exit('No direct script access allowed');
}

class skill_data extends CI_Model{

	/**
	 * コンストラクタ
	 */
	public function __construct(){
		parent::__construct();
		$this->table_name = 'skill_data';
	}

	public function get_by_skill_id_array($id_array = array()){

		$result = array();
		if(count($id_array)){

			foreach($id_array as $id){
				$this->db->or_where('skill_id',$id);
			}
			$query = $this->db->get($this->table_name);
			if($query->num_rows() > 0){
				$result =  $query->result_array();
			}
		}

		return $result;
	}

	public function get_by_skill_name($skill_name = null){
		
		$result = array();
		if($skill_name){

			$this->db->where('skill_name',$skill_name);
			$query = $this->db->get($this->table_name);

			if($query->num_rows() > 0){
				$result =  $query->row_array();
			}
		}

		return $result;
	}

	public function insert_skill($skill_name = null){
		
		if(!$skill_name){
			return;
		}

		$this->db->set('skill_name',$skill_name);
		$this->db->insert($this->table_name);

		return $this->db->insert_id();
	}
}
