<?php
    const DB_HOST = 'mysql:host=mysql;dbname=udemy_php;charset=utf8';
    // 本番では、しっかり分ける
    const DB_USER = 'udemy_php_user';
    const DB_PASSWORD = 'udemy_php_user';
    // 設定(連想配列で取得, 例外を投げる, SQLインジェクション対策)
    const OPTIONS = [
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC, 
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_EMULATE_PREPARES => false
    ];
    
    try {
        $pdo = new PDO(DB_HOST, DB_USER, DB_PASSWORD, OPTIONS);
        echo '接続成功';

    } catch(PDOException $e) {
        echo '接続失敗' . $e->getMessage(). "\n";
        exit();
    }
    
