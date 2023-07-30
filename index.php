<?php
include('php/connect.php');
session_start();
$stocks = mysqli_query($conn, "SELECT * FROM `stock`");
if (isset($_SESSION['admin'])) {
    $admin = mysqli_query($conn, "SELECT * FROM `admin`");
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style/base.css">
    <link rel="stylesheet" href="style/main.css">
    <link
        href="https://fonts.googleapis.com/css2?family=Overpass:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <title>Auto service Главная</title>
</head>

<body>
    <header>
        <div class="logo">
            <a href="index.php" class="logo-a">
                <img class="logo_img" src="./src/img/logo.svg" alt="logo">
                <span class="comp_name">Auto service</span>
            </a>
        </div>
        <ul class="nav">
            <a href="index.php" class="nav_a nav_a_active">
                <li class="nav_item">
                    <span class="nav_icon"><img src="./src/icons/home.svg" alt="home"></span>
                    <span class="nav_item_name">Главная</span>
                </li>
            </a>
            <a href="/src/pages/ourMasters.php" class="nav_a">
                <li class="nav_item">
                    <span class="nav_icon"><img src="./src/icons/ourMasters.svg" alt="masters"></span>
                    <span class="nav_item_name">Наши мастера</span>
                </li>
            </a>
            <a href="/src/pages/services.php" class="nav_a">
                <li class="nav_item">
                    <span class="nav_icon"><img src="./src/icons/services.svg" alt="services"></span>
                    <span class="nav_item_name">Услуги</span>
                </li>
            </a>
            <a href="/src/pages/request.php" class="nav_a">
                <li class="nav_item">
                    <span class="nav_icon"><img src="./src/icons/notePencil.svg" alt="request"></span>
                    <span class="nav_item_name">Оставить заявку</span>
                </li>
            </a>
            <a href="/src/pages/contacts.php" class="nav_a">
                <li class="nav_item">
                    <span class="nav_icon"><img src="./src/icons/contacts.svg" alt="contacts"></span>
                    <span class="nav_item_name">Контакты</span>
                </li>
            </a>
        </ul>
        <div class="account_mini">
            <div class="account_mini_img_name">

                <?php
                if (isset($_SESSION['admin'])) {
                    echo '
                    <div class="account_mini_img">
                        <img class="account_mini_avatar" src="./src/img/ex_face.jpg" alt="аватарка">
                    </div>
                    <div class="account_mini_name">
                        <span>';
                    ?>
                    <?php
                    while ($info_admin = mysqli_fetch_assoc($admin)) {
                        echo $info_admin['name'];
                    }
                    ?>
                    <?php echo '
                        </span>
                        <span><a href="/php/admin.php">Перейти в админку</a></span>
                    </div>
                    ';
                } else {
                    echo '
                    <div class="account_mini_name">
                        <span>Гость</span>
                        <span><a href="/php/loginAuth.php">войти</a></span>
                    </div>
                    ';
                }
                ?>

            </div>
            <?php
            if (isset($_SESSION['admin'])) {
                echo '<div class="account_mini_setting">
                    <a href="/php/logout.php"><img src="./src/icons/logout.svg" alt="Выйти"></a>
                </div>
                ';
            }
            ?>
        </div>
    </header>
    <main>
        <section>
            <h1>Главная</h1>
            <h2>Акции</h2>
            <?php
            while ($info = mysqli_fetch_assoc($stocks)) {
                ?>
                <div class="actions">
                    <div class="left">
                        <h2 class="h2_actions">
                            <?php echo $info['title']; ?>
                        </h2>
                        <p class="p_actions">
                            <?php echo $info['text']; ?>
                        </p>
                        <a href="/src/pages/request.php" class="btn">Подробнее</a>
                    </div>
                    <div class="right">
                        <?php echo '<img src="data:image/png;base64,'.base64_encode( $info['img'] ).'"/>'; ?>
                    </div>
                </div>
                <?php
            }
            ?>
        </section>
    </main>
    <footer>
        <div class="footer_logo">
            <a href="index.php">
                <img src="../../src/img/logo.svg" alt="footer_logo">
                <span>Auto service</span>
            </a>
        </div>
        <ul class="footer_ul">
            <li>
                <a href="index.php">Главная</a>
            </li>
            <li>
                <a href="/src/pages/ourMasters.php">Наши мастера</a>
            </li>
            <li>
                <a href="/src/pages/services.php">Наши услуги</a>
            </li>
        </ul>
    </footer>
</body>

</html>