<?php

// データベースに接続する部分を関数化
//DB接続
function db_connect()
{
    try {
        $db_name = 'kadai_PHP10';    //データベース名
        $db_id   = 'root';      //アカウント名
        $db_pw   = '';      //パスワード：XAMPPはパスワード無しに修正してください。
        $db_host = 'localhost'; //DBホスト
        $pdo = new PDO('mysql:dbname=' . $db_name . ';charset=utf8;host=' . $db_host, $db_id, $db_pw);
        return $pdo;
    } catch (PDOException $e) {
        exit('DB Connection Error:' . $e->getMessage());
    }
}

// データベースを抽出する部分を関数化
function get_all_posts($pdo)
{
    //２．データ登録SQL作成
    $stmt = $pdo->prepare('SELECT * FROM gs_bm_table;');
    $status = $stmt->execute();
    //３．データ表示
    $view = '';
    if ($status === false) {
        $error = $stmt->errorInfo();
        exit('SQLError:' . print_r($error, true));
    } else {
        while ($result = $stmt->fetch(PDO::FETCH_ASSOC)) {
            //GETデータ送信リンク作成
            // <a>で囲う。
            $view .= '<p>';
            $view .= '<a href="detail.php?id=' . $result['id'] . '">';
            $view .= $result['indate'] . '：' . $result['name'];
            $view .= '</a>';
            $view .= '</p>';
        }
        return $view;
    }
}

//本のデータ取得
function get_books($pdo, $limit = 15)
{
    // データ取得SQL作成
    $stmt = $pdo->prepare("SELECT * FROM gs_bm_table ORDER BY id DESC LIMIT :limit");
    $stmt->bindValue(':limit', (int)$limit, PDO::PARAM_INT);
    $status = $stmt->execute();

    if ($status == false) {
        // execute（SQL実行時にエラーがある場合）
        $error = $stmt->errorInfo();
        exit("ErrorQuery:".$error[2]);
    }

    // データ取得
    $books = $stmt->fetchAll(PDO::FETCH_ASSOC);

    return $books;
}

// ログインチェク処理 loginCheck()
function loginCheck(){
    if(!isset($_SESSION['chk_ssid'])||$_SESSION['chk_ssid']!== session_id()){
        exit('LOGIN ERROR');
    }else{
        session_regenerate_id(true);
        $_SESSION['chk_ssid']= session_id();
       
    }
}

//SQLエラー
function sql_error($stmt)
{
    //execute（SQL実行時にエラーがある場合）
    $error = $stmt->errorInfo();
    exit('SQLError:' . $error[2]);
}

//リダイレクト
function redirect($file_name)
{
    header('Location: ' . $file_name);
    exit();
}


//全てのデータを得る
function get_all_data($pdo) {
    $stmt = $pdo->prepare("SELECT * FROM gs_bm_table");
    $status = $stmt->execute();

    if ($status == false) {
      // execute（SQL実行時にエラーがある場合）
      $error = $stmt->errorInfo();
      exit("ErrorQuery:".$error[2]);
    }

    // データを取得
    $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $data;
}

//XSS対応（ echoする場所で使用！それ以外はNG ）
function h($str)
{
    return htmlspecialchars($str, ENT_QUOTES);
}