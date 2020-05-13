# Dockerを使ってLAMP環境を作ってみた

- Apache
- MySQL 5.7
- PHP 7.3

**vscode**
- phpcs
- phpcbf
- php cs fixer

※ Macに変えてから整備してないので時間がある時に修正

**composer(最低限のもの)**
- コマンド<br>
　管理開始　`composer init`<br>
　インストール `composer require --dev` <br>
　アンインストール `composer remove` <br>

- lintやformatter<br>
　squizlabs/php_codesniffer<br>
　friendsofphp/php-cs-fixer

## docker-composeのコマンド
ビルド(リビルド)<br>
`docker-compose build`

スタート<br>
`docker-compose start`

ストップ<br>
`docker-compose stop`

起動(detach モード)<br>
`docker-compose up -d (サービスの名前)`

終了<br>
`docker-compose down`

ポートや名前、状態などを調べる<br>
`docker-machine ps`

※`Encountered errors while bringing up the project`が出たらDocker関連のタスクをkillする<br>
## 学習方針
#### 最終目標:
PHPとMySQLの基本操作を学ぶ
<span style="color: red;">オブジェクト</span>とMySQLの<span style="color: red;">操作関連(PDO)</span>、<span style="color: red;">連想配列</span>は重点的に学ぶ。

#### 関連情報:
- [PHPで超簡単APIフレームワーク](https://qiita.com/kahirokunn/items/418f86e4e2ec1746ab60)
- [PHPでJSONを返すだけのAPIを実装する](https://qiita.com/trewanek/items/ebea22c7ac7ae0056b1f)
- [データの取得と出力を学ぶ！PHPでJSONを使う方法](https://techacademy.jp/magazine/12347)
- [PHP入門 JSONのデータを処理する方法](https://www.sejuku.net/blog/27932)

## portなど
- localhost -> 通常ページ(ルートだとphpInfo)
- localhosy:8080 -> phpMyAdmin

