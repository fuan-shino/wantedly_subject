<?php
if(!defined('BASEPATH')){
	exit('No direct script access allowed');
}
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>インターン課題</title>
</head>
<body>

<div id="container">
	<h1>インターン課題の動作確認用ページ</h1>
	課題の確認用ページです．<br />

	<div id="body">
		<?php
			if(count($user_list)){
				foreach($user_list as $user){
					echo '<p><a href="'.site_url('profile/user_index/'.$user['user_id']).'">'.$user['user_name'].'のプロフィール</a>';
					if($user['user_id'] == $my_user_id){
						echo '(自分)';
					}
					echo '</p>';
				}
			}else{
				echo '<p>DBにユーザーデータが存在しません．</p>';
				echo '<p>以下のリンクでいくつかのユーザーとスキルデータ等が作成可能です．</p>';
				echo '<p><a href="'.site_url('subject_description/test_data_creation/').'">テスト用データ作成</a></p>';
				echo '<p>作成されるテストユーザー名: テストユーザー1〜10</p>';
				echo '<p>作成されるテストスキル名: スキル1〜21</p>';
				echo '<p>テストユーザー1〜3にのみいくつかスキルが登録済みになります．</p>';
			}
		?>		
	</div>
</div>

</body>
</html>
