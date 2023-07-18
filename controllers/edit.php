<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$id=$_GET['id'];


//1.  DB接続します
require_once('../models/model.php');
$pdo = db_connect();

//2.データ表示
$stmt = $pdo->prepare("SELECT * FROM gs_bm_table WHERE id=:id");
$stmt->bindValue(':id', $id, PDO::PARAM_INT);  //バインド変数をここでセット
$status = $stmt->execute();

if ($status === false) {
    $error = $stmt->errorInfo();
    exit('SQLError:' . print_r($error, true));
} else {
   $result = $stmt->fetch();
}

require_once('../templates/edit_view.php');
