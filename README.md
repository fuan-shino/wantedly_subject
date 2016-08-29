# 動作確認方法
*前提:LAMP環境*

・sql/create_table.sqlを実行しDB作成  
・http://(IPアドレス等)/wantedly_subject/ にアクセス  
・該当ページからテストデータ作成  
・以上で動作確認が可能です  

# 実装ファイル
主に以下のファイル内で実装しています。

・controllers/profile.php  
・views/user_profile.php  
・models/skill_data.php  
・models/user_data.php  
・models/user_skill.php  
・models/user_skill_pointup.php  
・sql/create_table.sql  

その他、設定や動作確認用で以下のファイルを変更/実装しています。

・controllers/subject_description.php  
・views/subject_description.php  
・config/database.php  
・config/routes.php  

# メモ
Firefox,Chromeにて動作確認しています。

## ライセンス
MIT
