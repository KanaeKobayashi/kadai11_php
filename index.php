<?php

// 関数の呼び出し
require_once('models/model.php');
// データベース操作
$pdo = db_connect();

// include 'db_connect.php';
include 'funcs.php';

$books = get_books($pdo, 15);  // デフォルト15件のデータを取得します。

// データ取得SQL作成
// $stmt = $pdo->prepare("SELECT * FROM gs_bm_table ORDER BY id DESC LIMIT 15");
// $status = $stmt->execute();

// if ($status == false) {
//   // execute（SQL実行時にエラーがある場合）
//   $error = $stmt->errorInfo();
//   exit("ErrorQuery:".$error[2]);
// }

// データ取得
// $books = $stmt->fetchAll(PDO::FETCH_ASSOC);


require_once('templates/top.php');