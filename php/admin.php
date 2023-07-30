<?php
session_start();
if (!$_SESSION['admin']) {
    header('Location: /php/loginAuth.php');
}
include 'connect.php';
$sql = "SELECT * FROM form_callback";
$admin = mysqli_query($conn, "SELECT * FROM `admin`");
$services = "SELECT * FROM `services`";
$stock = "SELECT * FROM `stock`";
$masters = "SELECT * FROM `masters`";
?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin</title>
    <link
        href="https://fonts.googleapis.com/css2?family=Overpass:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
</head>

<body>
    <section class="main">
        <div class="container">
            <h2>Добро пожаловать в админ панель</h2>
            <a href='logout.php'>Завершить сессию</a>
            <a href='/index.php'>На главную</a>
            <p class="ul-title">
                <?php echo "Таблица оставленных заявок" ?>
            </p>
            <h4>Данные об админе</h4>
            <?php
            while ($info_admin = mysqli_fetch_assoc($admin)) {
                echo '<p>Имя - ' . $info_admin['name'] . '</p>';
                echo '<p>Логин - ' . $info_admin['login'] . '</p>';
                echo '<p>Пароль - ' . $info_admin['password'] . '</p>';
            }
            ?>
            <h4>Данные об оставленных заявках</h4>
            <?php
            if ($result = $conn->query($sql)) {
                $rowsCount = $result->num_rows;
                echo "<p>Кол оставленных заявок пользователей: $rowsCount</p>";
                echo "<table class='table'><tr><th>Id</th><th>Имя</th><th>Почта</th><th>Наценка за производителя</th><th>Цена за услугу</th><th>Цена за мастера</th><th>Наценка за срок выполнения</th><th>Общая сумма</th><th>Дата завяки</th><th>Действие</th></tr>";
                foreach ($result as $row) {
                    echo "<tr>";
                    echo "<td>" . $row["id"] . "</td>";
                    echo "<td>" . $row["name"] . "</td>";
                    echo "<td>" . $row["email"] . "</td>";
                    echo "<td>" . $row["manufacturer"] . "</td>";
                    echo "<td>" . $row["price_service"] . "</td>";
                    echo "<td>" . $row["price_master"] . "</td>";
                    echo "<td>" . $row["price_date"] . "</td>";
                    echo "<td>" . $row["sum"] . "</td>";
                    echo "<td>" . $row["date"] . "</td>";
                    echo "<td><form action='delete.php' method='post'>
                                  <input type='hidden' name='id' value='" . $row["id"] . "' />
                                  <input class='btn btn-danger' type='submit' value='Удалить'>
                          </form></td>";
                    echo "</tr>";
                }
                echo "</table>";
            } else {
                echo "Ошибка: " . $conn->error;
            }
            ?>
            <h4>Данные об услугах</h4>
            <a class="btn btn-success" href="/php/addNewservices.php">Добавить</a>
            <?php
            if ($result1 = $conn->query($services)) {
                echo "<table class='table'><tr><th>Id</th><th>Картинка</th><th>Цена</th><th>Название</th><th>Описание</th><th>Действие</th><th>Действие</th></tr>";
                foreach ($result1 as $row1) {
                    echo "<tr>";
                    echo "<td>" . $row1["id"] . "</td>";
                    echo '<td><img style="width: 200px; height: 100px; object-fit:cover; border-radius:6px;" class="img-fluid" src="data:image/png;base64,' . base64_encode($row1['img']) . '"/></td>';
                    echo "<td>" . $row1["price"] . "</td>";
                    echo "<td>" . $row1["title"] . "</td>";
                    echo "<td>" . $row1["about"] . "</td>";
                    echo "<td><form action='deleteServices.php' method='post'>
                                  <input type='hidden' name='id' value='" . $row1["id"] . "' />
                                  <input class='btn btn-danger' type='submit' value='Удалить'>
                          </form></td>";
                    echo "<td><a class='btn btn-primary' href='editServices.php?id=" . $row1["id"] . "'>Изменить</a></td>";
                    echo "</tr>";
                }
                echo "</table>";
            } else {
                echo "Ошибка: " . $conn->error;
            }
            ?>

            <h4>Данные об акциях</h4>
            <a class="btn btn-success" href="/php/addNewStock.php">Добавить</a>
            <?php
            if ($result2 = $conn->query($stock)) {
                echo "<table class='table'><tr><th>Id</th><th>Картинка</th><th>Название</th><th>Действие</th></tr>";
                foreach ($result2 as $row2) {
                    echo "<tr>";
                    echo "<td>" . $row2["id"] . "</td>";
                    echo '<td><img style="width: 200px; height: 100px; object-fit:cover; border-radius:6px;" class="img-fluid" src="data:image/png;base64,' . base64_encode($row2['img']) . '"/></td>';
                    echo "<td>" . $row2["title"] . "</td>";
                    echo "<td><form action='deleteStock.php' method='post'>
                                  <input type='hidden' name='id' value='" . $row2["id"] . "' />
                                  <input class='btn btn-danger' type='submit' value='Удалить'>
                          </form></td>";
                    echo "</tr>";
                }
                echo "</table>";
            } else {
                echo "Ошибка: " . $conn->error;
            }
            ?>

            <h4>Данные о мастерах</h4>
            <a class="btn btn-success" href="/php/addNewMasters.php">Добавить</a>
            <?php
            if ($result3 = $conn->query($masters)) {
                echo "<table class='table'><tr><th>Id</th><th>Картинка</th><th>Название</th><th>Профиль</th><th>Описание</th><th>Цена</th><th>Опыт</th><th>Отзывы</th><th>Действие</th><th>Действие</th></tr>";
                foreach ($result3 as $row3) {
                    echo "<tr>";
                    echo "<td>" . $row3["id"] . "</td>";
                    echo '<td><img style="width: 200px; height: 100px; object-fit:contain; border-radius:6px;" class="img-fluid" src="data:image/png;base64,' . base64_encode($row3['img_patch']) . '"/></td>';
                    echo "<td>" . $row3["title"] . "</td>";
                    echo "<td>" . $row3["prof"] . "</td>";
                    echo "<td>" . $row3["body"] . "</td>";
                    echo "<td>" . $row3["price"] . "</td>";
                    echo "<td>" . $row3["experience"] . "</td>";
                    echo "<td>" . $row3["reviews"] . "</td>";
                    echo "<td><form action='deleteMasters.php' method='post'>
                                  <input type='hidden' name='id' value='" . $row3["id"] . "' />
                                  <input class='btn btn-danger' type='submit' value='Удалить'>
                          </form></td>";
                    echo "<td><a class='btn btn-primary' href='editMasters.php?id=" . $row3["id"] . "'>Изменить</a></td>";
                    echo "</tr>";
                }
                echo "</table>";
            } else {
                echo "Ошибка: " . $conn->error;
            }
            ?>

        </div>
    </section>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3"
        crossorigin="anonymous"></script>
</body>

</html>