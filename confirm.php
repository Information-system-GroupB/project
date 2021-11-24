<?php
if(isset($_POST['user'])) {
$dsn='mysql:dbname=bgroup;charset=utf8';
$user='root';
$password='ratecat1002';
$dbh = new PDO($dsn,$user,$password);

$stmt = $dbh->prepare("SELECT * FROM user WHERE id=:user");
$stmt->bindParam(':user', $_POST['user']);
$stmt->execute();
if($rows = $stmt->fetch()) {
if($rows["password"] ==  $_POST['password']) {
header("location: top.php");
}else {
print "<p>ログイン失敗</p>";
}
}else {
print "<p>ログイン失敗</p>";
}
}
?>
