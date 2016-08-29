<?php
if(!defined('BASEPATH')){
	exit('No direct script access allowed');
}

class profile extends CI_Controller{

	private $user_id = 1; // 自分はID=1ということにしておく

	/**
	 * コンストラクタ
	 */
	function __construct(){
		parent::__construct();
		$this->load->helper('url');
		$this->load->database();
		$this->load->model('user_data');
		$this->load->model('skill_data');
		$this->load->model('user_skill');
		$this->load->model('user_skill_pointup');
	}

	/**
	 * ユーザのプロフィール画面
	 */
	public function user_index($user_id = null){

		if(!$user_id){
			show_404();
		}

		// ユーザ名取得
		$user_data = $this->user_data->get_by_user_id($user_id);

		// ユーザのスキル取得
		$user_skill = $this->user_skill->get_by_user_id($user_id);

		// スキル所持の場合のみ
		$user_skill_list = array();
		if(count($user_skill)){

			// スキル名取得
			$skill_data = $this->skill_data->get_by_skill_id_array(array_column($user_skill,'skill_id'));
			$skill_name_list = array();
			foreach($skill_data as $val){
				$skill_name_list[$val['skill_id']] = $val['skill_name'];
			}

			// 所持スキルを+1したユーザ取得
			$user_skill_pointup = $this->user_skill_pointup->get(null,$user_id);
			$pointup_member_list = array();
			$pointup_member_id = array_unique(array_column($user_skill_pointup,'user_id'));
			foreach($pointup_member_id as $val){
				$member_data = $this->user_data->get_by_user_id($val);
				$pointup_member_list[$val] = array(
					'user_id' => $val,
					'user_name' => $member_data['user_name'],
				);
			}
			$pointup_list = array();
			foreach($user_skill_pointup as $val){
				$pointup_list[$val['to_skill_id']][$val['user_id']] = $pointup_member_list[$val['user_id']];
			}

			// +1のリンクを表示するか
			$show_pointup_link_flag = array();
			foreach($pointup_list as $key => $val){
				
				if(isset($val[$this->user_id]) || $this->user_id == $user_data['user_id']){
					$show_pointup_link_flag[$key] = false;
				}else{
					$show_pointup_link_flag[$key] = true;
				}
			}

			// データ整形
			foreach($user_skill as $skill){
				$user_skill_list[] = array(
					'skill_id' => $skill['skill_id'],
					'skill_name' => $skill_name_list[$skill['skill_id']],
					'skill_point' => $skill['skill_point'],
					'pointup_list' => isset($pointup_list[$skill['skill_id']]) ? $pointup_list[$skill['skill_id']] : array(),
					'show_pointup_link' => isset($show_pointup_link_flag[$skill['skill_id']]) ? $show_pointup_link_flag[$skill['skill_id']] : !($this->user_id == $user_data['user_id']),
				);
			}

			// +1数降順にソート
			$points = array_column($user_skill_list,'skill_point');
			array_multisort($points,SORT_DESC,SORT_NUMERIC,$user_skill_list);
		}

		$data = array(
			'user_id' => $user_data['user_id'],
			'user_name' => $user_data['user_name'],
			'user_skill_list' => $user_skill_list,
		);
		$this->load->view('user_profile',$data);
	}

	/**
	 * ユーザにスキルを追加
	 */
	public function add_skill_to_user(){
		
		$user_id = $this->input->post('user_id');
		$skill_name = $this->input->post('skill_name');

		if($user_id && $skill_name){

			$skill_id = '';
			$tmp = $this->skill_data->get_by_skill_name($skill_name);
			if(count($tmp)){
				$skill_id = $tmp['skill_id'];
			}else{
				$skill_id = $this->skill_data->insert_skill($skill_name);
			}
			$this->user_skill->insert_user_skill($user_id,$skill_id);
		
		}else{
			show_404();
		}

		redirect('profile/user_index/'.$user_id);
	}

	/**
	 * ユーザのスキルを+1
	 */
	public function skill_pointup($to_user_id = null,$to_skill_id = null){

		if($to_user_id && $to_skill_id){

			$this->user_skill_pointup->insert_pointup_log($this->user_id,$to_user_id,$to_skill_id);
			$this->user_skill->increment_skill_point($to_user_id,$to_skill_id);

		}else{
			show_404();
		}

		redirect('profile/user_index/'.$to_user_id);
	}
}
