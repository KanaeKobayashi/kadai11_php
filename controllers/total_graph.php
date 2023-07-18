<?php
//1.  DB接続します
require_once('../models/model.php');
$pdo = db_connect();

  // ２．データ取得SQL作成
  $stmt = $pdo->prepare("SELECT * FROM gs_bm_table");
  $status = $stmt->execute();
  
  if ($status == false) {
    // execute（SQL実行時にエラーがある場合）
    $error = $stmt->errorInfo();
    exit("ErrorQuery:".$error[2]);
  }

if ($stmt->rowCount() > 0) {
    // 評価ごとの回答数をカウント
    $ratingsCount = array();
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $rating = intval($row['rating']);

        if (isset($ratingsCount[$rating])) {
            $ratingsCount[$rating]++;
        } else {
            $ratingsCount[$rating] = 1;
        }
    }

  // グラフ用のデータ準備
  $labels = range(1, 5);
  $data = array();
// $labelsの順序に合わせて$dataを設定
foreach ($labels as $label) {
  if (isset($ratingsCount[$label])) {
    $data[] = $ratingsCount[$label];
  } else {
    $data[] = 0;
  }
}


} else {
  echo 'まだアンケートがありません。';
}
$labels = range(1, 5);

require_once('../templates/totalling.php');