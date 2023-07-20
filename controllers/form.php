<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// スクリプトの開始時にセッションを開始
session_start();

require_once('../models/model.php');
$pdo = db_connect();

// セッション変数 'just_signed_up' が設定されていれば、サインインページにリダイレクト
if (isset($_SESSION['just_signed_up'])) {
    header('Location: ../templates/sign-in.php');
    exit;
}
// まずはセッションからユーザーIDを取得
$user_id = $_SESSION['user_id'];

// そのユーザーIDを用いて、データベースからユーザー情報を取得
$stmt = $pdo->prepare("SELECT * FROM gs_user_table WHERE id = :user_id");
$stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
$stmt->execute();
$user_info = $stmt->fetch(PDO::FETCH_ASSOC);

// ユーザー情報が取得できなければ、ログインページにリダイレクト
if (!$user_info) {
  header('Location: ../templates/sign-in.php');
  exit;
}

// 名前とメールアドレスをセッションに保存
$_SESSION['name'] = $user_info['name'];
$_SESSION['email'] = $user_info['email'];

//２．データ取得SQL作成
$stmt = $pdo->prepare("SELECT * FROM gs_bm_table");
$status = $stmt->execute();

if ($status == false) {
  // execute（SQL実行時にエラーがある場合）
  $error = $stmt->errorInfo();
  exit("ErrorQuery:".$error[2]);
} else {
  while ($result = $stmt->fetch(PDO::FETCH_ASSOC)) {
  }
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // フォームデータの受け取り、特殊文字をHTMLエンティティに変換
    $name = isset($_POST['name']) ? h($_POST['name']) : '';
    $email = isset($_POST['email']) ? $_POST['email'] : '';
    if (preg_match('/[^\\x01-\\x7E]/', $email)) {
        echo 'メールアドレスには全角文字を使用できません。';
        exit;
    }
    $bookTitle = isset($_POST['bookTitle'])? h($_POST['bookTitle']) : '';
    $author = isset($_POST['author'])? h($_POST['author']) : '';
    $rating = isset($_POST['rating']) ? h($_POST['rating']) : '';
    $comment = isset($_POST['comment']) ? h($_POST['comment']) : '';
    $thumbnail = isset($_POST['thumbnail'])? h($_POST['thumbnail']) : '';

    // 評価を整数に変換
    $rating = intval($rating);

    // データの保存
    $sql = "INSERT INTO gs_bm_table (name, email, bookTitle, author, rating, comment, thumbnail,date) VALUES (:name, :email, :bookTitle, :author, :rating, :thumbnail ,:comment, NOW())";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':name', $name, PDO::PARAM_STR);
    $stmt->bindParam(':email', $email, PDO::PARAM_STR);
    $stmt->bindParam(':bookTitle', $bookTitle, PDO::PARAM_STR);
    $stmt->bindParam(':author', $author, PDO::PARAM_STR);
    $stmt->bindParam(':rating', $rating, PDO::PARAM_INT);
    $stmt->bindParam(':comment', $comment, PDO::PARAM_STR);
    $stmt->bindParam(':thumbnail', $thumbnail, PDO::PARAM_STR);
    $stmt->execute();

    echo 'オススメの本が送信されました。ありがとうございました！';
}
require_once '../models/model.php';
$userName = $_SESSION['name'];

require_once('../templates/book_registration_form.php');


