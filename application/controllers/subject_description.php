<?php
if(!defined('BASEPATH')){
	exit('No direct script access allowed');
}

class subject_description extends CI_Controller{

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
	 * 説明とリンクのページ
	 */
	public function index(){

		$user_list = $this->user_data->get_all();

		$data = array(
			'my_user_id' => $this->user_id,
			'user_list' => $user_list,
		);
		$this->load->view('subject_description',$data);
	}

	/**
	 * テスト用データ作成
	 */
	public function test_data_creation(){

		// テストユーザ作成
		for($i=1;$i<=10;$i++){
			$this->user_data->insert_user('テストユーザー'.$i);
		}

		// ユーザID1-3だけ適当にスキルセット
		for($i=1;$i<=21;$i++){
			$this->skill_data->insert_skill('スキル'.$i);
			$this->user_skill->insert_user_skill((int)(($i-1)/7)+1,$i);
		}

		$this->user_skill_pointup->insert_pointup_log(2,1,1);$this->user_skill->increment_skill_point(1,1);
		$this->user_skill_pointup->insert_pointup_log(2,1,2);$this->user_skill->increment_skill_point(1,2);
		$this->user_skill_pointup->insert_pointup_log(2,1,5);$this->user_skill->increment_skill_point(1,5);
		$this->user_skill_pointup->insert_pointup_log(3,1,1);$this->user_skill->increment_skill_point(1,1);
		$this->user_skill_pointup->insert_pointup_log(3,1,7);$this->user_skill->increment_skill_point(1,7);
		$this->user_skill_pointup->insert_pointup_log(4,1,1);$this->user_skill->increment_skill_point(1,1);
		$this->user_skill_pointup->insert_pointup_log(5,1,1);$this->user_skill->increment_skill_point(1,1);
		$this->user_skill_pointup->insert_pointup_log(5,1,3);$this->user_skill->increment_skill_point(1,3);
		$this->user_skill_pointup->insert_pointup_log(5,1,7);$this->user_skill->increment_skill_point(1,7);

		$this->user_skill_pointup->insert_pointup_log(3,2,8);$this->user_skill->increment_skill_point(2,8);
		$this->user_skill_pointup->insert_pointup_log(3,2,10);$this->user_skill->increment_skill_point(2,10);
		$this->user_skill_pointup->insert_pointup_log(3,2,12);$this->user_skill->increment_skill_point(2,12);
		$this->user_skill_pointup->insert_pointup_log(3,2,14);$this->user_skill->increment_skill_point(2,14);
		$this->user_skill_pointup->insert_pointup_log(4,2,8);$this->user_skill->increment_skill_point(2,8);
		$this->user_skill_pointup->insert_pointup_log(4,2,9);$this->user_skill->increment_skill_point(2,9);
		$this->user_skill_pointup->insert_pointup_log(5,2,8);$this->user_skill->increment_skill_point(2,8);
		$this->user_skill_pointup->insert_pointup_log(5,2,13);$this->user_skill->increment_skill_point(2,13);
		$this->user_skill_pointup->insert_pointup_log(6,2,9);$this->user_skill->increment_skill_point(2,9);

		$this->user_skill_pointup->insert_pointup_log(2,3,15);$this->user_skill->increment_skill_point(3,15);
		$this->user_skill_pointup->insert_pointup_log(2,3,17);$this->user_skill->increment_skill_point(3,17);
		$this->user_skill_pointup->insert_pointup_log(2,3,20);$this->user_skill->increment_skill_point(3,20);
		$this->user_skill_pointup->insert_pointup_log(4,3,20);$this->user_skill->increment_skill_point(3,20);
		$this->user_skill_pointup->insert_pointup_log(5,3,20);$this->user_skill->increment_skill_point(3,20);
		$this->user_skill_pointup->insert_pointup_log(6,3,20);$this->user_skill->increment_skill_point(3,20);

		redirect('subject_description/index/');
	}
}
