<?php 
session_start();
$msg = false;
include 'connect.php';

if ( !empty($_REQUEST['password']) and !empty($_REQUEST['login']) ) {
    $login1 = $_REQUEST['login']; 
    $password1 = $_REQUEST['password'];
    $query1 = 'SELECT * FROM admin WHERE login="'.$login1.'" AND password="'.$password1.'"';
    $result1 = mysqli_query($conn, $query1);
    $user = mysqli_fetch_assoc($result1);
    if(isset($user))
        {
            session_start();
            $_SESSION['admin'] = true; 
            header('Location: /php/admin.php');
        }
    else
    {   
        $msg = true;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../style/base.css">
    <link rel="stylesheet" href="../../style/main.css">
    <link
        href="https://fonts.googleapis.com/css2?family=Overpass:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <title>Авторизацаия</title>
</head>
<body>
    <main style="margin-left: 0;">
        <div class="login">
            <h3>Авторизацация админа</h3>
            <form action="loginAuth.php" method="POST">
                <div class="form_item form_toggle">
                    <h3 class="form_title">Введите ваш логин:</h3>
                    <input name="login" required type="text" placeholder="Введите...">
                </div>
                <div class="form_item form_toggle">
                    <h3 class="form_title">Введите ваш пароль:</h3>
                    <input name="password" required type="password" placeholder="Введите...">
                </div>
                <a class="login_a" href="/index.php">На главную</a>
                <button type="submit" class="btn">Войти</button>
                <?php if ($msg === true) {echo '<div role="alert">Неправильный логин или пароль</div>'; exit("<meta http-equiv='refresh' content='2; url= ../php/loginAuth.php'>");} ?>
            </form>
        </div>
    </main>
</body>
</html>