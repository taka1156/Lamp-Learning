<?php

    // DB接続
    require 'db_connection.php';

    // 入力 DB保存 prepare, bind, execute(配列[全て文字列])
    $params = [
        'id' => null,
        'your_name' => 'なまえ',
        'email' => 'test@test.com',
        'url' => 'https://test.com',
        'gender' => '0',
        'age' => '2',
        'contact' => 'サンプルの問い合わせ',
        'created_at' => null
    ];

    $count = 0;
    $columns = '';
    $values = '';

    foreach(array_keys($params) as $key){
        if ($count++ > 0) {
            $columns .= ',';
            $values .= ',';
        }
        $columns .= $key;
        $values .= ':' . $key;
    }

    $sql = 'insert into contacts (' . $columns . ')values(' . $values . ')';
    
    // var_dump($sql);

    $stmt = $pdo->prepare($sql); // プリペアードステイトメント
    $stmt->execute($params); // 実行