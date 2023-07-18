
<!DOCTYPE html>
<html lang="jp">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>
    <link rel="stylesheet" href="../css/admin.css">

</head>
<body>
<div class="admin-menu">
    <h1>管理者画面</h1>
    <li><a href="../controllers/signOut.php" class="back-button">ログアウトしてホームに戻る<br></a></li>
    <li><a href="../controllers/total_graph.php" class="back-button">集計結果を表示する<br></a></li>
    <li><a href="../administrator_controllers/admin_list.php" class="back-button">データリスト</a></li>
    <li> <a href="export_csv.php" class="back-button">CSVをダウンロードする</a></li>
    <li> <a href="import_csv.php" class="back-button">CSVをインポートする</a></li>
    </div>
</body>
</html>