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

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  //時間取得
  date_default_timezone_set('Japan');
  $inputTime = date('Y-m-d H:i:s');

  //パス取得
  $urlArray = parse_url($_SERVER["HTTP_REFERER"]);
  $url=$urlArray['path'];

  if (strpos($url,'update.php') !== false) {
    //アップデート
    try {
      $pdo = getDb();
      $update = $pdo->prepare("UPDATE memoPrac SET memo=? WHERE id=?");
      $update->execute([htmlentities($_POST['inputMemo']),$_POST['inputId']]);
      echo "メモを更新しました";
    } catch (PDOException $e) {
      echo "更新できませんでした";
    }
  }else{
    //インサート
    try {
      $pdo = getDb();
      $insert = $pdo->prepare("INSERT INTO memoPrac(memo, createDate) value(?,?)");
      $insert->execute([htmlentities($_POST['inputMemo']), $inputTime]);
      echo "メモを追加しました";
    } catch (PDOException $e) {
      echo "追加できませんでした";
    }
  }
}

//キャスト
if(!empty($_GET['delete'])){
  //デリート
  $deleteId=(int)$_GET['delete'];
  try {
    $pdo = getDb();
    $delete = $pdo->prepare("UPDATE memoPrac SET deleteFlg=1 WHERE id=?");
    $delete->execute([$deleteId]);
    echo "メモを削除しました";
    header("Location:./index.php");
  } catch (PDOException $e) {
    echo "削除できませんでした";
    echo $e;
  }
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
    button {
      display: block;
    }
  </style>
</head>

<body>
  <form method="POST" action="">
    <input type="text" placeholder="ここにメモ" name="inputMemo">
    <button type="submit">メモする</button>
  </form>

  <div>
    <ul>
      <?php
      $pdo = getDb();
      $sql = $pdo->prepare("SELECT id,memo,createDate FROM memoPrac WHERE deleteFlg=0");
      $sql->execute();
      foreach ($sql as $row) {
        echo '<li>';
        echo '<p>', $row['createDate'], '</p>';
        echo '<p>', $row['memo'], '</p>';
        echo '<a href="index.php?delete=', $row['id'], '"><button>削除</button></a>';
        echo '<a href="update.php?updateId=', $row['id'], '"><button>編集</button></a>';
        echo '</li>';
      }
      ?>
    </ul>
  </div>
</body>

</html>