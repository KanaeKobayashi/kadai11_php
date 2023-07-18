<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

//1.  DB接続します
// ２．データ取得SQL作成
require_once('../models/model.php');
$pdo = db_connect();
$allData = get_all_data($pdo);

// フォームデータの受け取り
$name = $_POST['name'];
$email = $_POST['email'];
$bookTitle = $_POST['bookTitle'];
$author = $_POST['author'];
$rating = $_POST['rating'];
$comment = $_POST['comment'];
$thumbnail = $_POST['thumbnail'];

// データの保存
$sql = "INSERT INTO gs_bm_table (name, email, bookTitle, author, rating, comment, thumbnail,date) VALUES (:name, :email, :bookTitle, :author, :rating, :comment,:thumbnail, NOW())";
  $stmt = $pdo->prepare($sql);
  $stmt->bindParam(':name', $name, PDO::PARAM_STR);
  $stmt->bindParam(':email', $email, PDO::PARAM_STR);
  $stmt->bindParam(':bookTitle', $bookTitle, PDO::PARAM_STR);
  $stmt->bindParam(':author', $author, PDO::PARAM_STR);
  $stmt->bindParam(':rating', $rating, PDO::PARAM_INT);
  $stmt->bindParam(':comment', $comment, PDO::PARAM_STR);
  $stmt->bindParam(':thumbnail', $thumbnail, PDO::PARAM_STR);
  $stmt->execute();

   // POST処理の最後にリダイレクト処理
  header('Location: ../templates/thankyou.php');
exit();




