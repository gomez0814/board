<?php
session_start();
require_once('db_board.php');
require_once('fanctions.php');
// echo var_dump($_);
// echo var_dump($_POST);
// echo var_dump($_SERVER);
// echo var_dump($_SESSION);
// echo var_dump($_COOKIE);

// echo var_dump($_POST['name']);
// echo var_dump($_POST['pass']);
// echo var_dump($_SESSION['name']);
// echo var_dump($_SESSION['pass']);
// echo var_dump($_SERVER['HTTP_HOST']);
// echo var_dump($_SERVER['HTTP_REFERER']);
// echo var_dump(strpos($_SERVER['HTTP_REFERER'], $_SERVER['HTTP_HOST']));
?>

<?php
// $_POSTが空（NULL）ではなければ、DB登録処理を実行し、完了画面に遷移
if (isset($_POST['account_reg_cpl'])) {
    $name = $_SESSION['name'];
    $pass = password_hash($_SESSION['pass'], PASSWORD_BCRYPT);

    $stmt = $dbh->prepare('INSERT INTO users (name, password) VALUES (:name, :password)');
    $stmt->bindValue(':name', $name, PDO::PARAM_STR);
    $stmt->bindValue(':password', $pass, PDO::PARAM_STR);
    $stmt->execute();
    header('Location: account_reg_cpl.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="sample text">
    <link rel="stylesheet" type="text/css" href="board.css">
    <title>アカウント新規登録確認</title>
</head>

<body>
    <div class="header">
        <h1><a href="toppage.php">掲示板</a></h1>
    </div>

    <div class="main">
        <h2>アカウント新規登録確認</h2>
        <p>下記の内容でアカウントを登録します。</p>
    </div>

    <div class="main">
        <form action="" method="POST" class="account_reg">
            <p>ユーザー名 : <?php echo htmlspecialchars($_SESSION['name'], ENT_QUOTES); ?></p>
            <p>パスワード : <?php echo htmlspecialchars($_SESSION['pass'], ENT_QUOTES); ?></p>
            <p><input type="submit" name="account_reg_cpl" value="新規登録する"></p>
        </form>
    </div>

    <div class="main">
        <!-- 前のページが存在している & 前のページのアドレスにサイトのホスト名が含まれていれば、前のページに戻るボタンを表示する -->
        <?php $host_name = $_SERVER['HTTP_HOST'];
        if (isset($_SERVER['HTTP_REFERER']) && strpos($_SERVER['HTTP_REFERER'], $host_name) !== false) : ?>
            <a href="<?php echo $_SERVER['HTTP_REFERER']; ?>">
                <button class="back_btn" type="button">前の画面に戻る</button>
            </a>
        <?php endif; ?>
    </div>




    <div class="main">
    </div>

    <div class="footer">
    </div>

</body>

</html>