<?php

session_start();

require_once('../models/model.php');
$pdo = db_connect();


//1.  DB接続します
// require_once('db_connect.php');

// 昇順か降順かのフラグと検索文字列
$order = isset($_GET['order']) ? $_GET['order'] : 'asc';
$search = isset($_GET['search']) ? $_GET['search'] : '';

if (!empty($search)) {
  //2. データ取得SQL作成（検索文字列がある場合）
  $sql = "SELECT * FROM gs_bm_table WHERE bookTitle LIKE ?";
  //3. SQL実行
  $stmt = $pdo->prepare($sql);
  $stmt->execute(["%$search%"]);
} else {
  //2. データ取得SQL作成（検索文字列がない場合）
  $sql = "SELECT * FROM gs_bm_table ORDER BY date $order";
  //3. SQL実行
  $stmt = $pdo->prepare($sql);
  $stmt->execute();
}

require_once('../templates/list_view.php');