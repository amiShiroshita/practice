<?php
function getDb()
{
  try {
    $pdoAdmin = new PDO('mysql:host=localhost;dbname=salto;charset=utf8', 'root', 'root');
    return $pdoAdmin;
  } catch (PDOException $e) {
    echo "エラー" . $e->getMessage();
  }
}
//id取得して編集する文章取得
$memoId=$_GET['updateId'];
$pdo = getDb();
$sql = $pdo->prepare("SELECT id,memo FROM memoPrac WHERE id=?");
$sql->execute([$memoId]);
foreach($sql as $row) {
  $dispMemo=$row['memo'];
}
?>
<!DOCTYPE html>
<html lang="ja">
  <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD</title>
    <style>
      button {display: block;}
    </style>
  </head>
  <body>
    <form method = "POST" action = "index.php">
      <?php
      echo '<input type="hidden" name="inputId" value="',$memoId,'">';
      echo '<input type="text" value="',$dispMemo,'" name="inputMemo">';
      ?>
      <button type="submit">メモする</button>
    </form>

  </body>
</html>