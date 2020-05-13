<?php
    // CSRFを防ぐ(セッション開始)
    session_start();

    // バリデーション
    require 'validation.php';
    $error = validation($_POST);

    // クリックジャギングを防ぐ
    header('X-FRAME-OPTIONS: DENY');

    // XSSを防ぐ
    function h($val){
        return htmlspecialchars($val, ENT_QUOTES, 'UTF-8');
    }

    echo '<pre>';
    var_dump($_POST);
    echo '</pre>';

    $step = 0;
    // 入力, 確認, 送信の画面遷移
    if (!empty($_POST['btn_step_1']) && empty($error)) {
        $step = 1;
    } 
    
    if (!empty($_POST['btn_step_2'])) {
        $step = 2;
    }

    if ($step === 2) {
        $step = 2;
    }
?>


<!DOCTYPE html>
    <head>
        <!--BootStrap4-->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    </head>

    <body>

            
    <?php if($step === 0) : ?>
        <?php 
            // セッションの作成
            if(!isset($_SESSION['csrfToken'])){
                $csrfToken = bin2hex(random_bytes(32));
                $_SESSION['csrfToken'] = $csrfToken;
            }
            $token = $_SESSION['csrfToken'];
        ?>
        <form method="POST" action="form.php" class="mt-1 mx-auto w-50">
            <!--入力エラーの表示-->
            <?php if(!empty($_POST['btn_step_1'])) {
                foreach($error as $err ){
                    echo '<p class="text-danger">'.$err.'</p>';
                }
            } ?>
            <fieldset class="border p-4 border-info">
                <legend>お問い合わせフォーム</legend> 
                <!--入力画面-->
                <div class="form-group">
                    <label>氏名 *:</label>
                    <input type="text" class="form-control" name="your_name" placeholder="お名前" value="<?php echo h($_POST['your_name']); ?>">
                </div>

                <div class="form-group">
                    <label>メールアドレス *:</label>
                    <input type="mail" class="form-control" name="email" placeholder="xxx@xxx.jp" value="<?php echo h($_POST['email']); ?>">
                </div>
            
                <div class="form-group">
                    <label> ホームページ:</label>
                    <input type="url" class="form-control" name="url" placeholder=https://xxx.com value="<?php echo h($_POST['url']); ?>">
                </div>

                <div class="form-group">
                    <label>性別 *:</label>
                    <div class="custom-control custom-radio">
                        <input id="radio-gender-0" type="radio" class="custom-control-input" name="gender" value="0">
                        <label for="radio-gender-0" class="custom-control-label">男性</label>
                    </div>
                    <div class="custom-control custom-radio">
                        <input id="radio-gender-1" type="radio" class="custom-control-input" name="gender" value="1">
                        <label for="radio-gender-1"  class="custom-control-label">女性</label>
                    </div>
                </div>

                <div class="form-group">
                    <label>年齢 *:</label>
                    <select class="custom-select" name="age" value="<?php echo h($_POST['age']); ?>">
                        <option value="">選択して下さい</option>
                        <option value="1">~19歳</option>
                        <option value="2">20~29歳</option>
                        <option value="3">30~39歳</option>
                        <option value="4">40~49歳</option>
                        <option value="5">50〜59歳</option>
                        <option value="6">60歳~</option>
                    </select>
                </div>

                <div class="form-group">
                    <label>お問い合わせ内容 *:</label>
                    <textarea class="form-control" name="contact" value="<?php echo h($_POST['contact']); ?>"></textarea>
                </div>

                <div class="form-group">
                    <div class="custom-control custom-checkbox">
                        <input id="check-caption" type="checkbox" class="custom-control-input" name="caption" value="1">
                        <label for="check-caption" class="custom-control-label">注意事項を確認しました。</label>
                    </div>
                </div>

                <!--csrfトークン-->
                <input type="hidden" name="csrf" value="<?php echo $token; ?>">

                <div class="d-flex flex-row-reverse">
                    <button type="submit" name="btn_step_1" class="btn btn-info" value="check">確認</button>
                </div>
            </fieldset>
        </form>
    <?php elseif($step === 1 && $_POST['csrf'] === $_SESSION['csrfToken']): ?>
        <!--確認画面-->
        <form method="POST" action="form.php" class="mt-5 mx-auto w-50">
            <fieldset class="border p-4 border-info">
                <legend>確認</legend> 
                <div class="form-group">
                    <label>氏名:</label>
                    <?php echo h($_POST['your_name']); ?>
                    <input type="hidden" name="your_name" value="<?php echo h($_POST['your_name']); ?>">
                </div>

                <div class="form-group">
                    <label>メールアドレス:</label>
                    <?php echo h($_POST['email']); ?>
                    <input type="hidden" name="email" value="<?php echo h($_POST['email']); ?>">
                </div>
            
                <div class="form-group">
                    <label> ホームページ:</label>
                    <?php echo h($_POST['url']); ?>
                    <input type="hidden" name="url" value="<?php echo h($_POST['url']); ?>">
                </div>

                <div class="form-group">
                    <label>性別:</label>                    
                    <?php 
                        if($_POST['gender'] === '0'){echo '男性';} 
                        elseif($_POST['gender'] === '1'){echo '女性';}
                        else {echo '不正な値です。';}
                    ?>
                    <input type="hidden" name="gender" value="<?php echo h($_POST['gender']); ?>">
                </div>

                <div class="form-group">
                    <label>年齢:</label>
                    <?php 
                        if($_POST['age'] === '1'){echo '~19歳';} 
                        elseif($_POST['age'] === '2'){echo '20~29歳';}
                        elseif($_POST['age'] === '3'){echo '30~39歳';}
                        elseif($_POST['age'] === '4'){echo '40~49歳';}
                        elseif($_POST['age'] === '5'){echo '50~59歳';}
                        elseif($_POST['age'] === '6'){echo '60歳~';}
                        else {echo '不正な値です。';}
                    ?>
                    <input type="hidden" name="age" value="<?php echo h($_POST['age']); ?>">
                </div>

                <div class="form-group">
                    <label>お問い合わせ内容:</label>
                    <?php echo h($_POST['contact']); ?>
                    <input type="hidden" name="contact" value="<?php echo h($_POST['contact']); ?>">
                </div>

                <!--csrfトークン-->
                <input type="hidden" name="csrf" value="<?php echo $_POST['csrf'] ?>">

                <div class="d-flex flex-row-reverse">
                    <button type="submit" name="btn_step_2" class="m-2 btn btn-info" value="send">送信</button>
                    <button type="submit" class="m-2 btn btn-warning">戻る</button>
                </div>

            </fieldset>
        </form>
    <?php elseif($step === 2 && $_POST['csrf'] === $_SESSION['csrfToken']): ?>
        <!--投稿結果-->
        <h1>Thanks</h1>
        <p>送信が完了しました。</p>
        <?php unset($_SESSION['csrfToken']) ?>
    <?php endif;?>
    </body>
</html>