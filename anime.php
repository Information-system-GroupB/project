<html>
<head><title>アニメ掲示板</title></head>
<link rel="stylesheet" href="board.css">

<body>

<h1>アニメ・漫画掲示板</h1>

<form method="POST" action="<?php print($_SERVER['PHP_SELF']) ?>">
名前：<input type="text" name="personal_name"><br><br>
<textarea name="contents" rows="8" cols="40">
</textarea><br><br>
<input type="submit" name="btn1" value="投稿する">
</form>

<?php

if($_SERVER["REQUEST_METHOD"] == "POST"){
    writeData();
}

readData();

function readData(){
    $anime_file = 'anime.txt';

    $fp = fopen($anime_file, 'rb');

    if ($fp){
        if (flock($fp, LOCK_SH)){
            while (!feof($fp)) {
                $buffer = fgets($fp);
                print($buffer);
            }

            flock($fp, LOCK_UN);
        }else{
            print('ファイルロックに失敗しました');
        }
    }

    fclose($fp);
}

function writeData(){
    $personal_name = $_POST['personal_name'];
    $contents = $_POST['contents'];
    $contents = nl2br($contents);
    $timestamp = time();
    $date = date("Y/m/d H:i:s", $timestamp);

    $data = "<hr>\r\n";
    $data = $data."<p>投稿者:".$personal_name."</p>\r\n";
    $data = $data."<p>投稿日時　:".$date."</p>\r\n";
    $data = $data."<p>内容:</p>\r\n";
    $data = $data."<p>".$contents."</p>\r\n";

    $anime_file = 'anime.txt';

    $fp = fopen($anime_file, 'ab');

    if ($fp){
        if (flock($fp, LOCK_EX)){
            if (fwrite($fp,  $data) === FALSE){
                print('ファイル書き込みに失敗しました');
            }

            flock($fp, LOCK_UN);
        }else{
            print('ファイルロックに失敗しました');
        }
    }

    fclose($fp);
}

?>

<p><a href="top.php">掲示板TOPに戻る</a></p>

</body>
</html>
