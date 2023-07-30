<?php
include('../php/connect.php');
if (isset($_POST['name']) && isset($_POST['email'])) {
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $manufacturer = mysqli_real_escape_string($conn, $_POST['manufacturer']);
    $price_service = mysqli_real_escape_string($conn, $_POST['price_service']);
    $price_master = mysqli_real_escape_string($conn, $_POST['price_master']);
    $price_date = mysqli_real_escape_string($conn, $_POST['price_date']);
    $sum = mysqli_real_escape_string($conn, $_POST['sum']);
    $date = mysqli_real_escape_string($conn, $_POST['date']);
    $sql = "INSERT INTO form_callback (name, email, manufacturer, price_service, price_master, price_date, sum, date) VALUES ('$name', '$email', '$manufacturer', '$price_service', '$price_master', '$price_date', '$sum', '$date')";
    if (mysqli_query($conn, $sql)) {
        
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
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
    <title>Auto service Завяка</title>
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
                <div class="account_mini_img">
                    <img class="account_mini_avatar" src="../../src/img/ex_face.jpg" alt="аватарка">
                </div>
                <div class="account_mini_name">
                    <span>Тазов Владимир</span>
                    <span>Посмотреть профиль</span>
                </div>
            </div>
            <div class="account_mini_setting">
                <img src="../../src/icons/Gear.svg" alt="настройки аккаунта">
            </div>
        </div>
    </header>
    <main>
        <section>
            <h3>Успешно!</h3>
            <h2>Ваша завяка добавлена на нашу базу, спасибо за вашу заявку</h2>                
        </section>
    </main>
    <?php
    include('../src/components/footer.html');
    ?>
</body>

</html>