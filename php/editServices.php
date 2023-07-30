<?php
include 'connect.php';
session_start();
if (!$_SESSION['admin']) {
    header('Location: index.php');
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Обновление данных - Услуги</title>
    <link
        href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap"
        rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    <meta charset="utf-8" />
</head>

<body>
    <div class="container">
        <?php

        // если запрос GET
        if ($_SERVER["REQUEST_METHOD"] === "GET" && isset($_GET["id"])) {
            $userid = $conn->real_escape_string($_GET["id"]);
            $sql = "SELECT * FROM services WHERE id = '$userid'";
            if ($result = $conn->query($sql)) {
                if ($result->num_rows > 0) {
                    foreach ($result as $row) {
                        $title = $row["title"];
                        $price = $row["price"];
                        $about = $row["about"];
                        $imagetmp = $row["img"];
                    }
                    echo "<h2 class='title'>Обновление данных</h2>
                <form method='post' enctype='multipart/form-data'>
                    <input class='form-control mb-1' type='hidden' name='id' value='$userid' />
                    <p>Название:
                    <input class='form-control mb-1' type='text' name='title' value='$title' /></p>
                    <p>Цена:
                    <input class='form-control mb-1' type='number' name='price' value='$price' /></p>
                    <p>Описание:
                    <input class='form-control mb-1' type='text' name='about' value='$about' /></p>
                    <div class='form-group'>
                    <p>Картинка:
                    <input class='form-control' type='file' name ='img' required accept='.jpg,.jpeg,.png,.gif'>
                    </div>
                    <input class='btn btn-primary' type='submit' value='Сохранить'>
            </form>";

                } else {
                    echo "<div>Не найден</div>";
                }
                $result->free();
            } else {
                echo "Ошибка: " . $conn->error;
            }
        } elseif (isset($_POST["id"]) && isset($_POST["title"]) && isset($_POST["price"]) && isset($_POST["about"]) && isset($_FILES['img'])) {

            $userid = $conn->real_escape_string($_POST["id"]);
            $title = $conn->real_escape_string($_POST["title"]);
            $price = $conn->real_escape_string($_POST["price"]);
            $about = $conn->real_escape_string($_POST["about"]);
            $imagetmp = addslashes(file_get_contents($_FILES['img']['tmp_name']));
            $sql = "UPDATE services SET title = '$title', price = '$price' , about = '$about', img = '$imagetmp'  WHERE id = '$userid'";
            if ($result = $conn->query($sql)) {
                echo "<h2 class='title'>Отлично! Данные изменены</h2>";
                echo "<table class='table'><tr><th>Id</th><th>Название</th><th>Цена</th><th>Описание</th><tr>";
                echo "<tr>";
                echo "<td>" . $userid . "</td>";
                echo "<td>" . $title . "</td>";
                echo "<td>" . $price . "</td>";
                echo "<td>" . $about . "</td>";
                echo "</tr>";
                echo "</table>";
                echo "<a href='/php/admin.php'>Назад</a>";
            } else {
                echo "Ошибка: " . $conn->error;
            }
        } else {
            echo "Некорректные данные";
        }
        $conn->close();
        ?>
    </div>
</body>

</html>