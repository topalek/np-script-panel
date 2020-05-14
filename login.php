<?php

if (count($_POST)>0){
    $login = trim($_POST['login']);
    $pass = trim($_POST['pass']);
    if (strlen($login) < 2){
        $error = ['status'=> false, 'msg'=>'Логин должен быть больше 2х символов' ];
    }elseif(!$pass){
        $error = ['status'=> false, 'msg'=>'Пароль не заполнен' ];
    }else{
        $dir = "user".DIRECTORY_SEPARATOR.$login.DIRECTORY_SEPARATOR;
        $file = $dir.'authorization';
        if (file_exists($dir) && is_dir($dir)){
            $str = "login=\"$login\"\npass=\"$pass\"";
            file_put_contents($file, $str);
            $_SESSION['user'] = $login;
            $_SESSION['dir'] = $dir;
            $error = ['status'=> true, 'msg'=>'Успешно' ];
            echo "<script>
            document.location.href='/task';
            </script>";
            $login = '';
            $pass ='';
        }else{
            $error = ['status'=> false, 'msg'=>'Увы, для Вас доступ закрыт' ];
        }
    }
}else{
    $login = '';
    $pass ='';
    $error = ['status'=> true, 'msg'=>'' ];

}
?>

<div class="container">
    <div class="row">
        <div class="col">
            <form class="form" method="post">
                <h2>Script Panel</h2>
                <div class="form-group">
                    <label for="login">Login</label>
                    <input type="text" class="form-control" id="login" name="login" required value="<?= $login?>">
                </div>
                <div class="form-group">
                    <label for="pass">Password</label>
                    <input type="password" class="form-control" id="pass" name="pass" required value="<?= $pass?>">
                </div>
                <div class="row justify-content-center">
                    <div class="col">
                        <?php if (!$error['status']):?>
                            <div class="alert alert-danger" role="alert">
                                <?= $error['msg']?>
                            </div>
                        <?php elseif($error['msg']):?>
                            <div class="alert alert-success" role="alert">
                                <?= $error['msg']?>
                            </div>
                        <?php endif;?>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">Log In</button>
            </form>
        </div>
    </div>

</div>


