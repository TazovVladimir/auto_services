<?php
include('../../php/connect.php');
$services = mysqli_query($conn, "SELECT * FROM `services`");
$masters = mysqli_query($conn, "SELECT * FROM `masters`");
$sum = 0;
session_start();
if (isset($_SESSION['admin'])) {
    $admin = mysqli_query($conn, "SELECT * FROM `admin`");
}
?>
<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $num1 = $_POST['foreign-rus'];
    $num2 = $_POST['radio_select'];
    $num3 = $_POST['select-services'];
    $num4 = $_POST['select-masters'];

    $num1 = intval($num1);
    $num2 = intval($num2);
    $num3 = intval($num3);
    $num4 = intval($num4);

    $sum = $num1 + $num2 + $num3 + $num4;
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
    <title>Auto service Заявки</title>
</head>

<body>
    <header>
        <div class="logo">
            <a href="../../" class="logo-a">
                <img class="logo_img" src="../../src/img/logo.svg" alt="logo">
                <span class="comp_name">Auto service</span>
            </a>
        </div>
        <ul class="nav">
            <a href="../../" class="nav_a ">
                <li class="nav_item">
                    <span class="nav_icon"><img src="../../src/icons/home.svg" alt="home"></span>
                    <span class="nav_item_name">Главная</span>
                </li>
            </a>
            <a href="/src/pages/ourMasters.php" class="nav_a">
                <li class="nav_item">
                    <span class="nav_icon"><img src="../../src/icons/ourMasters.svg" alt="masters"></span>
                    <span class="nav_item_name">Наши мастера</span>
                </li>
            </a>
            <a href="/src/pages/services.php" class="nav_a">
                <li class="nav_item">
                    <span class="nav_icon"><img src="../../src/icons/services.svg" alt="services"></span>
                    <span class="nav_item_name">Услуги</span>
                </li>
            </a>
            <a href="/src/pages/request.php" class="nav_a nav_a_active">
                <li class="nav_item">
                    <span class="nav_icon"><img src="../../src/icons/notePencil.svg" alt="request"></span>
                    <span class="nav_item_name">Оставить заявку</span>
                </li>
            </a>
            <a href="/src/pages/contacts.php" class="nav_a">
                <li class="nav_item">
                    <span class="nav_icon"><img src="../../src/icons/contacts.svg" alt="contacts"></span>
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
                        <img class="account_mini_avatar" src="../../src/img/ex_face.jpg" alt="аватарка">
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
                    <a href="/php/logout.php"><img src="../../src/icons/logout.svg" alt="Выйти"></a>
                </div>
                ';
            }
            ?>
        </div>
    </header>
    <main>
        <div class="wrapper">
            <section>
                <div class="post_me">
                    <div class="post_img">
                        <img src="../img/request/img.png" alt="img">
                    </div>
                    <div class="post_form">
                        <form class="post_form_par" method="POST" action="../../php/postForm.php">
                            <h3>Хотите оставить завяку?</h3>
                            <div class="form_item form_toggle">
                                <h3 class="form_title">Введите ваше имя:</h3>
                                <input name="name" required type="text" placeholder="Введите...">
                            </div>
                            <div class="form_item form_toggle">
                                <h3 class="form_title">Введите вашу почту:</h3>
                                <input name="email" required id="email" type="email" placeholder="Введите...">
                            </div>
                            <div class="form_item">
                                <h3 class="form_title">Дата и время на запись:</h3>
                                <input type="datetime-local" required name="date">
                            </div>
                            <button disabled id="post_form_btn" type="submit" class="btn">Отправить</button>
                            <input required oninvalid="this.setCustomValidity('Вы не рассчитали сумму')"
                                class="input_hidden" type="number" name='manufacturer' value="<?php echo $num1; ?>">
                            <input required oninvalid="this.setCustomValidity('Вы не рассчитали сумму')"
                                class="input_hidden" type="number" name='price_service' value="<?php echo $num3; ?>">
                            <input required oninvalid="this.setCustomValidity('Вы не рассчитали сумму')"
                                class="input_hidden" type="number" name='price_master' value="<?php echo $num4; ?>">
                            <input required oninvalid="this.setCustomValidity('Вы не рассчитали сумму')"
                                class="input_hidden" type="number" name='price_date' value="<?php echo $num2; ?>">
                            <input required oninvalid="this.setCustomValidity('Вы не рассчитали сумму')"
                                class="input_hidden" type="number" name='sum' value="<?php echo $sum; ?>">
                        </form>

                    </div>
                </div>
                <?php if ($sum != 0) {
                    echo '<div class="main-prices">';
                    echo '<h2>Цены по выбранным:</h2>';
                    echo '<ul>';
                    echo '<li>Наценка за производителя - <span>' . $num1 . 'р</span></li>';
                    echo '<li>Цена за услугу - <span>' . $num3 . 'р</span></li>';
                    echo '<li>Цена за мастера - <span>' . $num4 . 'р</span></li>';
                    echo '<li>Наценка за срок выполнения - <span>' . $num2 . 'р</span></li>';
                }
                ?>
            </section>
            <div class="right_bar_open">
                <form class="form_main" method="POST" action="request.php">
                    <h2>Калькулятор расчета суммы</h2>
                    <ul class="sum">
                        <li class="sum_title">Итоговая сумма:</li>
                        <li class="sum_price">
                            <?php echo $sum; ?>р
                        </li>
                    </ul>
                    <div class="form_item form_toggle">
                        <h3 class="form_title">Выберите производителя:</h3>
                        <ul class="radio_wrapper">
                            <label class="radio_label">
                                <input checked class="main_radio" type="radio" name="foreign-rus" required
                                    value="2000" />
                                <span class="radio_el"></span>
                                Иномарка
                            </label>
                            <label class="radio_label">
                                <input class="main_radio" type="radio" value="1000" required name="foreign-rus" />
                                <span class="radio_el"></span>
                                Отечественная
                            </label>
                        </ul>
                    </div>
                    <div class="form_item form_toggle">
                        <h3 class="form_title">Выберите услугу:</h3>
                        <select class="select" name="select-services" required>
                            <?php
                            while ($info_services = mysqli_fetch_assoc($services)) {
                                ?>
                                <option value="<?php echo $info_services['price']; ?>">
                                    <?php echo $info_services['title']; ?>
                                </option>
                                <?php
                            }
                            ?>
                        </select>
                    </div>
                    <div class="form_item form_toggle">
                        <h3 class="form_title">Выберите мастера:</h3>
                        <select class="select" name="select-masters" required>
                            <?php
                            while ($info_masters = mysqli_fetch_assoc($masters)) {
                                ?>
                                <option value="<?php echo $info_masters['price']; ?>">
                                    <?php echo $info_masters['title']; ?>
                                </option>
                                <?php
                            }
                            ?>
                        </select>
                    </div>
                    <div class="form_item">
                        <h3 class="form_title">Сроки выполнения услуги:</h3>
                        <div class="radio_wrapper">
                            <label class="radio_label">
                                <input checked class="main_radio" type="radio" name="radio_select" required
                                    value="1000" />
                                <span class="radio_el"></span>
                                Срочно
                            </label>
                            <label class="radio_label">
                                <input class="main_radio" type="radio" value="200" required name="radio_select" />
                                <span class="radio_el"></span>
                                Без разницы
                            </label>
                        </div>
                    </div>
                    <button type="submit" class="btn">Рассчитать</button>
                </form>
            </div>
        </div>
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
                <a href="/index.php">Главная</a>
            </li>
            <li>
                <a href="/src/pages/ourMasters.php">Наши мастера</a>
            </li>
            <li>
                <a href="/src/pages/services.php">Наши услуги</a>
            </li>
        </ul>
    </footer>
    <script src="../../js/validator_req.js"></script>
</body>

</html>