<?php
// DB接続します
require_once('../models/model.php');
$pdo = db_connect();

// パラメータから削除対象のIDを取得
$id = $_GET['id'];

// 指定されたIDのデータを取得
$stmt = $pdo->prepare("SELECT * FROM gs_bm_table WHERE id = :id");
$stmt->bindParam(':id', $id);
$stmt->execute();

// データが存在する場合は削除の確認画面を表示
if ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    $name = $row['name'];
    $email = $row['email'];
    $bookTitle = $row['bookTitle'];
    $author = $row['author'];
    $rating = $row['rating'];
    $comment = $row['comment'];
} else {
    echo '該当するデータが見つかりません。';
    exit;
}

// 削除の確認が得られた場合はデータベースから該当する行を削除
if (isset($_POST['confirm'])) {
    $stmt = $pdo->prepare("DELETE FROM gs_bm_table WHERE id = :id");
    $stmt->bindParam(':id', $id);
    $stmt->execute();

    echo '<script>
    alert("データを削除しました。");
    window.location.href = "../controllers/form.php";
    </script>';
    exit;
}

require_once('../templates/delate_view.php');


