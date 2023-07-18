<?php
// 0. SESSION開始！！
session_start();

//１．関数群の読み込み
require_once('../models/model.php');
loginCheck();

// 管理者フラグの確認
if($_SESSION['kanri_flg']!=1){
    // リダイレクト処理
    header("Location: index.php"); // または適切な非管理者ユーザー向けのページにリダイレクトしてください。
    exit(); // 必ずリダイレクト後はexit()を入れる
} else {
    //２．データ登録SQL作成
    $pdo = db_connect();
    $stmt = $pdo->prepare('SELECT * FROM gs_bm_table');
    $status = $stmt->execute();

    //３．データ表示
    $view = '';
    if ($status == false) {
        sql_error($stmt);
    } else {
        while ($r = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $view .= '<p>';
            $view .= '<a href="detail.php?id=' . $r["id"] . '">';
            $view .= h($r['id']) . " " . h($r['name']) . " " . h($r['email']);
            $view .= '</a>';
            $view .= "　";
            $view .= '</p>';
        }
    }
}
require_once('../administrators_view/administrator_view.php');