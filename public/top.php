<?php
// ① ログインロジック作成
// ② emailからユーザ取得ロジック作成
// ③ パスワード紹介・セッションハイジャック対策
// ④ エラー分岐

require_once '../classes/UserLogic.php';

session_start();

//エラーメッセージ
$err = [];

//バリデーション

if(!$username = filter_input(INPUT_POST, 'email')) {
	$err['email'] = 'メールアドレスを記入してください。';
}
if(!$password = filter_input(INPUT_POST, 'password')) {
	$err['password'] = 'パスワードを記入してください。';
}

if (count($err) > 0) {
	// エラーがあった場合は戻す
	$_SESSION = $err;
	header('Location: login.php');
	return;
}

//ログイン成功時の処理
$result = UserLogic::login($email, $password);
// ログイン失敗時の処理
if (!$result) {
	header('Location: login.php');
	return;
}
echo 'ログイン成功です！'

?>
<!DOCTYPE html>
<html lang="ja">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>ユーザ登録完了画面</title>
</head>
<body>
	<?php if (count($err) > 0) : ?>
		<?php foreach($err as $e) : ?>
			<p><?php echo $e ?></p>
		<?php endforeach ?>
	<?php else : ?>
		<p>ユーザ登録が完了しました。</p>
	<?php endif ?>
	<a href="./login.php">戻る</a>

</body>
</html>