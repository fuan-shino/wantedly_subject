<?php
if(!defined('BASEPATH')){
	exit('No direct script access allowed');
}
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title><?php echo $user_name;?>のプロフィール</title>
</head>
<body>

<div id="container">
	<h1><?php echo $user_name;?>のプロフィール</h1>
	--- スキル以外は省略 ---<br />

	<h3>スキル・特徴</h3>

	<div id="body">
		<?php
			foreach($user_skill_list as $skill){
				echo '<p>';
				echo $skill['skill_point'];
				if($skill['show_pointup_link']){
					echo '<a href="'.site_url('profile/skill_pointup/'.$user_id.'/'.$skill['skill_id']).'">(+1)</a>';
				}
				echo '&emsp;'.$skill['skill_name'];
				$j = 0;
				foreach($skill['pointup_list'] as $member){
					if(++$j > 10) break;
					echo '&emsp;<a href="'.site_url('profile/user_index/'.$member['user_id']).'">'.$member['user_name'].'</a>';
				}
				echo '</p>';
			}
		?>

		<form action="<?php echo site_url('profile/add_skill_to_user/');?>" method="post">
			<input type="hidden" name="user_id" value="<?php echo $user_id;?>">
			スキル名:<input type="text" name="skill_name"/>&nbsp;を<?php echo $user_name;?>に&nbsp;<input type="submit" value="追加">
		</form>

		<br /><br />
		<a href="<?php echo site_url('subject_description/index/');?>">戻る</a>
	</div>
</div>

</body>
</html>
