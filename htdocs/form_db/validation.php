<?php

    function validation($post_data){
        $error = [];

        if(empty($post_data['your_name'])){
            $error[] = '氏名は入力必須項目です。';
        } else {
            if(mb_strlen($post_data['your_name']) > 20){
                $error[] = '氏名は20字以内にして下さい。';
            }
        }

        if(empty($post_data['email'])){
            $error[] = 'メールアドレスは入力必須項目です。';
        } else {
            if(!filter_var($post_data['email'], FILTER_VALIDATE_EMAIL)){
                $error[] = 'メールアドレスのフォーマットが正しくありません';
            }
        }

        // URLはなくてもいい
        if(!empty($post_data['url'])){
            if(!filter_var($post_data['url'], FILTER_VALIDATE_URL)){
                $error[] = 'ホームページのURLフォーマットが正しくありません';
            }
        }

        if(empty($post_data['age'])){
            $error[] = '年齢は入力必須項目です。';
        } else {
            if($post_data['age'] > 6){
                $error[] = '年齢が不正な値になっています。';
            }
        }

        if(!isset($post_data['gender'])){
            $error[] = '性別は入力必須項目です。';
        }

        if(empty($post_data['contact'])){
            $error[] = 'お問い合わせ内容は入力必須項目です。';
        } else {
            if(mb_strlen($post_data['contact']) < 10 || mb_strlen($post_data['contact']) > 200){
                $error[] = 'お問い合わせ内容は10字以上、200字以内にして下さい。';
            }
        }

        if($post_data['caption'] !== '1'){
            $error[] = '注意事項の確認をしてチェックボックスを押して下さい。';
        }

        return $error;
    }
