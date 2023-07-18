# 課題11 -オススメの本の登録アプリ-

## ①課題内容（どんな作品か）
- オススメの本を登録するアプリです。
- 本をサーチして、それに対しておすすめ度とコメントを入力できます。
- ユーザー画面、管理者画面があります。
- CRAD操作ができます。


## ②工夫した点・こだわった点
- 前回の課題10から、MVCを意識して、それぞれ分けました。
- また、関数化しました。


- フォームを更新したら2回登録となるので、リロードによる多重投稿を防止するようにリダイレクト処理を追加しました。
- csv出力（fputcsv関数利用）
- csv入力（fgetcsv関数利用）
- 登録フォームから、サーチボタンを押すと検索ページに飛べるようにし、検索した本の題名、著者、サムネイルを取得。
- ログイン者の名前とemailを入力するようにしました。
- 検索欄は一応バリデーション処理をしています。（文字数制限、禁止文字なし）
- オススメリストでは、昇順、降順ボタンと検索ボタンをつけました。

## ③難しかった点・次回トライしたいこと(又は機能)
- まだ、MVCの中で、MとVの区別がつかなかった。

## ④質問・疑問・感想、シェアしたいこと等なんでも
- [質問] 今回もcssがうまく当たらずPHPに直接書いたりして調整しました。もう少しうまくやりたい。（キャッシュの問題もあると思うけど・・・）
- [感想] たくさん書きすぎて、どこに何があるかわからなくなったので、工夫は必要だと思った。
- [参考記事] 

