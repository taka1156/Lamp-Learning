<?php
    
    require 'db_connection.php';

    // ユーザ入力なし　query

    /* 
    $sql = 'select * from contacts where id = 1';
    $stmt = $pdo -> query($sql);
    
    $reslut = $stmt -> fetchall();

    echo '<pre>';
    var_dump($reslut);
    echo '</pre>'; 
    */

    // ユーザ入力あり prepare, bind, execute

    /* 
    $sql = 'select * from contacts where id = :id'; // 名前付きプレースホルダー
    $stmt = $pdo->prepare($sql); // プリペアードステイトメント
    $stmt->bindValue(':id', 2, PDO::PARAM_INT); // 紐付け
    $stmt->execute(); // 実行

    $result = $stmt->fetchall();

    echo '<pre>';
    var_dump($result);
    echo '</pre>';
     */

    // トランザクション

    $pod->beginTransaction(); // トランザクション開始


    try {

        $stmt = $pdo->prepare($sql); // プリペアードステイトメント
        $stmt->bindValue(':id', 2, PDO::PARAM_INT); // 紐付け
        $stmt->execute();

        // 追加処理

        $pdo->commit(); //　反映
        
    } catch(PODException $e) {
        $pdo->rollback(); //更新のキャンセル
    }