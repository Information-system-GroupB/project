<!doctype html>
<html lang="ja">
    <head>
        <meta charset="UTF-8">
        <title>login</title>
        <meta name="description" content="ログイン画面">
        <link rel="stylesheet" href="login.css">
    </head>

   <!--ログイン-->
   <h1>なんでも掲示板ログイン画面</h1>
   <h3>既にご登録済みの方はこちらに会員IDとパスワードを入力してログインして下さい。</h3>
    <form action="confirm.php" method="post">
    <p>会員IDを入力：<input type="text" name="user" required></p>
    <p>パスワードを入力：<input type="password" name="password" required></p>
    <p><input type="submit" value="ログイン"></p>
    </form>

   <!--新規会員登録-->
   <h3>まだご登録でない方はこちらから会員登録して下さい。（新規会員登録ボタンを押した後、上でログインして下さい）</h3>
   <form action="login.php" method="post">
   <p>会員ID：<input type="text" name="user"></p>
   <p>パスワード：<input type="password" name="password"></p>
   <p>名前：<input type="text" name="name"></p>
   <p>住所：<input type="text" name="address"></p>
   <p>電話番号：<input type="tel" name="tel"></p>
   <p><input type="submit" value="新規会員登録"></p>
   </from>

<!--新規会員登録の処理-->
  <?php
   if(isset($_POST['user'])) {
   $dsn='mysql:dbname=bgroup;charset=utf8';
   $user='root';
   $password='ratecat1002';
   $dbh = new PDO($dsn,$user,$password);
   $stmt = $dbh->prepare("INSERT INTO USER VALUES(:user,:password,:name,:address,:tel)");
   $stmt->bindParam(':user', $_POST['user']);
   $stmt->bindParam(':password', $_POST['password']);
   $stmt->bindParam(':name', $_POST['name']);
   $stmt->bindParam(':address', $_POST['address']);
   $stmt->bindParam(':tel', $_POST['tel']);
   $stmt->execute();
   }
  ?>
