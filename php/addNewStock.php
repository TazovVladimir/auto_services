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
    <title>Добавление данных - акции</title>
    <link
        href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap"
        rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    <meta charset="utf-8" />
</head>

<body>
    <div class="container">
        <h3>Заполните для добавления новых акций</h3>
        <a href="admin.php">Назад</a>
        <form class="call" action="addNewStock.php" method="POST" enctype="multipart/form-data">
            <p>Название:
                <input type="text" name="title" required class="form-control mb-4">
            </p>
            <div class="form-group">
                <p>Описание:
                    <input type="text" class="form-control mb-4" required name="text" rows="3"></input>
                </p>
            </div>
            <div class="form-group">
                <p>Картинка:
                    <input class="form-control" type="file" name="img" required accept=".jpg,.jpeg,.png,.gif">
            </div>
            <button class="btn btn-primary" type="submit">Добавить</button>
        </form>


        <?php
        if (isset($_POST['title']) && isset($_POST['text']) && isset($_FILES['img'])) {
            $title = $_POST['title'];
            $text = $_POST['text'];

            $imagetmp = addslashes(file_get_contents($_FILES['img']['tmp_name']));
            $db_table = "stock";

            $sql = "INSERT INTO $db_table (title, text, img) VALUES ('$title', '$text', '$imagetmp')";
            if (mysqli_query($conn, $sql)) {
                echo "<p class='small-blue'>Успешно добавлены</p>";
            } else {
                echo "Ошибка: " . mysqli_error($conn);
            }
        }

        ?>
    </div>
</body>

</html>