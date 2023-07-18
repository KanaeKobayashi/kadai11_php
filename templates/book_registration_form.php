

<!DOCTYPE html>
<html lang="jp">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recommended Book</title>
    <link
  href="https://unpkg.com/sanitize.css"
  rel="stylesheet"
/>
<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,400,0,0" />

<link rel="stylesheet" href="../css/style.css">
<link href="../css/bootstrap.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
    
    <header>
         <!-- nav bar -->
<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <div class="container">
    <a class="navbar-brand" href="#">Recommend Books</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav ms-auto">

        <li class="nav-item">
          <a class="nav-link active" href="../controllers/signOut.php">Sign Out</a>
        </li>
      </ul>
    </div>
  </div>
</nav>
    <h1 class="title">あなたのオススメの本を教えてください
    <button id="searchButton" onclick="window.location.href = '../templates/search.php' "style="border-radius: 50%; border: none; padding:2px;background-color:white;"><span class="material-symbols-outlined">
search
</span></button>
    </h1>
    </header>
    <form class="formWrapper" action="../models/write.php" method="post">

        <label for="bookTitle">おすすめの本のタイトル:</label>
            <input type="text" name="bookTitle" id="bookTitle" placeholder="本のタイトル" required><br>

            <label for="author">本の著者:</label>
            <input type="text" name="author" id="author" placeholder="著者" required><br>
        </div>
        <label for="thumbnail">Thumbnail URL:</label>
        <input type="text" id="thumbnail" name="thumbnail">
        <label for="rating">オススメ度:</label>
            <div class="star-rating">
                <input type="radio" name="rating" id="rating5" value="5" required><label for="rating5"></label>
                <input type="radio" name="rating" id="rating4" value="4"><label for="rating4"></label>
                <input type="radio" name="rating" id="rating3" value="3"><label for="rating3"></label>
                <input type="radio" name="rating" id="rating2" value="2"><label for="rating2"></label>
                <input type="radio" name="rating" id="rating1" value="1"><label for="rating1"></label>
            </div>
  
        <label for="comment">オススメコメント:</label>
            <textarea name="comment" id="comment" placeholder="こんなところがオススメというところを紹介してね" required></textarea><br>
  
            <label for="name">名前:</label>
            <input type="text" name="name" id="name" placeholder="関東太郎" value="<?php echo $_SESSION['name']; ?>"required><br>
  
            <label for="email">Eメール:</label>
            <input type="email" name="email" id="email" placeholder="abc@example.com" pattern="[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$" value="<?php echo $_SESSION['email']; ?>"required><br>
        <div id="selectionResult">

        <input type="submit" value="送信">
        <input type="button" class="transparent-button" value="オススメ一覧を見る" onclick="location.href='../controllers/list.php'">
    </form>


    <script>

    // ページ読み込み時にローカルストレージから選択した本の情報を読み込む
    const selectedTitle = localStorage.getItem('selectedTitle');
        const selectedAuthor = localStorage.getItem('selectedAuthor');
        const selectedThumbnail = localStorage.getItem('selectedThumbnail');
        if (selectedTitle && selectedAuthor && selectedThumbnail) {
            const selectedTitleElement = document.getElementById('bookTitle');
            const selectedAuthorElement = document.getElementById('author');
            const selectedThumbnailElement = document.getElementById('thumbnail');
            selectedTitleElement.value = selectedTitle;
            selectedAuthorElement.value = selectedAuthor;
            selectedThumbnailElement.value = selectedThumbnail; 
            // ローカルストレージの情報を削除
            localStorage.removeItem('selectedTitle');
            localStorage.removeItem('selectedAuthor');
            localStorage.removeItem('selectedThumbnail'); 
        }

        // 選択された本の情報をローカルストレージに保存
        function selectBook(title, authors ,thumbnail) {
            localStorage.setItem('selectedTitle', title);
            localStorage.setItem('selectedAuthor', authors);
            localStorage.setItem('selectedThumbnail', thumbnail); 
            // 元のページに戻る
            window.location.href = 'write.php';
        }

        // サーチページから選択された本の情報を取得
        const searchParams = new URLSearchParams(window.location.search);
        const selectedTitleParam = searchParams.get('title');
        const selectedAuthorParam = searchParams.get('author');
        const selectedThumbnailParam = searchParams.get('thumbnail');
        if (selectedTitleParam && selectedAuthorParam) {
            // 選択された本の情報をフォームに表示
            const selectedTitleElement = document.getElementById('bookTitle');
            const selectedAuthorElement = document.getElementById('author');
            const selectedThumbnailElement = document.getElementById('thumbnail');
            selectedTitleElement.value = selectedTitleParam;
            selectedAuthorElement.value = selectedAuthorParam;
        }

   
</script>

</body>
</html>